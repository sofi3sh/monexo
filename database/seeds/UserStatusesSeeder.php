<?php

use App\Models\UserStatus;
use Illuminate\Database\Seeder;

class UserStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = UserStatus::query()->insertOrIgnore([
            [
                'id' => UserStatus::STATUS_REGIONAL_REPRESENTATIVE,
                'name' => 'Regional representative',
                'created_at' => now(),
            ],
        ]);

        echo "Rows: $rows\n";
    }
}
