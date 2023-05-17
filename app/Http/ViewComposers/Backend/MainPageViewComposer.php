<?php

namespace App\Http\ViewComposers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\RateController;
use App\Models\Home\Alert;
use App\Models\Home\News;
use App\Models\Home\MarketingPlan;
use App\Models\VerifAnketAnswer;

class MainPageViewComposer
{

    private $rates;

    public function __construct(RateController $rates)
    {
        $this->rates = $rates;
    }

    public function compose($view)
    {
        $news = News::orderBy('updated_at', 'desc')
            ->limit(2)
            ->get();

        $user = Auth::user();


        $alerts = Alert::getNotViewed($user->id, 7);
        
        if(count($alerts) === 0) {
            $alerts = Alert::where('user_id', $user->id)
                    ->latest()
                    ->limit(5)
                    ->get();
        }
        
        $alerts_count = Alert::getCountNotViewed($user->id);
                 
        $anket = VerifAnketAnswer::where(['user_id' => Auth::user()->id, 'is_check' => 0])->first() ?? null;
        
        $showVerifInfo = !Auth::user()->is_verif && $anket !== null;

        $view->with([
            'user'            => $user,
            'plans'           => MarketingPlan::get()->toJSON(),
            'referral_link'   => $user->getReferralLink(),
            'news'            => $news,
            'alerts'          => $alerts,
            'alerts_count'    => $alerts_count,
            'showVerifInfo'   => $showVerifInfo
        ]);
    }
}