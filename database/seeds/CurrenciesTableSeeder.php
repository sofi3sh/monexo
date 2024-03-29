<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CurrenciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('currencies')->insertOrIgnore([
            0 =>
                [
                    'id' => 1,
                    'name' => 'Bitcoin',
                    'code' => 'BTC',
                    'rate_decimal_digits' => 8,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 1,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 1,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            1 =>
                [
                    'id' => 2,
                    'name' => 'Ethereum',
                    'code' => 'ETH',
                    'rate_decimal_digits' => 8,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 1,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 1,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            2 =>
                [
                    'id' => 3,
                    'name' => 'Ripple',
                    'code' => 'XRP',
                    'rate_decimal_digits' => 6,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 1,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 1,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            3 =>
                [
                    'id' => 4,
                    'name' => 'Litecoin',
                    'code' => 'LTC',
                    'rate_decimal_digits' => 8,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 1,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 1,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            4 =>
                [
                    'id' => 5,
                    'name' => 'Bitcoin Cash',
                    'code' => 'BCH',
                    'rate_decimal_digits' => 8,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 0,
                    'show_rate_on_landing' => 1,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 1,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            5 =>
                [
                    'id' => 6,
                    'name' => 'Dash',
                    'code' => 'DASH',
                    'rate_decimal_digits' => 2,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 1,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 1,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            6 =>
                [
                    'id' => 7,
                    'name' => 'EOS',
                    'code' => 'EOS',
                    'rate_decimal_digits' => 14,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 1,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            7 =>
                [
                    'id' => 8,
                    'name' => 'Ethereum Classic',
                    'code' => 'ETC',
                    'rate_decimal_digits' => 8,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 1,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            8 =>
                [
                    'id' => 9,
                    'name' => 'NEO',
                    'code' => 'NEO',
                    'rate_decimal_digits' => 0,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 1,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            9 =>
                [
                    'id' => 10,
                    'name' => 'Steem',
                    'code' => 'STEEM',
                    'rate_decimal_digits' => 3,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 1,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            10 =>
                [
                    'id' => 11,
                    'name' => 'TRON',
                    'code' => 'TRX',
                    'rate_decimal_digits' => 6,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            11 =>
                [
                    'id' => 12,
                    'name' => 'Waves',
                    'code' => 'WAVES',
                    'rate_decimal_digits' => 2,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            12 =>
                [
                    'id' => 13,
                    'name' => 'NEM',
                    'code' => 'XEM',
                    'rate_decimal_digits' => 6,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            13 =>
                [
                    'id' => 14,
                    'name' => 'Monero',
                    'code' => 'XMR',
                    'rate_decimal_digits' => 12,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            14 =>
                [
                    'id' => 15,
                    'name' => 'Binance Coin	',
                    'code' => 'BNB',
                    'rate_decimal_digits' => 6,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => null,
                    'updated_at' => null,
                    'deleted_at' => null,
                ],
            15 =>
                [
                    'id' => 16,
                    'name' => 'Visa',
                    'code' => 'USD',
                    'rate_decimal_digits' => 2,
                    'invest_allowed' => 0,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 0,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '4.00',
                    'created_at' => '2019-05-29 03:00:00',
                    'updated_at' => '2019-05-29 03:00:00',
                    'deleted_at' => null,
                ],
            16 =>
                [
                    'id' => 17,
                    'name' => 'AdvAcsh USD',
                    'code' => 'USD',
                    'rate_decimal_digits' => 2,
                    'invest_allowed' => 0,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 0,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-05-29 03:00:00',
                    'updated_at' => '2019-05-29 03:00:00',
                    'deleted_at' => null,
                ],
            17 =>
                [
                    'id' => 18,
                    'name' => 'Payeer USD',
                    'code' => 'USD',
                    'rate_decimal_digits' => 2,
                    'invest_allowed' => 0,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 0,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '3.00',
                    'created_at' => '2019-06-01 12:00:00',
                    'updated_at' => '2019-06-01 12:00:00',
                    'deleted_at' => null,
                ],
            18 =>
                [
                    'id' => 19,
                    'name' => 'QIWI',
                    'code' => 'USD',
                    'rate_decimal_digits' => 2,
                    'invest_allowed' => 0,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 0,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-06-03 10:00:00',
                    'updated_at' => '2019-06-03 10:00:00',
                    'deleted_at' => null,
                ],
            19 =>
                [
                    'id' => 20,
                    'name' => 'MasterCard (USD)',
                    'code' => 'USD',
                    'rate_decimal_digits' => 2,
                    'invest_allowed' => 0,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 0,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-06-05 12:50:00',
                    'updated_at' => '2019-06-05 12:50:00',
                    'deleted_at' => null,
                ],
            20 =>
                [
                    'id' => 21,
                    'name' => 'Yandex',
                    'code' => 'USD',
                    'rate_decimal_digits' => 0,
                    'invest_allowed' => 0,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 0,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-06-05 12:35:00',
                    'updated_at' => '2019-06-05 12:35:00',
                    'deleted_at' => null,
                ],
            21 =>
                [
                    'id' => 22,
                    'name' => 'Perfect Money',
                    'code' => 'USD',
                    'rate_decimal_digits' => 2,
                    'invest_allowed' => 0,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 0,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-06-05 13:00:00',
                    'updated_at' => '2019-06-05 13:00:00',
                    'deleted_at' => null,
                ],
            22 =>
                [
                    'id' => 23,
                    'name' => 'Deposit percent',
                    'code' => 'USD',
                    'rate_decimal_digits' => 0,
                    'invest_allowed' => 0,
                    'withdrawal_allowed' => 0,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 0,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-06-05 13:00:00',
                    'updated_at' => '2019-06-05 13:00:00',
                    'deleted_at' => null,
                ],
            23 =>
                [
                    'id' => 24,
                    'name' => 'Bonuses',
                    'code' => 'USD',
                    'rate_decimal_digits' => 0,
                    'invest_allowed' => 0,
                    'withdrawal_allowed' => 0,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 0,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-06-05 13:00:00',
                    'updated_at' => '2019-06-05 13:00:00',
                    'deleted_at' => null,
                ],
            24 =>
                [
                    'id' => 25,
                    'name' => 'Prizm',
                    'code' => 'PZM',
                    'rate_decimal_digits' => 8,
                    'invest_allowed' => 1,
                    'withdrawal_allowed' => 1,
                    'show_rate_on_landing' => 1,
                    'is_crypto' => 1,
                    'in_arbitrage_trading' => 1,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '1.00',
                    'created_at' => '2019-04-13 00:00:38',
                    'updated_at' => '2019-04-13 00:00:38',
                    'deleted_at' => null,
                ],
            25 =>
                [
                    'id' => 26,
                    'name' => 'Currency Services',
                    'code' => 'USD',
                    'rate_decimal_digits' => 2,
                    'invest_allowed' => 0,
                    'withdrawal_allowed' => 0,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 0,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '0.00',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => null,
                ],
            26 =>
                [
                    'id' => 27,
                    'name' => 'base.currency.money-transfer',
                    'code' => 'USD',
                    'rate_decimal_digits' => 2,
                    'invest_allowed' => 0,
                    'withdrawal_allowed' => 0,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 0,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '3.00',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => null,
                ],
            27 =>
                [
                    'id' => 28,
                    'name' => 'Dinway',
                    'code' => 'USD',
                    'rate_decimal_digits' => 2,
                    'invest_allowed' => 0,
                    'withdrawal_allowed' => 0,
                    'show_rate_on_landing' => 0,
                    'is_crypto' => 0,
                    'in_arbitrage_trading' => 0,
                    'blockchain_addr' => null,
                    'withdrawal_commission' => '0',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => null,
                ],
            
            
        ]);

        echo "Rows: $rows\n";
    }
}
