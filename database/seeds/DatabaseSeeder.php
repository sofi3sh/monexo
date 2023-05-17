<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AlertTypesTableSeeder::class);
        $this->call(BalanceTypesTableSeeder::class);
        $this->call(BauntyPackagesTableSeeder::class);
        $this->call(BonusesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(CurrenciesTableAddTetherSeeder::class);
        $this->call(MarketingPlansTableSeeder::class);
        $this->call(MotivationPlansTableSeeder::class);
        $this->call(TransactionTypesTableSeeder::class);
        $this->call(WalletsStatusesTableSeeder::class);
        $this->call(WalletsTypesTableSeeder::class);
        $this->call(UserStatusesSeeder::class);
        $this->call(FAQSeeder::class);

        $this->call(\Modules\Graybull\Database\Seeders\AlertTypeSeeder::class);
        $this->call(\Modules\Graybull\Database\Seeders\TransactionTypeSeeder::class);
        $this->call(\Modules\Graybull\Database\Seeders\BetCurrencySeeder::class);

        // Услуги компании
        $this->call(BookingDetailStatusSeeder::class);
        $this->call(ServicesCategorySeeder::class);
        $this->call(ServicesSeeder::class);

        // Пользовательские переводы
        $this->call(CustomTransactionSeeder::class);

        // Пользовательские переводы
        $this->call(InstantWithdrawalInfoSeeder::class);

        // Карты
        $this->call(MapSeeder::class);

        // Настройки новостной рассылки
        $this->call(NewsSubscribesSettingsSeeder::class);

        // Настройки покупки места на карте партнеров
        $this->call(BuyPartnersMapSettingsSeeder::class);

        // Видеокурсы
//        $this->call(QuestionsSeeder::class);

        // Тип обращений
        $this->call(AppealSeeder::class);

        // Статус тикетов
        $this->call(TicketStatusSeeder::class);

        // Типы для пожеланий и предложений
        $this->call(SuggestionTypesSeeder::class);

        // Первоночальная комиссия для инвайтов. В таблице должна быть одна строка
        $this->call(InviteCommissionSeeder::class);

        // Ограничения на вывод средств
        $this->call(WithdrawalLimitSeeder::class);

        // Настройки комиссий выводы вывода
        $this->call(WithdrawCommissionSettingsSeeder::class);

        // Настройки вывода из debt_usd на balance_usd
        $this->call(DebtsTransferSettingsSeeder::class);
        
        // Настройка верификационных типов пользователя 
        $this->call(UserVerifTypesSeeder::class);
    }
}
