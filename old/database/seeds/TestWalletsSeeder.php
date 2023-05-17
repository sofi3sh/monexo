<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TestWalletsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wallets')->insert([
                [
                    'user_id'         => 1,
                    'currency_id'     => 1,
                    'address'         => '1yawQF4HPzWdQyqDhu5DPApQidY3zJsFRF',
                    'additional_data' => null,
                    'wallet_type_id'  => 1,
                    // todo Сделать метод, возвращающий массив с заполненными датами
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ],
                [
                    'user_id'         => 1,
                    'currency_id'     => 2,
                    'address'         => '0xBcD8B8Bc843F04cb6b2a8d4Bd0bbf0AfA3694348',
                    'additional_data' => null,
                    'wallet_type_id'  => 1,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ],
                [
                    'user_id'         => 1,
                    'currency_id'     => 3,
                    'address'         => 'rPVMhWBsfF9iMXYj3aAzJVkPDTFNSySdKy',
                    'additional_data' => '74168413',
                    'wallet_type_id'  => 1,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ],
                [
                    'user_id'         => 1,
                    'currency_id'     => 4,
                    'address'         => 'Lgyjt8K8d3SDvWdqeMtTPiQiPfLz1Zojk4',
                    'additional_data' => null,
                    'wallet_type_id'  => 1,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ],
                [
                    'user_id'         => 1,
                    'currency_id'     => 5,
                    'address'         => 'bitcoincash:qrjakf420t5sygn2v30u6thlkvt75dlzyytt0zpy4h',
                    'additional_data' => null,
                    'wallet_type_id'  => 1,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ],
                [
                    'user_id'         => 1,
                    'currency_id'     => 6,
                    'address'         => 'Xdjzw6x3znRK7eEGGNmmjcdwhF924gEJ6r',
                    'additional_data' => null,
                    'wallet_type_id'  => 1,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ],
                [
                    'user_id'         => 1,
                    'currency_id'     => 7,
                    'address'         => 'binancecleos',
                    'additional_data' => '201631441',
                    'wallet_type_id'  => 1,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ],
                [
                    'user_id'         => 1,
                    'currency_id'     => 8,
                    'address'         => '0xBcD8B8Bc843F04cb6b2a8d4Bd0bbf0AfA3694349',
                    'additional_data' => null,
                    'wallet_type_id'  => 1,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ],
                [
                    'user_id'         => 1,
                    'currency_id'     => 9,
                    'address'         => 'AZAF5npMvKAb5iKTvpzU4LWaajEURqAskd',
                    'additional_data' => null,
                    'wallet_type_id'  => 1,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ],
                [
                    'user_id'         => 1,
                    'currency_id'     => 10,
                    'address'         => 'bittrex',
                    'additional_data' => '5280639d6652479eb16',
                    'wallet_type_id'  => 1,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ],
                [
                    'user_id'         => 1,
                    'currency_id'     => 11,
                    'address'         => 'TWgCDZJMAHNtBwvKhrL2k7W8FD9rSx4hnJ',
                    'additional_data' => null,
                    'wallet_type_id'  => 1,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ],
                [
                    'user_id'         => 1,
                    'currency_id'     => 12,
                    'address'         => '3P9d7spZu7yqJD5YYdctCEuTStsz8AAcxCt',
                    'additional_data' => null,
                    'wallet_type_id'  => 1,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ],
                [
                    'user_id'         => 1,
                    'currency_id'     => 13,
                    'address'         => '3P9d7spZu7yqJD5YYdctCEuTStsz8AAcxCt',
                    'additional_data' => 'abx1bb94f8704684a09',
                    'wallet_type_id'  => 1,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ],
                [
                    'user_id'         => 1,
                    'currency_id'     => 14,
                    'address'         => '563tWEBn5XZJSxLU6uLQnQ2iY9xuNcDbjLSjkn3XAXHCbLrTTErJrBWYgHJQyrCwkNgYvyV3z8zctJLPCZy24jvb3NiTcTJ',
                    'additional_data' => 'cac69321986f4372908337f620dccad69a607f7f12ac4906a8f11a42d16abab7',
                    'wallet_type_id'  => 1,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ],
            ]
        );
    }
}
