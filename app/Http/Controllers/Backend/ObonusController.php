<?php

namespace App\Http\Controllers\Backend;


use App\Models\Consts\AlertType;
use App\Models\Consts\TransactionsTypesConsts;
use App\Models\Home\Alert;
use App\Models\Home\Transaction;
use App\Models\Otransaction;
use App\Models\Ouser;

//use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class ObonusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // Matching Bonus
    public function matching()
    {
        $j = 0;
        $sum = [];
        $percent_matching = [10, 5, 2.5];

        // Период
        $dateTimeString = '28-06-2023 00:00:00';
        $dateStart = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $dateTimeString);
        $dateTimeString = '29-06-2023 00:00:00';
        $dateEnd = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $dateTimeString);

        $users = Ouser::all();
        // Тип транзакции
        $transactionTypeIdProfit =  2; // TransactionsTypesConsts::PROFIT_TYPE_ID; // перевірити чи дійсно має бути 2 !!!!!

        foreach ($users as $user) {
            $currentUser = $user->id;
            $transactions = Otransaction::whereBetween('created_at', [$dateStart, $dateEnd])->get();
            $currentSum = 0;

            foreach ($transactions as $transaction) {
                if (($transaction->user_id === $currentUser) && ($transaction->transaction_type_id == $transactionTypeIdProfit)) {
                    $currentSum += $transaction->amount_usd;
                }
            }

            //проводити запис тринзакції в БД
            if ($currentSum > 0) {
                $parents = [$user->parent_id, $user->parent_second_id, $user->parent_third_id];

                for ($i = 0; $i < 3; $i++) {
                    if ($parents[$i] !== 1) {
                        $lastBalance = Otransaction::where('user_id', $parents[$i])
                            ->orderBy('id', 'desc')
                            ->value('balance_usd_after_transaction');
                        // matching bonus value
                        $matchingBonusValue = $currentSum * ($percent_matching[$i] / 100);
                        // DB create
                        $transaction = new Transaction();
                        $transaction->user_id = $parents[$i];
                        $transaction->transaction_type_id = TransactionsTypesConsts::MATCHING_BONUS;
                        $transaction->amount_usd = $matchingBonusValue;
                        $transaction->balance_usd_after_transaction = $lastBalance + $matchingBonusValue;
                        $transaction->save();


                        $alert = new Alert;
                        $alert->user_id = $parents[$i];
                        $alert->alert_id = AlertType::MATCHING_BONUS;
                        $alert->amount = $matchingBonusValue;
                        $alert->save();

//                        $user->balance_usd += $matchingBonusValue;
//                        $user->bonuses_usd += $matchingBonusValue;
//                        $user->save();

                        $sum[$j] = $parents[$i] . "-" . $percent_matching[$i] . "-" . $currentSum . " = " . $matchingBonusValue;
                        $j++;

                    }
                }
            }
        };

        $result = $sum;
        return view('ovtable', ['result' => $result]);
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // Royalty Bonus
    public function royal()
    {
        $seven_users = Ouser::where('bonus_level', '>=', 7)->get();
        // 1st line
        foreach ($seven_users as $seven_user) {

            // всі реферали користувача $seven_user які не досягли 7 рівня
            $one_users = Ouser::where('parent_id', '=', $seven_user->id)
                ->where('bonus_level', '<', 7)
                ->get();

            //перелік ID користувачів першої лінії
            $id_one_users = [];
            foreach ($one_users as $one_user) {
                $id_one_users[] = $one_user->id;
            }

            // 2nd line
            $id_two_users = [];
            foreach ($id_one_users as $id_one_user) {

                // всі реферали користувача $id_one_user які не досягли 7 рівня
                $two_users = Ouser::where('parent_id', '=', $id_one_user)
                    ->where('bonus_level', '<', 7)
                    ->get();

                //перелік ID користувачів другої лінії
                foreach ($two_users as $two_user) {
                    $id_two_users[] = $two_user->id;
                }
            }

            // 3rd line
            $id_three_users = [];
            foreach ($id_two_users as $id_two_user) {

                // всі реферали користувача $id_one_user які не досягли 7 рівня
                $three_users = Ouser::where('parent_id', '=', $id_two_user)
                    ->where('bonus_level', '<', 7)
                    ->get();

                //перелік ID користувачів третьої лінії
                foreach ($three_users as $three_user) {
                    $id_three_users[] = $three_user->id;
                }
            }

            // 4th line
            $id_four_users = [];
            foreach ($id_three_users as $id_three_user) {

                // всі реферали користувача $id_three_user які не досягли 7 рівня
                $four_users = Ouser::where('parent_id', '=', $id_three_user)
                    ->where('bonus_level', '<', 7)
                    ->get();

                //перелік ID користувачів четвертої лінії
                foreach ($four_users as $four_user) {
                    $id_four_users[] = $four_user->id;
                }
            }

            // 5th line
            $id_five_users = [];
            foreach ($id_four_users as $id_four_user) {

                // всі реферали користувача $id_four_user які не досягли 7 рівня
                $five_users = Ouser::where('parent_id', '=', $id_four_user)
                    ->where('bonus_level', '<', 7)
                    ->get();

                //перелік ID користувачів пятої лінії
                foreach ($five_users as $five_user) {
                    $id_five_users[] = $five_user->id;
                }
            }

            // всі рефераили - вивід
            $all_users = array_merge($id_one_users, $id_two_users, $id_three_users, $id_four_users, $id_five_users);
            //dd($all_users);

            $lastBalance = Otransaction::where('user_id', $seven_user->id)
                ->orderBy('id', 'desc')
                ->value('balance_usd_after_transaction');

            $royaltyBonusValue = 1000;

            // DB create
            $transaction = new Transaction();
            $transaction->user_id = $seven_user->id;
            $transaction->transaction_type_id = TransactionsTypesConsts::BONUSES_TYPE_ID;
            $transaction->amount_usd = $royaltyBonusValue;
            $transaction->balance_usd_after_transaction = $lastBalance + $royaltyBonusValue;
            $transaction->save();

//            $alert = new Alert;
//            $alert->user_id = $seven_user;
//            $alert->alert_id = AlertType::MATCHING_BONUS;
//            $alert->amount = $bonusValue;
//            $alert->save();
        }

//        foreach ($users as $user) {
//            $result[] = $user;
//        }
        $royaltyBonusValue = 1000;
        $result = $royaltyBonusValue;
        return view('ovtable', ['result' => $result]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    // Invest Bonus
    public function invest () {
//      $persent_invest = 3 / 100;
        $level_invest = 10;
        $users = Ouser::where('bonus_level', '>=', $level_invest)->get();

        $current_users_id = [];

        if (count($users) === 1) {
            foreach ($users as $user) {
                $current_users_id[] = $user->id;
                //для даного користувача визначити суму від якої визнвчати процент

                $sum = 100;
                $investBonusValue = $sum * 0.015;
            }

        } elseif (count($users) > 1) {
            foreach ($users as $user) {
                $current_users_id[] = $user->id;

                $sum = 50000;
                $investBonusValue = $sum * 0.02 / count($users);
            }
        }

        //записати в DB для $current_user_id[] трансакцію $transaction
        if (count($current_users_id) > 0) {
            foreach ($current_users_id as $current_user_id) {

                $lastBalance = Otransaction::where('user_id', $current_user_id)
                    ->orderBy('id', 'desc')
                    ->value('balance_usd_after_transaction');

                //create DB
                $transaction = new Transaction();
                $transaction->user_id = $current_user_id;
                $transaction->transaction_type_id = TransactionsTypesConsts::WITHDRAWAL_TYPE_ID;
                $transaction->amount_usd = $investBonusValue;
                $transaction->balance_usd_after_transaction = $lastBalance + $investBonusValue;
                $transaction->save();

//            $alert = new Alert;
//            $alert->user_id = $seven_user;
//            $alert->alert_id = AlertType::;
//            $alert->amount = $investBonusValue;
//            $alert->save();
            }
        }

        $result = $current_users_id;
        return view('ovtable', ['result' => $result]);
    }

}
