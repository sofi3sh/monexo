<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FakeUser;
use App\Models\User;
use App\Models\UserVerifTypes;
use App\Models\VerifAnketAnswer;
use Auth;
use Carbon\Carbon;

use DB;
use Illuminate\Validation\Rule;
use Log;
use Session;
use Validator;

class VerifAnketAnswerController extends Controller
{
    
    public function store(Request $request) {
        
        $rules = [
            'surname' => 'required|string|min:2',
            'name' => 'required|string|min:2',
            'birthday' => 'required|date',
            'phone_anket' => 'required|min:5|max:20',
            'phone_verif' => 'required|integer|min:0|max:1',
            'document' => [
                Rule::requiredIf(function() {
                    return ($_REQUEST['phone_verif'] ?? null)  == 0;
                }),
            ],
            'photo' => [
                Rule::requiredIf(function() {
                    return ($_REQUEST['phone_verif'] ?? null)  == 0;
                }),
                'file',
                'mimes:jpeg,png,jpg,svg'
            ],
            'multi_accounts' => 'required|integer|min:1|max:4',
            'multi_emails_list' => [
                Rule::requiredIf(function() {
                    return ($_REQUEST['multi_accounts'] ?? null) == 3 ;
                }),
                'array',
            ],
            'truth-anwers' => [
                Rule::requiredIf(function() {
                    return ($_REQUEST['multi_accounts'] ?? null) == 3 ;
                }),
                Rule::in(['on'])
            ],
            'truth-rules' => [
                'required',
                Rule::in(['on'])
            ],
        ];

        $messages = [
            'surname.required' => __('verif-anket.errors.validation.required.surname'),
            'name.required' => __('verif-anket.errors.validation.required.name'),
            'birthday.required' => __('verif-anket.errors.validation.required.birthday'),
            'phone_anket.required' => __('verif-anket.errors.validation.required.phone_anket'),
            'document.required' => __('verif-anket.errors.validation.required.document'),
            'photo.required' => __('verif-anket.errors.validation.required.photo'),
            'multi_accounts.required' => __('verif-anket.errors.validation.required.multi_accounts'),
            'multi_emails_list.required' => __('verif-anket.errors.validation.required.multi_emails_list'),
            'truth-anwers.required' => __('verif-anket.errors.validation.required.truth-rules'),
            'truth-rules.required' => __('verif-anket.errors.validation.required.truth-anwers'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if($validator->fails()) {
            return [
                'status' => 'error',
                'title' => __('dinway.modals.universe'),
                'content' => $validator->getMessageBag()
            ];
        } 

        if($request->multi_emails_list !== null) {

            $emails = $request->multi_emails_list;
            $multiAccs = User::whereIn('email', $emails)->pluck('email', 'email')->toArray();

            
            if(count($multiAccs) !== count($emails)) {
                $errors = [];
                
                foreach($emails as $email) {
                    if(!in_array($email, $multiAccs)) {
                        $errors []= __('verif-anket.errors.not-email', ['email' => $email]);
                    }
                }

                return [
                    'status' => 'custom-error',
                    'title' => __('dinway.modals.universe'),
                    'content' => $errors
                ];
            }
        }

        $data = $validator->validated();

        $data['birthday'] = Carbon::parse($data['birthday']);
        
        DB::beginTransaction();
        try {
            
            $anket = VerifAnketAnswer::create(array_merge($data, [
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now()
                ])
            );
            
            if (($file = $request->file('photo')) && !$anket->phone_verif) {
                $fileExtension = $file->getClientOriginalExtension();
                $fileNameToStore = hash('sha256', 'anket-document' . $anket->id) . '.' . $fileExtension;
                $filePath = $file->storeAs('public/uploads', $fileNameToStore);
                $anket->photo = $filePath;
            } else if(!$anket->phone_verif) {
                throw new \Exception(__('verif-anket.errors.photo'));
            }
            
            $emails = $request->multi_emails_list;
            
            if($emails !== null && count($emails) > 0) {
                
                $fakeUsersId = User::select('id')->whereIn('email', $emails)->pluck('id')->toArray();
                $res = [];

                foreach($fakeUsersId as $fakeId) {
                    
                    $res [] = [
                        'user_id' => Auth::user()->id,
                        'fake_id' => $fakeId,
                    ];

                }

                FakeUser::insertOrIgnore($res);
            }
            
            $anket->save();
            DB::commit();
        }
        catch(\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return [
                'status' => 'custom-error',
                'title' => __('dinway.modals.universe'),
                'content' => [$e->getMessage()]
            ];
        }

        return [
            'status' => 'success',
            'title' => __('dinway.modals.universe'),
            'content' => __('verif-anket.success')
        ];
    }
}
