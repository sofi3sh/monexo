<?php

namespace App\Http\Controllers\Backend\Service;

use App\Helpers\VideoCoursesHelper;
use App\Models\Consts\ServicesConstants;
use App\Models\Home\Booking;
use App\Models\Home\BookingDetail;
use App\Models\Home\Services;
use App\Models\Home\ServicesCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use App\Models\Consts\AlertType;
use App\Models\Home\Alert;
use App\Models\Home\Transaction;
use App\Models\Consts\TransactionsTypesConsts;

class ServicesController extends Controller
{
    /**
     * Страница для заказа услуг BlogTime.
     *
     * @return View
     */
    public function blogtime(): View
    {
        $servicesCategoryId = ServicesCategory::BLOGTIME_ID;
        $servicesCategoryTitle = __('base.dash.menu.services_blogtime');
        $listServices = $this->getServicesByCategory(ServicesCategory::BLOGTIME_ID);
        return view('dashboard.services.blogtime', compact(
            'servicesCategoryId',
            'servicesCategoryTitle',
            'listServices'
        ));
    }

    /**
     * Страница для заказа услуг BusinessPack.
     *
     * @return View
     */
    public function businesspack(): View
    {
        $servicesCategoryId = ServicesCategory::BUSINESSPACK_ID;
        $servicesCategoryTitle = __('base.dash.menu.services_businesspack');
        $listServices = $this->getServicesByCategory(ServicesCategory::BUSINESSPACK_ID);
        return view('dashboard.services.businesspack', compact(
            'servicesCategoryId',
            'servicesCategoryTitle',
            'listServices'
        ));
    }

    /**
     * Страница для заказа услуг ProfiUniverse.
     *
     * @return View
     */
    public function profiUniverse()//: View
    {
        return redirect('home'); // Временно скрыта страница

        $servicesCategoryId = ServicesCategory::PROFI_UNIVERSE_ID;
        $servicesCategoryTitle = __('base.dash.menu.services_profi_universe');
        $listServices = $this->getServicesByCategory(ServicesCategory::PROFI_UNIVERSE_ID);

        $paid = VideoCoursesHelper::getIsPaid();

        return view('dashboard.services.profi-uneverse', compact(
            'servicesCategoryId',
            'servicesCategoryTitle',
            'listServices',
            'paid'
        ));
    }

    /**
     * Создания пакета заказанных услуг.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function booking(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'contact'               => 'required',
            'services_category_id'  => 'required',
        ]);

        $user               = Auth()->user();
        $userID             = $user->id;
        $userBalanceUSD     = $user->balance_usd;
        $userEmail          = $user->email;
        $contact            = $request->contact;
        $servicesCategoryId = $request->services_category_id;
        $referralAlertType  = $this->getAlertTypeByServicesCategory( $servicesCategoryId );
        $services           = $this->getCleanService( $request->request->all() );
        $servicesSum        = array_sum($services);

        if ( $servicesSum === 0 ) {
            return redirect()
                ->back()
                ->withErrors(['Вы не выбрали не одной услуги']);
        }

        if ( $servicesSum > Auth()->user()->balance_usd ) {
            return redirect()
                ->back()
                ->withErrors(['У вас не достаточно средств на балансе USD для того чтобы сделать заказ']);
        }

        try {
            DB::beginTransaction();

            // Создаем заявку на покупку услуг
            $booking = new Booking;
            $booking->user_id = $userID;
            $booking->contact = $contact;
            $booking->save();

            // Записываем все приобретенные услуги
            $dataBookingDetail = [];
            foreach ( $services as $nameRu => $priceUSD ) {
                $dataBookingDetail[] = [
                    'booking_id'    => $booking->id,
                    'services_id'   => Services::on()->where('name_en', $nameRu)->first()->id,
                    'amount_usd'    => $priceUSD,
                    'status_id'     => ServicesConstants::STATUS['white'],
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ];
            }
            BookingDetail::on()->insert( $dataBookingDetail );

            // Создаем оповещение для заявки купленных услуг
            $this->writeAlert( $userID, AlertType::SERVICES_BUY, $userEmail, $servicesSum );

            // Создаем транзакцию покупки услуг
            $this->writeTransaction(
                $userID,
                TransactionsTypesConsts::BUY_SERVICES,
                $servicesSum,
                $userBalanceUSD - $servicesSum
            );

            // Проходимся по всем партнерам вышестоящего уровня, вплоть до пятого
            $parents53211 = $user->getAllParents();
            $lineCounter = 0;

            foreach ($parents53211 as $partner) {
                // Создаем для каждого из них оповещение что его реферал принес ему бонус
                $this->writeAlert( $partner['id'], $referralAlertType, $userEmail, $servicesSum / 100 * $partner['key'] );

                // [ ОБОРОТ КОМАНДЫ ]
                // Увеличиваем обороты команды на сумму покупки услуг для все 5 вышестоящик пертнеров
                $this->writeTransaction(
                    $partner['id'],
                    TransactionsTypesConsts::SERVICES_REFERRAL_TEAM_TURNOVER,
                    $servicesSum,
                    User::find( $partner['id'] )->balance_usd + $servicesSum
                );

                // [ ОБОРОТ 1-ГО УРОВНЯ ]
                // Увеличиваем оборот 1-ой лини только одному верхнему вышестоящему (кому 5%)
                if ( $lineCounter === 0 ) {
                    $this->writeTransaction(
                        $partner['id'],
                        TransactionsTypesConsts::SERVICES_REFERRAL_ONE_LINE,
                        $servicesSum,
                        User::find( $partner['id'] )->balance_usd + $servicesSum
                    );
                }

                // [ ПРИБЫЛЬ ПО ПАРТНЁРКЕ ]
                // Создаем для каждого вышестоящего партнера транзакцию содержащую сумму бонуса
                // Прибыль по партнерки распределяется по схеме 5-3-2-1-1
                $this->writeTransaction(
                    $partner['id'],
                    TransactionsTypesConsts::SERVICES_REFERRAL_BONUS,
                    $servicesSum / 100 * $partner['key'],
                    User::find( $partner['id'] )->balance_usd + $servicesSum / 100 * $partner['key'],
                    $lineCounter++
                );
            }

            DB::commit();
            return redirect()
                ->back()
                ->with('success', 'Ваша заявка на услуги принята в обработку');
        } catch ( Exception $e ) {
            DB::rollback();
            return back()
                ->withInput()
                ->withErrors( $e->getMessage() );
        }
    }

    /**
     * Возвращает только активные сервисы.
     *
     * @param array $rawServices
     * @return array
     */
    private function getActiveServices(array $rawServices): array
    {
        $activeServices = [];
        foreach ($rawServices as $services) {
            if ($services['is_active'] === 1) {
                $activeServices[] = $services;
            }
        }
        return $activeServices;
    }

