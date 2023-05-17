<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Consts\WalletsTypesConsts;
use App\Models\Home\Wallet;
use App\Http\ViewModels\Backend\WithdrawalFormViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Home\Transaction;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Backend\Transaction\StoreTransaction;
use Illuminate\Support\Facades\Log;
use App\Mail\RequestForWithdrawalWasMade;
use Illuminate\Support\Facades\Mail;

class TransactionsController extends Controller
{
    /**
     * Отображение страницы создания заявки на вывод
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $view_model = new WithdrawalFormViewModel(Auth::user());

        return view('backend.pages.withdrawals', [
            'user'       => Auth::user(),
            'view_model' => $view_model,
        ]);
    }

    /**
     * Сохранение созданной заявки на вывод.
     *
     * @param StoreTransaction $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRequestWithdrawal(StoreTransaction $request)
    {
        Log::channel('actionlog')->info(Auth()->user()->email . '(id=' . Auth()->user()->id . ') создал заявку на вывод ' . serialize($request->except('_token')));
        $user_id = Auth::user()->id;

        // Проверяем, существует в таблице кошельков указанный кошелек с доп. реквизитами
        $wallet = Wallet::where('user_id', $user_id)
            ->where('currency_id', $request->currency_id)
            ->where('address', $request->address)
            ->where('additional_data', $request->additional_data)
            ->where('wallet_type_id', WalletsTypesConsts::WITHDRAWAL_WALLET_TYPE_ID)
            ->first();

        try {
            DB::beginTransaction();
            if (is_null($wallet)) { // Если не использовался кошелек с такими ревкизитами
                // Добавляем кошелек в таблицу кошельков
                $wallet = Wallet::create(
                    [
                        'user_id'         => $user_id,
                        'currency_id'     => $request->currency_id,
                        'address'         => $request->address,
                        'additional_data' => $request->additional_data,
                        'wallet_type_id'  => WalletsTypesConsts::WITHDRAWAL_WALLET_TYPE_ID,
                    ]
                );
            } // Если такой кошелек+реквизиты ранее создавались - используем его id
            $wallet_id = $wallet->id;
            // Если вывод на криптовалюту
            if (is_null($request->to_payment_systems)) {
                // Определяем курс
                $rate_controller = new RateController();
                $rate = $rate_controller->getRates($request->currency_id);
            } else //Если была установлена галка "Платежная система", т.е. вывод на платежку
            {
                $rate = 1;
            }
            $user = User::find($user_id);

            // Создаем транзакцию с запросом на вывод
            Transaction::create([
                'user_id'                       => $user_id,
                'transaction_type_id'           => TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID,
                'wallet_id'                     => $wallet_id,
                'amount_crypto'                 => -$request->amount_usd / $rate,
                'amount_usd'                    => -$request->amount_usd,
                'balance_usd_after_transaction' => $user->balance_usd - $request->amount_usd,
                'rate'                          => $rate,
                'commission'                    => is_null($request->onlyReferrals) ? $request->percent : 0,
                'editor_id'                     => $user_id,
            ]);

            // Создаем почтовое уведомление
            $mail = trim(config('finance.payment_system_notifications_email'));
            if ($mail != '') {
                $request->merge(['email' => Auth::user()->email]);
                $request->merge(['wallet' => $wallet->currency->code]);
                $content = $request->all();
                try {
                    Mail::to($mail)->send(new RequestForWithdrawalWasMade($content));
                    Log::info('Отправили письмо, что выполнен запрос на вывод через крипту: ' . serialize($request->except('_token')));
                } catch (Exception $ex) {
                    Log::error($ex);
                }
            }

            DB::commit();
            $msg = 'Транзакция успешно создана и будет обработана согласно условий работы сервиса.';
            return redirect()->back()->with('flash_success', $msg);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $msg = 'Ошибка создания транзакции. Пожалуйста, обратитесь в тех. поддержку.';
            // todo todo Важно! Передавать ошибку для flash-сообщения
            return back()->withErrors($msg);
        }
    }

    /**
     * Создание транзакции.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request, Transaction $transaction, RateController $rateController)
    {
        // todo Вынести в сервисный класс, разбить на методы
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id', $user_id)
            ->where('currency_id', $request->currency_id)
            ->where('address', $request->address)
            ->where('additional_data', $request->additional_data)
            ->first();
        try {
            DB::beginTransaction();
            // Если такого кошелька у пользователя нет - записываем в базу
            // Может, это надо через WalletsController
            if (is_null($wallet)) {
                $newWallet = new Wallet([
                    'user_id'         => $user_id,
                    'wallet_type_id'  => WalletsTypesConsts::WITHDRAWAL_WALLET_TYPE_ID,
                    'currency_id'     => $request->currency_id,
                    'address'         => $request->address,
                    'additional_data' => $request->additional_data,
                ]);
                $newWallet->save();
                $wallet_id = $newWallet->id;
            } else {
                $wallet_id = $wallet->id;
            }
            // todo Здесь нужна проверка на возможные исключения и редиректом с ошибкой
            $rate = $rateController->getRates($request->currency_id, 'USD', 'id');
            $transaction->user_id = $user_id;
            $transaction->transaction_type_id = TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID;
            $transaction->wallet_id = $wallet_id;
            $transaction->amount_usd = $request->amount_usd;
            $transaction->amount_crypto = $request->amount_usd / $rate;
            $transaction->rate = $rate;
            $transaction->editor_id = $user_id;
            $transaction->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            // todo todo Важно! Передавать ошибку для flash-сообщения
            return back();
        }
        $viewModel = new WithdrawalFormViewModel(User::find(Auth::user()->id));

        return view('backend.pages.withdrawals', [
            'viewModel' => $viewModel,
        ]);
    }

    /**
     * Удаление пользователем заявки на вывод
     *
     * @param $transaction_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteWithdrawalRequest(Transaction $transaction)
    {
        // Проверка, что пользователь может удалять только транзакции с заявками на вывод и только свои
        if (($transaction->transaction_type_id !== TransactionsTypesConsts::WITHDRAWAL_REQUEST_TYPE_ID) ||
            ($transaction->user_id !== Auth()->user()->id) || !is_null($transaction->deleted_at)) {
            abort(404);
        }

        $transaction->delete();

        return back();
    }
}

