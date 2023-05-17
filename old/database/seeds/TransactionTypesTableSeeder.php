<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TransactionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'app/developer_docs/transaction_types.sql';
        DB::unprepared(@file_get_contents($path));
        $this->command->info('TransactionTypes table seeded!');
    }
}