    /**
     * По id категории вернет вернет услуги из этой категории.
     *
     * @param int $categoryId
     * @return array
     */
    private function getServicesByCategory(int $categoryId): array
    {
        return $this->getActiveServices(
            Services::on()
                ->where('services_category_id', $categoryId)
                ->get()
                ->toArray()
        );
    }

    /**
     * Очищает массив от элементов не относящихся к услугам и значения элементов делает числовыми.
     *
     * @param array $rawServices
     * @return array
     */
    private function getCleanService(array $rawServices): array
    {
        $cleanServices = [];
        foreach ($rawServices as $key => $services) {
            if ( ! in_array($key, ['_token', 'contact', 'total', 'services_category_id']) ) {
                $cleanServices[$key] = floatval($services);
            }
        }
        return $cleanServices;
    }

    /**
     * По айдишнику категории услуг возвращает айдишник типа оповещений.
     *
     * @param int $servicesCategoryId
     * @return int
     */
    private function getAlertTypeByServicesCategory(int $servicesCategoryId): int
    {
        $alertTypeId = 0;
        switch ($servicesCategoryId) {
            case ServicesCategory::BLOGTIME_ID:
                $alertTypeId = AlertType::SERVICES_REFERRAL_BLOGTIME;
                break;
            case ServicesCategory::BUSINESSPACK_ID:
                $alertTypeId = AlertType::SERVICES_REFERRAL_BUSINESSPACK;
                break;
            case ServicesCategory::PROFI_UNIVERSE_ID:
                $alertTypeId = AlertType::SERVICES_PROFI_UNIVERSE;
                break;
        }
        return $alertTypeId;
    }

    /**
     * Создает оповещение.
     *
     * @param int $userID
     * @param int $alertTypeID
     * @param string $email
     * @param float $amount
     */
    private function writeAlert(int $userID, int $alertTypeID, string $email, float $amount)
    {
        $alert              = new Alert;
        $alert->user_id     = $userID;
        $alert->alert_id    = $alertTypeID;
        $alert->email       = $email;
        $alert->amount      = $amount;
        // Убрал в оповещениях платежную систему по просьбе тестировщика. Дабы не вводить в заблуждение пользователей.
        // $alert->currency_id         = 26;
        $alert->save();
    }

    /**
     * Записывает транзакцию.
     *
     * @param int $userID
     * @param int $transactionTypeID
     * @param float $amountUSD
     * @param float $balanceAfterTransaction
     * @param int|null $lineNumber
     */
    private function writeTransaction(
        int $userID,
        int $transactionTypeID,
        float $amountUSD,
        float $balanceAfterTransaction,
        int $lineNumber = null)
    {
        $transaction = new Transaction;
        $transaction->user_id = $userID;
        $transaction->transaction_type_id = $transactionTypeID;
        $transaction->amount_usd = $amountUSD;
        $transaction->balance_usd_after_transaction = $balanceAfterTransaction;
        if ( ! is_null( $lineNumber ) ) {
            $transaction->line_number = $lineNumber;
        }
        $transaction->save();
    }

    /**
     * Из коллекции делает многомерный массив содержащий описание услуги и его цену.
     *
     * @param array $rawArrayServices
     * @return array|array[]
     */
    private function getServicesToView(array $rawArrayServices): array
    {
        $cookedArrayServices = [];
        foreach($rawArrayServices as $rowOneServices) {
            if ($rowOneServices['is_active'] === 1) {
                $cookedArrayServices += [
                    $rowOneServices['name_en'] => [
                        'name_ru' => $rowOneServices['name_ru'],
                        'price_usd' => $rowOneServices['price_usd'],
                    ],
                ];
            }
        }
        return $cookedArrayServices;
    }

    /**
     * Получает массив выбраных элементов пользователем и возвращает его но с ценами.
     *
     * @param array $selectedItems
     * @return array
     */
    private function getArrayPrice(array $selectedItems): array
    {
        unset($selectedItems['_token']);
        unset($selectedItems['contact']);
        unset($selectedItems['services_category_id']);
        unset($selectedItems['total']);
        foreach ($selectedItems as $key => &$value) {
            if ($key === 'instagram_escorts') {
                continue;
            }
            $value = ServicesConstants::PRICE[$key];
        }
        if ( array_key_exists('instagram_escorts', $selectedItems) ) {
            // Элемент instagram_escorts содержит ключ к вложеному массиву констант.
            $selectedItems['instagram_escorts'] = ServicesConstants::PRICE['instagram_escorts'][$selectedItems['instagram_escorts']];
        }
        return $selectedItems;
    }
}
