<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'app/developer_docs/currencies.sql';
        DB::unprepared(@file_get_contents($path));
        $this->command->info('Currencies table seeded!');
    }
}
