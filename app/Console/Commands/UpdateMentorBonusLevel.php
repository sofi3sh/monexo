<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Home\Bonus;
use App\Models\Home\UserMarketingPlan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateMentorBonusLevel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateMentorBonusLevel:Run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновление уровней пользователей';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
Log::info('_____________ UpdateMentorBonusLevel is run!');
        //$users = User::where('bonus_level', '>', 0)->whereDate('updated_at', '<', date('Y-m-d',strtotime("-1 days")))->get();
        $users = User::where('bonus_level', '>', 0)->get();
        foreach ($users as $user) {

            DB::beginTransaction();
            try{
                $myInvestedUsd   = UserMarketingPlan::where('user_id', $user->id)->whereNull('end_at')->sum('invested_usd');
                $refferralIdList = $user->refferrals()->select('id')->get()->pluck('id');
                $teamInvestedUsd = UserMarketingPlan::whereIn('user_id', $refferralIdList)->whereNull('end_at')->sum('invested_usd');
                $bonuses      = Bonus::select('level')->where([['personal_deposit', '<=', intval($myInvestedUsd)],['team_turnover', '<=', intval($teamInvestedUsd)],['is_active', '=', 1]])->get();

                foreach ($bonuses as $bonus) {
                    User::where('id', $user->id)->update(['bonus_level' => intval($bonus->level)]);
                }
                if (empty($bonus)) {
                    User::where('id', $user->id)->update(['bonus_level' => 0]);
                }
                unset($bonus);

                DB::commit();

            }catch(\Exception $e) {
                DB::rollback();
            }
        }
    }
}
