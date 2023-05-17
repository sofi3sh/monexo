<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\PartrnersMail;
use App\Models\User;
use Mail;
use Session;

class PartnersEmailsController extends Controller
{
    public function sendAll(Request $request) 
    {
        $data =  $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string|min:2',
            'content' => 'required|string|min:2',
        ]);
        

        // Необходимо получить все email для рефералов, 1-5 уровней

        // $res = DB::select("SELECT id, email FROM users where parent_id = $data['id']")
        $user = User::find($data['id']);
        
        $recipients = $user->getAllLevelsDescendants(5);
            
        try {
            foreach($recipients as $index => $recipient) {
                $locale = $recipient->user->locale ?? 'ru';
                Mail::to($recipient->email)
                    ->locale($locale)
                    ->send(new PartrnersMail($data['id'], $data['title'], $data['content']));
            }

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }

        Session::flash('success', 'Вы успешно разослали сообщения всем своим партнерам');

        return redirect()->back();
    }
}
