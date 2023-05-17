<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Dok5\Referrals\Referral;
use Kalnoy\Nestedset\Nestedset;

class UsersTableSeeder extends Seeder
{
    use Referral;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ref_field = config('referrals.fields.referralCode.name');

        // admin
        $node1 = new \App\Models\User([
            'id'                     => 1,
            'name'                   => 'admin',
            'email'                  => 'admin@gmail.com',
            'email_verified_at'      => Carbon::now(),
            'balance_usd'            => 1100,
            'profit_usd'             => 150,
            'referrals_usd'          => 50,
            'withdrawal_usd'         => 100,
            'withdrawal_request_usd' => 50,
            $ref_field               => $this->getGeneratedReferralCode(),
            'password'               => bcrypt('11111111'),
            'created_at'             => Carbon::now(),
            'updated_at'             => Carbon::now(),
        ]);

        $node1->saveAsRoot();

        // 1_1_1
        $node2 = new \App\Models\User([
            'id'                     => 2,
            'name'                   => '1_1_1',
            'email'                  => '1_1_1@gmail.com',
            'email_verified_at'      => Carbon::now(),
            'balance_usd'            => 1100,
            'profit_usd'             => 150,
            'referrals_usd'          => 50,
            'withdrawal_usd'         => 100,
            'withdrawal_request_usd' => 50,
            $ref_field               => $this->getGeneratedReferralCode(),
            'password'               => bcrypt('11111111'),
            'created_at'             => Carbon::now(),
            'updated_at'             => Carbon::now(),
        ]);

        $node2->parent_id = $node1->id;
        $node2->save();

        // 1_1_2
        $node3 = new \App\Models\User([
            'id'                     => 3,
            'name'                   => '1_1_2',
            'email'                  => '1_1_2@gmail.com',
            'email_verified_at'      => Carbon::now(),
            'balance_usd'            => 1100,
            'profit_usd'             => 150,
            'referrals_usd'          => 50,
            'withdrawal_usd'         => 100,
            'withdrawal_request_usd' => 50,
            $ref_field               => $this->getGeneratedReferralCode(),
            'password'               => bcrypt('11111111'),
            'created_at'             => Carbon::now(),
            'updated_at'             => Carbon::now(),
        ]);

        $node3->parent_id = $node1->id;
        $node3->save();

        // 1_1_3
        $node4 = new \App\Models\User([
            'id'                     => 4,
            'name'                   => '1_1_3',
            'email'                  => '1_1_3@gmail.com',
            'email_verified_at'      => Carbon::now(),
            'balance_usd'            => 1100,
            'profit_usd'             => 150,
            'referrals_usd'          => 50,
            'withdrawal_usd'         => 100,
            'withdrawal_request_usd' => 50,
            $ref_field               => $this->getGeneratedReferralCode(),
            'password'               => bcrypt('11111111'),
            'created_at'             => Carbon::now(),
            'updated_at'             => Carbon::now(),
        ]);

        $node4->parent_id = $node1->id;
        $node4->save();

        // 2_1_1
        $node5 = new \App\Models\User([
            'id'                     => 5,
            'name'                   => '2_1_1',
            'email'                  => '2_1_1@gmail.com',
            'email_verified_at'      => Carbon::now(),
            'balance_usd'            => 1100,
            'profit_usd'             => 150,
            'referrals_usd'          => 50,
            'withdrawal_usd'         => 100,
            'withdrawal_request_usd' => 50,
            $ref_field               => $this->getGeneratedReferralCode(),
            'password'               => bcrypt('11111111'),
            'created_at'             => Carbon::now(),
            'updated_at'             => Carbon::now(),
        ]);

        $node5->parent_id = $node2->id;
        $node5->save();

        // 2_1_2
        $node6 = new \App\Models\User([
            'id'                     => 6,
            'name'                   => '2_1_2',
            'email'                  => '2_1_2@gmail.com',
            'email_verified_at'      => Carbon::now(),
            'balance_usd'            => 1100,
            'profit_usd'             => 150,
            'referrals_usd'          => 50,
            'withdrawal_usd'         => 100,
            'withdrawal_request_usd' => 50,
            $ref_field               => $this->getGeneratedReferralCode(),
            'password'               => bcrypt('11111111'),
            'created_at'             => Carbon::now(),
            'updated_at'             => Carbon::now(),
        ]);

