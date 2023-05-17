<?php

namespace App\Http\Controllers\Admin;

use App\Models\Home\Ticket\ResponseTemplate;
use App\Models\Home\Ticket\TicketFront;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Mail\TicketFrontMail;
use Illuminate\Support\Facades\Mail;

class TicketTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return 1;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.ticket-support.show-template');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            ResponseTemplate::on()->updateOrCreate(['id' => $request->id], [
                'user_id'   => Auth::user()->id,
                'template'  => $request->template,
            ]);

            return redirect()->route('admin.ticket-support');

        } catch ( Exception $e ) {
            return back()
                ->withInput()
                ->withErrors( $e->getMessage() );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ResponseTemplate $responseTemplate
     * @return View
     */
    public function edit(ResponseTemplate $responseTemplate): View
    {
        return view('admin.ticket-support.show-template', compact('responseTemplate'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ResponseTemplate $responseTemplate
     * @return RedirectResponse
     */
    public function destroy(ResponseTemplate $responseTemplate): RedirectResponse
    {
        try {
            $responseTemplate->delete();
        } catch (Exception $e) {
            return back()
                ->withErrors( $e->getMessage() );
        }
        return redirect()->route('admin.ticket-support');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TicketFront $ticketFront
     * @return RedirectResponse
     */
    public function destroyTicketFront(TicketFront $ticketFront): RedirectResponse
    {
        try {
            $ticketFront->delete();
        } catch (Exception $e) {
            return back()
                ->withErrors( $e->getMessage() );
        }
        return redirect()->route('admin.ticket-support');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TicketFront $ticketFront
     * @return View
     */
    public function editTicketFront(TicketFront $ticketFront): View
    {
        return view('admin.ticket-support.show-ticket-front', compact('ticketFront'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeTicketFront(Request $request): RedirectResponse
    {
        try {
            $content = [
                'email' => $request->email,
                'question' => $request->question,
                'answer' => $request->answer,
            ];
            Mail::to($request->email)->send(new TicketFrontMail($content));

            TicketFront::on()
                ->find($request->id)
                ->update(['answer' => $request->answer]);
            return redirect()->route('admin.ticket-support');
        } catch ( Exception $e ) {
            return back()
                ->withInput()
                ->withErrors( $e->getMessage() );
        }
    }
}
