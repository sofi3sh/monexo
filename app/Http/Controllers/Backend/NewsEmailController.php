<?php

namespace App\Http\Controllers\Backend;

use App\Models\NewsSubscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
class NewsEmailController extends Controller
{
    
    public function showUnsubscribeForm(Request $request) {
        $email = $request->input('email');
        return view('dinway.news-unsubscribe', compact('email'));
    }

    public function unsubscribe(Request $request) {
        
        $validatedData = $request->validate([
            'email' => 'required|email|min:2'
        ]);

        $email = $validatedData['email'];

        NewsSubscribe::query()->where('email', $email)->delete();

        Session::flash('successMessage', __('dinway.news-unsubscribe.successMessage'));

        return redirect()->route('website.home');
    }
}