        $node6->parent_id = $node2->id;
        $node6->save();

        // 2_2_3
        $node7 = new \App\Models\User([
            'id'                     => 7,
            'name'                   => '2_2_3',
            'email'                  => '2_2_3@gmail.com',
            'email_verified_at'      => Carbon::now(),
            'balance_usd'            => 1100,
            'profit_usd'             => 150,
            'referrals_usd'          => 50,
            'withdrawal_usd'         => 100,
            'withdrawal_request_usd' => 50,
            $ref_field               => $this->getGeneratedReferralCode(),
            'password'               => bcrypt('11111111'),
            'created_at'             => Carbon::now(),
            'updated_at'             => Carbon::now(),
        ]);

        $node7->parent_id = $node3->id;
        $node7->save();

        // 2_2_4
        $node8 = new \App\Models\User([
            'id'                     => 8,
            'name'                   => '2_2_4',
            'email'                  => '2_2_4@gmail.com',
            'email_verified_at'      => Carbon::now(),
            'balance_usd'            => 1100,
            'profit_usd'             => 150,
            'referrals_usd'          => 50,
            'withdrawal_usd'         => 100,
            'withdrawal_request_usd' => 50,
            $ref_field               => $this->getGeneratedReferralCode(),
            'password'               => bcrypt('11111111'),
            'created_at'             => Carbon::now(),
            'updated_at'             => Carbon::now(),
        ]);

        $node8->parent_id = $node3->id;
        $node8->save();

        // 2_3_5
        $node9 = new \App\Models\User([
            'id'                     => 9,
            'name'                   => '2_3_5',
            'email'                  => '2_3_5@gmail.com',
            'email_verified_at'      => Carbon::now(),
            'balance_usd'            => 1100,
            'profit_usd'             => 150,
            'referrals_usd'          => 50,
            'withdrawal_usd'         => 100,
            'withdrawal_request_usd' => 50,
            $ref_field               => $this->getGeneratedReferralCode(),
            'password'               => bcrypt('11111111'),
            'created_at'             => Carbon::now(),
            'updated_at'             => Carbon::now(),
        ]);

        $node9->parent_id = $node4->id;
        $node9->save();

        // 3_3_1
        $node10 = new \App\Models\User([
            'id'                     => 10,
            'name'                   => '3_3_1',
            'email'                  => '3_3_1@gmail.com',
            'email_verified_at'      => Carbon::now(),
            'balance_usd'            => 1100,
            'profit_usd'             => 150,
            'referrals_usd'          => 50,
            'withdrawal_usd'         => 100,
            'withdrawal_request_usd' => 50,
            $ref_field               => $this->getGeneratedReferralCode(),
            'password'               => bcrypt('11111111'),
            'created_at'             => Carbon::now(),
            'updated_at'             => Carbon::now(),
        ]);

        $node10->parent_id = $node7->id;
        $node10->save();

        // 3_3_2
        $node11 = new \App\Models\User([
            'id'                     => 11,
            'name'                   => '3_3_2',
            'email'                  => '3_3_2@gmail.com',
            'email_verified_at'      => Carbon::now(),
            'balance_usd'            => 1100,
            'profit_usd'             => 150,
            'referrals_usd'          => 50,
            'withdrawal_usd'         => 100,
            'withdrawal_request_usd' => 50,
            $ref_field               => $this->getGeneratedReferralCode(),
            'password'               => bcrypt('11111111'),
            'created_at'             => Carbon::now(),
            'updated_at'             => Carbon::now(),
        ]);

        $node11->parent_id = $node7->id;
        $node11->save();

        // 3_3_3
        $node12 = new \App\Models\User([
            'id'                     => 12,
            'name'                   => '3_3_3',
            'email'                  => '3_3_3@gmail.com',
            'email_verified_at'      => Carbon::now(),
            'balance_usd'            => 1100,
            'profit_usd'             => 150,
            'referrals_usd'          => 50,
            'withdrawal_usd'         => 100,
            'withdrawal_request_usd' => 50,
            $ref_field               => $this->getGeneratedReferralCode(),
            'password'               => bcrypt('11111111'),
            'created_at'             => Carbon::now(),
            'updated_at'             => Carbon::now(),
        ]);

        $node12->parent_id = $node7->id;
        $node12->save();
    }
}
