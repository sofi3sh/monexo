<?php

use Graybet\Game\Seeds\PackageSeeder;
use Graybet\Game\Seeds\RuleSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(PackageSeeder::class);
//        $this->call(RuleSeeder::class);
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(TransactionTypesTableSeeder::class);
        $this->call(WalletStatusesSeeder::class);
        $this->call(WalletTypesSeeder::class);
        $this->call(AlertTypeTableSeeder::class);
        $this->call(BonusesTabelSeeder::class);
        //$this->call(TestWalletsSeeder::class);
        //$this->call(TransactionsSeeder::class);

        Model::reguard();
    }
}
