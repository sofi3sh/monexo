<?php

namespace App\Services\Tickets;

use App\Models\Home\Ticket\Ticket;
use App\Models\Home\Ticket\TicketAnswer;
use App\Models\Home\Ticket\TicketStatus;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Util\Json;

class TicketService {

    private $ticket_id;

    public function __construct(int $ticket_id)
    {
        $this->ticket_id = $ticket_id;
    }

    public function getAdmin(string $email)
    {
        $admin = User::where('email', $email)->first();
        
        if($admin === null || !$admin->admin) {
            $admin = User::where('admin', 1)
                        ->whereNull('deleted_at')
                        ->first();
        }

        return $admin;
    }
    
    public function addAnswer(string $answer, int $user_id, int $ticketStatus = null) : JsonResponse
    {
        $user = User::find($user_id);
        $ticket_id = $this->ticket_id;

        $error = true;
        $errorText = '';
        
        try {
            DB::beginTransaction();
            
            if($ticketStatus !== null) {
                Ticket::on()
                ->find( $ticket_id )
                ->update(['ticket_status_id' => $ticketStatus]);
            }

            $ticketAnswer = new TicketAnswer();
            $ticketAnswer->ticket_id = $ticket_id;
            $ticketAnswer->answer = $answer;
            $ticketAnswer->user_id = $user_id;
            $ticketAnswer->save();
            $error = false;

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $errorText = $e->getMessage();
        }

        $response = [
            'error' => $error,
            'error_text' => $errorText,
            'user_id' => $user_id,
            'answer' => $ticketAnswer->answer,
            'humans_time' => Carbon::createFromFormat('Y-m-d H:i:s', $ticketAnswer->created_at)->diffForHumans() ,
            'user_name' => $user->surname . ' ' . $user->name,
            'user_email' => $user->email,
            'user_phone' => $user->phone,
        ];

        return response()->json($response, 200);
    }

}