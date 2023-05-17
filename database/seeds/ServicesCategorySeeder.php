<?php

use Illuminate\Database\Seeder;

class ServicesCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('services_category')->insertOrIgnore([
            ['id' => 1, 'slug' => 'blogtime', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'slug' => 'businesspack', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'slug' => 'profi_universe', 'created_at' => now(), 'updated_at' => now()],
        ]);

        echo "Rows: $rows\n";
    }
}
