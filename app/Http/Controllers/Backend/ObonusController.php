<?php

namespace App\Http\Controllers\Backend;


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
    public function matching()
    {
        $j =0;
        $percent_matching = [10, 5 , 2.5];

        $dateTimeString = '22-06-2023 00:00:00';
        $dateStart = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $dateTimeString);


        $dateTimeString = '23-06-2023 00:00:00';
        $dateEnd = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $dateTimeString);


        $users = Ouser::all();
        $sum = [];
        $transactionTypeIdProfit = 38; // змінити на 2 - перевірити чи дійсно має бути 2 !!!!!

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
                for ($i=0; $i < 3; $i++) {
                    if ($parents[$i] !== 1) {

                        $lastBalance = Otransaction::where('user_id', $parents[$i])
                            ->orderBy('id', 'desc')
                            ->value('balance_usd_after_transaction');

                        //DB create
                        $matchng_profit = $currentSum * ($percent_matching[$i] / 100);

                        $sum[$j] = $currentUser . "-" . $percent_matching[$i] . "-" . $currentSum;
                            $j++;
//                        $newtrans = Otransaction::create([
//                            'user_id' => $parents[$i],
//                            'transaction_type_id' => 38, //змінити код
//                            'wallet_id' => 'NULL',
//                            'amount_crypto' => 'NULL',
//                            'amount_usd' => $matchng_profit,
//                            'amount_eth' => 0,
//                            'amount_btc' => 0,
//                            'amount_pzm' => 0,
//                            'rate' => 'NULL',
//                            'commission' => 0,
//                            'balance_usd_after_transaction' => $matchng_profit + $lastBalance,
//                            'balance_eth_after_transaction' => 0,
//                            'balance_btc_after_transaction' => 0,
//                            'balance_pzm_after_transaction' => 0,
//                            'percent' => 'NULL',
//                            'percent_on_amount' => 'NULL',
//                            'line_number' => 'NULL',
////                            'end_period',
//                            'related_user_id' => 'NULL',
//                            'related_user_wallet_id' => 'NULL',
//                            'editor_id' => 'NULL',
//                            'currency_id' => 'NULL',
//                            'exchange_direction' => 'NULL',
//                            'comment' => 'NULL',
//                            'manual' => 0,
//                            'name' => 'NULL',
////                            'created_at',
////                            'updated_at',
//                            'deleted_at' => 'NULL'
//                        ]);

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
    public function royal () {
        $ten_users = Ouser::where('bonus_level', '>=', 7)->get();

//        dd($ten_users);
//        $all_users = Ouser::all();


        //перший рівень
        foreach ($ten_users as $ten_user) {

             // всі реферали користувача $ten_user які не досягли 7 рівня
            $one_users = Ouser::where('parent_id', '=', $ten_user->id)
                ->where('bonus_level', '<', 7)
                ->get();

            //перелік ID користувачів першої лінії
            $id_one_users = [];
            foreach ($one_users as $one_user) {
                $id_one_users[] = $one_user->id;
            }

            //другий рівень
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

            //третій рівень
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

            //четвертий рівень
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

            //пятої рівень
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











            //всі рефераили - вивід
            $all_users = array_merge($id_one_users, $id_two_users, $id_three_users, $id_four_users, $id_five_users);
            dd($all_users);
        }




//        $result = [];
//        foreach ($users as $user) {
//            $result[] = $user;
//        }



        $result = [1, 2, 3];
//        $result = 123;
        return view('ovtable', ['result' => $result]);
    }



}
