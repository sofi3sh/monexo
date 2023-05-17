<?php

namespace App\Http\Controllers\Backend;

use App\Models\Home\Answer;
use App\Models\Home\Ticket\Appeal;
use App\Models\Home\Ticket\Attachment;
use App\Models\Home\Ticket\ResponseTemplate;
use App\Models\Home\Ticket\Ticket;
use App\Models\Home\Ticket\TicketAnswer;
use App\Models\Home\Ticket\TicketStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\{Auth, DB};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Illuminate\Http\{Request, RedirectResponse, JsonResponse};
use App\Http\Requests\Backend\Ticket\StoreTicket;
use App\Services\Tickets\TicketService;
use Exception;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    public function index(): View
    {
        $listTicketMy = Ticket::on()
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

        $referralIds = User::on()
            ->where('parent_id', Auth::user()->id)
            ->get()
            ->pluck('id')
            ->toArray();

        $listTicketPartner = Ticket::on()
            ->whereIn('user_id', $referralIds)
            ->whereIn('appeal_id', [
                Appeal::AFFILIATE_PROGRAM,
                Appeal::PASSIVE_INCOME,
                Appeal::SITE_INNOVATIONS,
                Appeal::COMPANY_EVENTS,
                Appeal::PRODUCTS_COMPANY])
            ->orderBy('id', 'desc')->get();

        $adminId = User::on()
            ->where('admin', 1)
            ->get()
            ->pluck('id')
            ->toArray();

        $adminId[] = Auth::user()->id;

        $listTicketTemplate = ResponseTemplate::on()
//            ->where('user_id', Auth::user()->id)
            ->whereIn('user_id', $adminId)
            ->get();

        return view('dashboard.ticket.index', compact('listTicketMy', 'listTicketPartner', 'listTicketTemplate'));
    }

    public function create(): View
    {
        $listAppeal = Appeal::all();
        return view('dashboard.ticket.form', compact('listAppeal'));
    }

    public function store(StoreTicket $request)
    {
        try {
            $ticket = Ticket::on()->create([
                'theme'             => $request->input('theme'),
                'appeal_id'         => $request->input('appeal_id'),
                'question'          => $request->input('question'),
                'user_id'           => Auth::user()->id,
                'ticket_status_id'  => TicketStatus::FRESH,
            ]);

        } catch (Exception $e) {
            return back()
                ->withInput()
                ->withErrors( $e->getMessage() );
        }
        
        $service = new TicketService($ticket->id);
        $admin = $service->getAdmin('tarmanov80@gmail.com');

        // Ответ админа        
        $service->addAnswer(trans('ticket.messages.success'), $admin->id);

        return redirect()->route('home.ticket');

    }

    public function getCorrespondence(Request $request)
    {
        if ( $request->ticket_id == null ) {
            $response = [ 'error' => true ];
        } else {
            $ticket = Ticket::on()->find( $request->ticket_id );
            $appealDescr = Appeal::on()->find( $ticket->appeal_id )->descr;
            $createdAt = date_format( $ticket->created_at, 'Y-m-d H:i:s');
            $userAuthor = User::on()->find( $ticket->user_id );
            $authorName = $userAuthor->surname . ' ' .$userAuthor->name;
            $authorEmail = $userAuthor->email;
            $authorPhone = $userAuthor->phone;
            $question = $ticket->question;
            $isAttachment = ( Attachment::on()->where('ticket_id', $ticket->id)->count('id') > 0 ) ? true : false;

            $answer = TicketAnswer::on()->where('ticket_id', $request->ticket_id)
                                        ->with('user:id,name')
                                        ->orderBy('created_at')
                                        ->get()
                                        ->toArray();
            $responseTemplate = ResponseTemplate::on()->where('user_id', Auth::user()->id)
                                                        ->get()
                                                        ->toArray();
            $response = [
                'error' => false,
                'theme' => $ticket->theme,
                'appeal_descr' => $appealDescr,
                'created_at' => $createdAt,
                'author_name' => $authorName,
                'author_email' => $authorEmail,
                'author_phone' => $authorPhone,
                'question' => $question,
                'is_attachment' => $isAttachment,
                'answer' => $answer,
                'response_template' => $responseTemplate,
            ];
        }
        return response()->json($response, 200);
    }

    /**
     * Добавляет новый ответ на тикет.
     * Возвращает:
     *  $error - true|false ошибка|нет ошибки
     *  $error_text - Текст ошибки если она произошла иначе пустая переменная.
     *
     *  Данные для добавления в модальное окно в переписку.
     *  user_name - Фамилия имя пользователя который добавил ответ.
     *  user_email - Почта пользователя  который добавил ответ.
     *  user_phone - Телефон пользователя который добавил ответ.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addAnswer(Request $request)
    {
        $service = new TicketService($request->input('ticket_id'));

        // Ответ польльзователя
        $response = $service->addAnswer($request->input('answer'), Auth::user()->id, TicketStatus::ACTIVE);

        return $response;
    }

    public function createTemplate(): View
    {
        return view('dashboard.ticket.form-ticket');
    }

    public function storeTemplate(Request $request)
    {
        try {
            ResponseTemplate::on()->updateOrCreate(['id' => $request->id], [
                'user_id'   => Auth::user()->id,
                'template'  => $request->template,
            ]);

            return redirect()->route('home.ticket');

        } catch ( Exception $e ) {
            return back()
                ->withInput()
                ->withErrors( $e->getMessage() );
        }
    }

    public function destroyTemplate(ResponseTemplate $responseTemplate): RedirectResponse
    {
        try {
            $responseTemplate->delete();
        } catch (Exception $e) {
            return back()
                ->withErrors( $e->getMessage() );
        }
        return redirect()->route('home.ticket');
    }

    public function editTemplate(ResponseTemplate $responseTemplate): \Illuminate\Contracts\View\View
    {
        return view('dashboard.ticket.form-ticket', compact('responseTemplate'));
    }

    public function setViewed(Request $request)
    {
        $ticket_id = $request->route('ticket_id');
        $user_id = Auth::user()->id;
        
        TicketAnswer::query()
            ->whereHas('ticket', function (Builder $query) use($ticket_id, $user_id) {
            $query->where([
                'user_id' => $user_id,
                'ticket_id' => $ticket_id
            ]);
        })
        ->where('viewed', 0)
        ->update([
            'viewed' => 1
        ]);

        return TicketAnswer::query()
            ->whereHas('ticket', function (Builder $query) use($user_id) {
                $query->where('user_id', $user_id);
            })
            ->where('viewed', '=', 0)
            ->where('user_id', '!=', $user_id)
            ->count();
    }
}
