<?php

namespace App\Http\Controllers\Admin;

use App\Models\Home\Answer;
use App\Models\Home\Ticket\Appeal;
use App\Models\Home\Ticket\Attachment;
use App\Models\Home\Ticket\ResponseTemplate;
use App\Models\Home\Ticket\Ticket;
use App\Models\Home\Ticket\TicketAnswer;
use App\Models\Home\Ticket\TicketFront;
use App\Models\Home\Ticket\TicketStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Exception;

class TicketSupportController extends Controller
{
    const AUTO_SIGNATURE = " Если вы не довольны скоростью ответов или их качеством, просьба отправить данный тикет в отдел \"технические сложности\" с описанием, что четко вас не устраивает!";

    public function index(): View
    {
        $listTicketFresh = Ticket::on()
            ->where('ticket_status_id', TicketStatus::FRESH)
            ->orderBy('created_at', 'desc')
            ->get();

        $listTicketActive = Ticket::on()
            ->where('ticket_status_id', TicketStatus::ACTIVE)
            ->orderBy('created_at', 'desc')
            ->get();

        $listTicketClose = Ticket::on()
            ->where('ticket_status_id', TicketStatus::CLOSE)
            ->orderBy('created_at', 'desc')
            ->get();

        $listResponseTemplate = ResponseTemplate::on()
            ->where('user_id', Auth::user()->id)
            ->get();

        $listTicketFront = TicketFront::on()
            ->orderBy('created_at', 'desc')
            ->get();

        $admins = User::where('admin', 1)->pluck('id');

        $not_viewed_count = TicketAnswer::query()
            ->where('viewed', '=', 0)
            ->whereNotIn('user_id', $admins)
            ->count();

        return view('admin.ticket-support.index', compact(
            'listTicketFresh',
            'listTicketActive',
            'listTicketClose',
            'listResponseTemplate',
            'listTicketFront',
            'not_viewed_count'
        ));
    }

    public function destroy(Ticket $ticket)
    {
        try {
            DB::beginTransaction();
            Attachment::on()
                ->where('ticket_id', $ticket->id)
                ->delete();

            TicketAnswer::on()
                ->where('ticket_id', $ticket->id)
                ->delete();

            Ticket::on()
                ->where('id', $ticket->id)
                ->delete();
            DB::commit();
            return back();
        } catch ( Exception $e ) {
            DB::rollBack();;
            return back()->withErrors( $e->getMessage() );
        }
    }

    public function getResponsible(Request $request)
    {
        if ( $request->ticket_id == null ) {
            $response = [ 'error' => true ];
        } else {
            $ticket = Ticket::on()->find( $request->ticket_id );
            $userResponsible = User::where('parent_id', $ticket->user_id)->first();

            $responsibleId = $userResponsible->id;
            $responsibleEmail = $userResponsible->email;
            $responsiblePhone = $userResponsible->phone;
            $responsibleCountry = $userResponsible->country;
            $responsibleCity = $userResponsible->city;

            $response = [
                'error'                 => false,
                'responsible_id'        => $responsibleId,
                'responsible_email'     => $responsibleEmail,
                'responsible_phone'     => $responsiblePhone,
                'responsible_country'   => $responsibleCountry,
                'responsible_city'      => $responsibleCity,
            ];
        }
        return response()->json($response, 200);
    }

    public function edit(Ticket $ticket)
    {
        $listTicketAnswer = TicketAnswer::on()
            ->where('ticket_id', $ticket->id)
            ->orderBy('created_at')
            ->get();

        $listResponseTemplate = ResponseTemplate::on()
            ->where('user_id', Auth::user()->id)
            ->get();

        $listTicketStatus = TicketStatus::on()->get();
        $this->setViewed($ticket->id);

        return view('admin.ticket-support.show', compact(
            'ticket',
            'listTicketAnswer',
            'listResponseTemplate',
            'listTicketStatus'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            Ticket::on()
                ->find( $request->ticket_id )
                ->update(['ticket_status_id' => TicketStatus::ACTIVE]);

            TicketAnswer::on()->create([
                'ticket_id' => $request->ticket_id,
                'answer'    => $request->answer . self::AUTO_SIGNATURE,
                'user_id'   => $request->user_id,
            ]);
            DB::commit();
            return redirect()->route('admin.ticket-support');

        } catch (Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors( $e->getMessage() );
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            Ticket::on()->find($request->ticket_id)->update(['ticket_status_id' => $request->status_id]);
            return redirect()->route('admin.ticket-support');
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->withErrors( $e->getMessage() );
        }
    }

    private function setViewed(int $ticket_id)
    {
        $admins = User::where('admin', 1)->pluck('id');

        TicketAnswer::query()
            ->where([
                'ticket_id' => $ticket_id,
                'viewed' => 0
            ])
            ->whereNotIn('user_id', $admins)
            ->update([
                'viewed' => 1
            ]);
    }
}
