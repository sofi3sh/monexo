<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert([
            // Ввод
            [
                'user_id'             => 1,
                'transaction_type_id' => 1,
                'wallet_id'           => 1,
                'amount_crypto'       => 0.05,
                'amount_usd'          => 250,
                'rate'                => 5000,
                'editor_id'           => 1,
                'created_at'          => Carbon::now()->subDays(10),
                'updated_at'          => Carbon::now()->subDays(10),
                'deleted_at'          => null,
            ],
            [
                'user_id'             => 1,
                'transaction_type_id' => 1,
                'wallet_id'           => 1,
                'amount_crypto'       => 0.05,
                'amount_usd'          => 250,
                'rate'                => 5000,
                'editor_id'           => 1,
                'created_at'          => Carbon::now()->subDays(9),
                'updated_at'          => Carbon::now()->subDays(9),
                'deleted_at'          => null,
            ],
            ['user_id'             => 1,
             'transaction_type_id' => 1,
             'wallet_id'           => 1,
             'amount_crypto'       => 1.5,
             'amount_usd'          => 7500,
             'rate'                => 5000,
             'editor_id'           => 1,
             'created_at'          => Carbon::now()->subDays(8),
             'updated_at'          => Carbon::now()->subDays(8),
             'deleted_at'          => Carbon::now()->subDays(8),
            ],

            // Прибыль
            ['user_id'             => 1,
             'transaction_type_id' => 2,
             'wallet_id'           => null,
             'amount_crypto'       => 1.5,
             'amount_usd'          => 7500,
             'rate'                => 5000,
             'editor_id'           => 1,
             'created_at'          => Carbon::now()->subDays(7),
             'updated_at'          => Carbon::now()->subDays(7),
             'deleted_at'          => null,
            ],
            ['user_id'             => 1,
             'transaction_type_id' => 2,
             'wallet_id'           => null,
             'amount_crypto'       => 1.5,
             'amount_usd'          => 7500,
             'rate'                => 5000,
             'editor_id'           => 1,
             'created_at'          => Carbon::now()->subDays(1),
             'updated_at'          => Carbon::now()->subDays(1),
             'deleted_at'          => null,
            ],

            // Реферальные ур. 1
            ['user_id'             => 1,
             'transaction_type_id' => 3,
             'wallet_id'           => null,
             'amount_crypto'       => 1.5,
             'amount_usd'          => 7500,
             'rate'                => 5000,
             'editor_id'           => 1,
             'created_at'          => Carbon::now()->subDays(7),
             'updated_at'          => Carbon::now()->subDays(7),
             'deleted_at'          => null,
            ],
            ['user_id'             => 1,
             'transaction_type_id' => 3,
             'wallet_id'           => null,
             'amount_crypto'       => 1.5,
             'amount_usd'          => 7500,
             'rate'                => 5000,
             'editor_id'           => 1,
             'created_at'          => Carbon::now()->subDays(1),
             'updated_at'          => Carbon::now()->subDays(1),
             'deleted_at'          => null,
            ],
            // Реферальные ур. 2
            ['user_id'             => 1,
             'transaction_type_id' => 4,
             'wallet_id'           => null,
             'amount_crypto'       => 1.5,
             'amount_usd'          => 7500,
             'rate'                => 5000,
             'editor_id'           => 1,
             'created_at'          => Carbon::now()->subDays(7),
             'updated_at'          => Carbon::now()->subDays(7),
             'deleted_at'          => null,
            ],

            // Реферальные ур. 3
            // Реферальные ур. 4
            // Реферальные ур. 5
            // Реферальные ур. 6
            // Реферальные ур. 7
            // Реферальные ур. 8
            // Реферальные ур. 9
            // Реферальные ур. 11
            // Реферальные ур. 12

            // Заявка на вывод
            ['user_id'             => 1,
             'transaction_type_id' => 13,
             'wallet_id'           => 2,
             'amount_crypto'       => 1.5,
             'amount_usd'          => 7500,
             'rate'                => 5000,
             'editor_id'           => 1,
             'created_at'          => Carbon::now()->subDays(9),
             'updated_at'          => Carbon::now()->subDays(9),
             'deleted_at'          => null,
            ],
            ['user_id'             => 1,
             'transaction_type_id' => 13,
             'wallet_id'           => 1,
             'amount_crypto'       => 1.5,
             'amount_usd'          => 7500,
             'rate'                => 5000,
             'editor_id'           => 1,
             'created_at'          => Carbon::now()->subDays(9),
             'updated_at'          => Carbon::now()->subDays(9),
             'deleted_at'          => null,
            ],

            // Вывод
            ['user_id'             => 1,
             'transaction_type_id' => 14,
             'wallet_id'           => 3,
             'amount_crypto'       => 1.5,
             'amount_usd'          => 7500,
             'rate'                => 5000,
             'editor_id'           => 1,
             'created_at'          => Carbon::now()->subDays(9),
             'updated_at'          => Carbon::now()->subDays(9),
             'deleted_at'          => null,
            ],
        ]);
    }
}
