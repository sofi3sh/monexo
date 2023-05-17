
<?php

    use Carbon\Carbon;
    use Illuminate\Database\Seeder;

    class UpdateBonusesTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            DB::table('bonuses')->truncate();

            DB::table('bonuses')->updateOrInsert(
                ['id' => 1],
                [
                    'level'                                       => 1,
                    'bonus'                                       => '1.80',
                    'personal_deposit'                            => '10.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '0.50',
                    'matching_bonus'                              => '0.00',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 2],
                [
                    'level'                                       => 2,
                    'bonus'                                       => '3.60',
                    'personal_deposit'                            => '20.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '1.00',
                    'matching_bonus'                              => '0.00',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 3],
                [
                    'level'                                       => 3,
                    'bonus'                                       => '5.40',
                    'personal_deposit'                            => '30.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '1.50',
                    'matching_bonus'                              => '0.00',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 4],
                [
                    'level'                                       => 4,
                    'bonus'                                       => '9.00',
                    'personal_deposit'                            => '50.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '2.50',
                    'matching_bonus'                              => '0.01',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 5],
                [
                    'level'                                       => 5,
                    'bonus'                                       => '14.40',
                    'personal_deposit'                            => '80.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '4.00',
                    'matching_bonus'                              => '0.01',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 6],
                [
                    'level'                                       => 6,
                    'bonus'                                       => '23.40',
                    'personal_deposit'                            => '130.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '6.50',
                    'matching_bonus'                              => '0.02',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 7],
                [
                    'level'                                       => 7,
                    'bonus'                                       => '37.80',
                    'personal_deposit'                            => '210.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '10.50',
                    'matching_bonus'                              => '0.03',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 8],
                [
                    'level'                                       => 8,
                    'bonus'                                       => '61.20',
                    'personal_deposit'                            => '340.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '17.00',
                    'matching_bonus'                              => '0.04',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 9],
                [
                    'level'                                       => 9,
                    'bonus'                                       => '99.00',
                    'personal_deposit'                            => '550.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '27.50',
                    'matching_bonus'                              => '0.07',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 10],
                [
                    'level'                                       => 10,
                    'bonus'                                       => '160.20',
                    'personal_deposit'                            => '890.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '44.50',
                    'matching_bonus'                              => '0.11',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 11],
                [
                    'level'                                       => 11,
                    'bonus'                                       => '259.20',
                    'personal_deposit'                            => '1440.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '72.00',
                    'matching_bonus'                              => '0.17',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 12],
                [
                    'level'                                       => 12,
                    'bonus'                                       => '419.40',
                    'personal_deposit'                            => '2330.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '116.50',
                    'matching_bonus'                              => '0.28',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 13],
                [
                    'level'                                       => 13,
                    'bonus'                                       => '678.60',
                    'personal_deposit'                            => '3770.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '188.50',
                    'matching_bonus'                              => '0.45',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 14],
                [
                    'level'                                       => 14,
                    'bonus'                                       => '1,098.00',
                    'personal_deposit'                            => '6100.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '305.00',
                    'matching_bonus'                              => '0.73',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 15],
                [
                    'level'                                       => 15,
                    'bonus'                                       => '1776.60',
                    'personal_deposit'                            => '9870.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '493.50',
                    'matching_bonus'                              => '1.18',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 16],
                [
                    'level'                                       => 16,
                    'bonus'                                       => '2874.60',
                    'personal_deposit'                            => '15970.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '798.50',
                    'matching_bonus'                              => '1.92',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 17],
                [
                    'level'                                       => 17,
                    'bonus'                                       => '4651.20',
                    'personal_deposit'                            => '25840.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '1292.00',
                    'matching_bonus'                              => '3.10',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 18],
                [
                    'level'                                       => 18,
                    'bonus'                                       => '7525.80',
                    'personal_deposit'                            => '41810.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '2090.50',
                    'matching_bonus'                              => '5.02',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 19],
                [
                    'level'                                       => 19,
                    'bonus'                                       => '12177.000',
                    'personal_deposit'                            => '67650.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '$3382.50',
                    'matching_bonus'                              => '8.12',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 20],
                [
                    'level'                                       => 20,
                    'bonus'                                       => '19702.80',
                    'personal_deposit'                            => '109460.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '5473.00',
                    'matching_bonus'                              => '13.14',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );
            DB::table('bonuses')->updateOrInsert(
                ['id' => 21],
                [
                    'level'                                       => 21,
                    'bonus'                                       => '31879.80',
                    'personal_deposit'                            => '177110.00',
                    'team_turnover'                               => '1000.00',
                    'invitation_deposit'                          => '8855.50',
                    'matching_bonus'                              => '21.25',
                    'leadership_bonus'                            => '0.00',
                    'is_invitation_deposit_available'             => 1,
                    'is_regional_representative_status_available' => 0,
                    'affiliate_magnet'                            => 0,
                    'fast_start'                                  => 0,
                    'created_at'                                  => Carbon::now(),
                    'updated_at'                                  => Carbon::now(),
                ]
            );

        }
    }
