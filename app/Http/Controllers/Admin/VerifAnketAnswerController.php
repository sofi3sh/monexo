<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\UserIp;
use App\Models\AttachUser;
use App\Models\Consts\AlertType;
use App\Models\FakeUser;
use App\Models\Home\Alert;
use App\Models\Home\Ipn;
use App\Models\User;
use App\Models\UserVerifTypes;
use App\Models\VerifAnketAnswer;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Log;
use Illuminate\Http\Request;
use Session;

class VerifAnketAnswerController extends Controller
{
    
    public function show() {
        $ankets = VerifAnketAnswer::
        with('user:id,name,email')
        ->get();

        return view('admin.verif.show', compact('ankets'));
    }

    public function client(Request $request) {
        $email = $request->route('email');
        $user = User::where('email', $email)->first();
        $anket = VerifAnketAnswer::where([
                'user_id' => $user->id,
        ])
        ->with('user:id,name,email')
        ->orderBy('created_at', 'desc')
        ->first();

        if($anket === null) {
            return view('admin.includes.partials.client.verify-anket', [
                'show' => false,
                'user' => $user
            ]);
        }

        // Совпадения по ip
        $ip      =  UserIp::where('user_id', $user->id)->first()->ip_last_auth ?? null;
        $ipUsers =  UserIp::where('ip_last_auth', $ip)
                            ->whereNotNull('ip_last_auth')
                            ->where('user_id', '!=', $user->id)
                            ->with('user')->get();

        // Совпадения по паспорту
        $documentAnketUsers = VerifAnketAnswer::where('user_id', '!=', $user->id)
                                          ->where('document', $anket->document)
                                          ->with('user:id,name,email')
                                          ->get();

        // Сверка по введенным данным и ранее вводимым
        $userInfo = [
            'system' => [
                'Имя'      => $user->name,
                'Фамилия'   => $user->surname,
                'Дата рождения'  => $user->birthday ? Carbon::parse($user->birthday)->format('Y.m.d') : null,
                'Телефон'     => $user->phone,
            ],
            'anket' => [
                'Имя'               => $anket->name,
                'Фамилия'           => $anket->surname,
                'Дата рождения'   => Carbon::parse($anket->birthday)->format('Y.m.d') ,
                'Номер паспорта'    => $anket->document,
                'Телефон для связи' => $anket->phone_anket,
                'Ответ на вопрос'   => $anket->getMultiAccountsAnswer(),
            ]
        ];
        
        $userTypes = UserVerifTypes::pluck('name', 'id');

        // фейки, но это не точно (пользователь сам вводил почты)
        $fakes = FakeUser::where('user_id', $user->id)->get();
        // для каких пользователей аккаунт является фейком
        $currentUserfakes = FakeUser::where('fake_id', $user->id)->get();
        
        // прикрепленные админом пользователи
        $attachedUsers = AttachUser::where('user_id', $user->id)->get();
        // для каких пользователей аккаунт является прикрепленным
        $currentUserAttached = AttachUser::where('attach_id', $user->id)->get();
        
        return view('admin.includes.partials.client.verify-anket', compact([
            'user',
            'anket',
            'ipUsers',
            'documentAnketUsers',
            'userInfo',
            'userTypes',
            'fakes',
            'currentUserfakes',
            'attachedUsers',
            'currentUserAttached'
        ]));

    }

    public function addAttached(Request $request)
    {
        $emails = $request->input('emails');

        if($emails !== null) {

            $accs = User::whereIn('email', $emails)->pluck('email', 'email')->toArray();
            
            if(count($accs) !== count($emails)) {
                $errors = "Error!\n";
                
                foreach($emails as $email) {
                    if(!in_array($email, $accs)) 
                    {
                        $errors .= "Аккаунта $email не существует в системе\n";
                    }
                }

                return response()->json([
                    'content' => $errors
                ]);
            }
        }

        $usersIds = User::select('id')->whereIn('email', $emails)->pluck('id')->toArray();
        $res = [];

        foreach($usersIds as $id) {
            $res [] = [
                'user_id' => $request->user_id,
                'attach_id' => $id,
            ];
        }

        AttachUser::insertOrIgnore($res);

        return response()->json([
            'content' => 'Аккаунты успешно прикреплены к пользователю с id #' . $request->user_id
        ]);
    }

    public function verife(Request $request) {
        
        $anket = VerifAnketAnswer::find($request->input('id'));
        $user = $anket->user;

        DB::beginTransaction();
        try {
            $anket->is_check = 1;
            $user->is_verif = 1;

            Alert::create([
                'user_id'   => $user->id,
                'alert_id'  => AlertType::ACCOUNT_VERIFY,
            ]);

            $anket->save();
            $user->save();
            DB::commit();
        }
        catch(\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', 'Что-то пошло не так. Сообщение об ошибке :' . $e->getMessage());
            DB::rollBack();
        }

        Session::flash('success', 'Пользователь ' . $user->email . ' успешно верифицирован');

        return redirect()->back();
    }

    public function refuse(Request $request) {
        
        $request->validate([
            'id' => 'exists:users,id',
            'add_info_ru' => 'required|string|min:2',
            'add_info_en' => 'required|string|min:2',
        ]);

        $anket = VerifAnketAnswer::find($request->input('id'));
        $user = User::find($anket->user_id);

        DB::beginTransaction();
        try {
            $anket->is_check = 1;
            $user->is_verif = 0;

            Alert::create([
                'user_id' => $user->id,
                'alert_id' => AlertType::ACCOUNT_NOT_VERIFY,
                'add_info' => [
                    'ru' => 'Причина: ' . $request->input('add_info_ru'),
                    'en' => 'Сause: ' . $request->input('add_info_en'),
                ]
            ]);

            $anket->save();
            $user->save();
            DB::commit();
        }
        catch(\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', 'Что-то пошло не так. Сообщение об ошибке :' . $e->getMessage());
            DB::rollBack();
        }

        Session::flash('success', 'Пользователю ' . $user->email . ' успешно отказано в верификации');

        return redirect()->back();
    }

    public function updateUserVerifeType(Request $request) {
        
        $validated = $request->validate([
            'id' => 'required|exists:user_verif_types,id',
            'user_id' => 'required|exists:users,id'
        ]);

        DB::beginTransaction();
        try {
            $user = User::find($validated['user_id']);
            $user->verif_type = $validated['id'];
            $user->save();
            DB::commit();
        }
        catch(\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            Session::flash('error', $e->getMessage());
        }

        Session::flash('success', 'Тип пользователя успешно обновлен');
        

        return redirect()->back();
    }


}
