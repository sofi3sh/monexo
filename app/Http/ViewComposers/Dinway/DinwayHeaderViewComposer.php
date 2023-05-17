<?php

namespace App\Http\ViewComposers\Dinway;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;


/**
 * Connect Http Request class
 */
use Illuminate\Http\Request;

class DinwayHeaderViewComposer
{
    private $request;

    /**
     * Pass $request
     */
    public function __construct(Request $request)
    {
       $this->request = $request;
    }

    public function compose(View $view)
    {

        $user = Auth::user();
        $userName = '0';

        if($user) {
            $userName = explode(' ', $user->name)[0];
        }

        $view->with(compact('userName'));
    }
}
