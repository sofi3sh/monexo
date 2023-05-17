<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AppealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('appeal')->insertOrIgnore([
            [
                'id'            => 1,
                'descr'         => 'Технические сложности',
                'is_mentor'     => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 2,
                'descr'         => 'Партнёрская программа',
                'is_mentor'     => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 3,
                'descr'         => 'Пассивный доход',
                'is_mentor'     => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 4,
                'descr'         => 'Пополнение/Вывод',
                'is_mentor'     => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 5,
                'descr'         => 'Нововведения на сайте',
                'is_mentor'     => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 6,
                'descr'         => 'Продукты компании',
                'is_mentor'     => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 7,
                'descr'         => 'События компании',
                'is_mentor'     => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);

        echo "Rows: $rows\n";
    }
}
