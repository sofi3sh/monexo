<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\Ticket\StoreTicketFront;
use App\Models\Home\Rate;
use App\Models\Home\Quote;
use App\Models\Home\Events\Event;
use App\Http\Controllers\Backend\GlobalStatisticController;
use App\Models\Home\News;
use App\Models\Home\MarketingPlan;
use App\Models\Home\FAQ\Category as FAQCategory;
use App\Models\Home\Ticket\TicketFront;
use App\Models\Map;
use App\Models\NewsSubscribe;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

use App\Models\Partner;
use App\Services\RegulationsService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Session;
use Validator;
use Exception;

class FrontendController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['preventBackHistory']);
    }


    /**
     * Отображение главной страницы
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showHomePage()
    {
        // получение новых пакетов, разбитых на группы
        $marketingPlanGroups = MarketingPlan::getGroups();

        return view('frontend.home')->with([
            'globalStat' => GlobalStatisticController::get(),
            'marketingPlanGroups' => $marketingPlanGroups,
        ]);
    }


    /* BEGIN TEMP */
    public function newAffiliateProgram(): View
    {
//        $partners = Partner::whereNotNull('coordinates')->get();
        $quote = Quote::inRandomOrder()->first();
        $partnersMap = Map::find(1);

        return view('dinway.aflilate-program', compact('quote', 'partnersMap'));
    }

    public function newBlogtime(): View
    {
        $quote = Quote::inRandomOrder()->first();

        return view('dinway.blogtime', compact('quote'));
    }

    public function newBusinessgaming(): View
    {
        $quote = Quote::inRandomOrder()->first();

        return view('dinway.businessgaming', compact('quote'));
    }

    public function newBusinesspack(): View
    {
        $quote = Quote::inRandomOrder()->first();

        return view('dinway.businesspack', compact('quote'));
    }

    public function newEducation(): View
    {
        $quote = Quote::inRandomOrder()->first();

        return view('dinway.education', compact('quote'));
    }

    public function newFAQ(): View
    {
        return view('dinway.faq');
    }

    public function getFAQData(): JsonResponse
    {
        $categoriesWithQuestions = [];

        foreach (FAQCategory::with('questions:name,answer,category_id')
                     ->whereHas('questions')
                     ->select('id', 'name')
                     ->get() as &$category) {
            $questions = [];

            foreach ($category->questions as &$question) {
                $questions[] = [
                    'question' => $question->name,
                    'answer' => $question->answer,
                ];

                unset($question);
            }

            $categoriesWithQuestions[$category->name] = $questions;

            unset($category);
        }

        return response()->json($categoriesWithQuestions);
    }

    public function monexoIndex(): View
    {
        return view('monexo.index');
    }

    public function newIndex(): View
    {
        $quote = Quote::inRandomOrder()->first();
        // $partners = Partner::whereNotNull('coordinates')->get();
        $partnersMap = Map::find(1);
        return view('dinway.index', compact('quote', 'partnersMap'));
    }

    public function newEvents() : View
    {
        $events = Event::all();
        return view('dinway.events', compact('events'));
    }

    public function newInvestments(): View
    {
        $quote = Quote::inRandomOrder()->first();
        $partnersMap = Map::find(1);
        return view('dinway.investments',  compact('quote', 'partnersMap'));
    }

    public function newModals(): View
    {
        return view('dinway.modals');
    }

    public function newAgreement(): View
    {
        return view('dinway.agreement');
    }

    public function storeTicket(Request $request)
    {
        // Не хвтатало времени узнать, как передать на фронт инфу через Request класс
        $rules = [
                'ticket_full_name' => 'required',
                'ticket_email'     => 'required|email',
                'ticket_phone'     => 'required',
                'ticket_question'  => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, [
            'full_name.required'    => __('ticket.validation.full_name_required'),
            'email.required'        => __('ticket.validation.email_required'),
            'email.email'           => __('ticket.validation.email_email'),
            'phone.required'        => __('ticket.validation.phone_required'),
            'question.required'     => __('ticket.validation.question_required'),
        ]);


        if($validator->fails()) {
            return [
                'status' => 'error',
                'title' => __('dinway.modals.universe'),
                'content' => $validator->getMessageBag()
            ];
        }

        try {

            TicketFront::on()->create([
                'full_name' => $request->ticket_full_name,
                'email'     => $request->ticket_email,
                'phone'     => $request->ticket_phone,
                'question'  => $request->ticket_question,
            ]);


        } catch (Exception $e) {
            return [
                'status' => 'success',
                'title' => __('dinway.modals.universe'),
                'content' => [$e->getMessage()]
            ];
        }

        return [
            'status' => 'success',
            'title' => __('dinway.modals.universe'),
            'content' => __('ticket.front.success')
        ];
    }

    /* END TEMP */



    /**
     * Отображение страницы О нас
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAboutPage()
    {
        return view('frontend.about');
    }

    /**
     * Отображение страницы О нас
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showInvestmentsPage()
    {
        $quote = Quote::inRandomOrder()->first();

        // получение новых пакетов, разбитых на группы
        $marketingPlanGroups = MarketingPlan::getGroups();

        $marketingPlans = MarketingPlan::all();
        return view('frontend.investments', compact('marketingPlans', 'marketingPlanGroups', 'quote'));
    }

    /**
     * Отображение страницы Сервисов
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showServicesPage()
    {
        return view('frontend.services');
    }

    /**
     * Отображение страницы Портфолио
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPortfolioPage()
    {
        return view('frontend.portfolio');
    }

    /**
     * Отображение страницы Карьеры
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCareersPage()
    {
        return view('frontend.careers');
    }

    /**
     * Отображение страницы Контакты
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showContactsPage()
    {
        return view('frontend.contacts');
    }

    /**
     * Отображение страницы Новости
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newsList()
    {
        $news = News::orderBy('id','DESC')->paginate(15);
        $details = false;
        return view('frontend.news',compact('news','details'));
    }
    public function newsDetails($id)
    {
        $news = News::where('id',$id)->first();
        $details = true;
        return view('frontend.news',compact('news','details'));
    }

    /**
     * Отображение страницы FAQ
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFaqPage()
    {
        return view('frontend.faq');
    }

    /**
     * Отображение страницы FAQ
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPrivacyPage()
    {
        return view('frontend.privacy');
    }

    /**
     * Отображение страницы Копилка
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMoneyboxPage()
    {
        return view('frontend.moneybox');
    }

    /**
     * Отображение страницы Копилка
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLearningPage()
    {
        return view('frontend.learning');
    }

    public function newsEmailSubscribe(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:news_subscribes,email',
            'period' => [
                'required',
                Rule::in(['month', 'week'])
            ]
        ]);

        if($validator->fails()) {
            return [
                'status' => 'error',
                'title' => __('dinway.modals.universe'),
                'content' => $validator->getMessageBag()
            ];

        }

        $email = $request->input('email');
        $user = User::where('email', '=', $email)->first(); // null | integer

        NewsSubscribe::insert([
            'email' =>  $email,
            'period' => $request->input('period'),
            'user_id' => $user->id ?? null,
            'created_at' => Carbon::now()
        ]);


        return [
            'status' => 'success',
            'title' => __('dinway.modals.universe'),
            'content' => __('dinway.news-subscription.successMessage')
        ];
    }

    public function showRegulationsPage()
    {
        $sections = RegulationsService::getSections();

        return view('dinway.regulations', compact('sections'));
    }

}
