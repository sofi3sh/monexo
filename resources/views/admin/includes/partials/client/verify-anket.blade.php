@extends('layouts.admin')

@section('css')
    <style>
        .btn {
            width: initial !important;
        }

        button.btn.btn-success {
            color: white !important;
            background-color: #28a745 !important;
        }

        button.btn.btn-success:hover {
            background-color: #1E7E3A !important;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid px-5 pb-5">
        @if(isset($show) && !$show)
            <h1 class="h2 text-center">Не заполнял анкету</h1>
            <a class="btn btn-primary" href="{{url()->previous()}}">Назад</a>
            <a class="btn btn-secondary" href="{{ route('admin.verif.show') }}">К таблице</a>
        @else
            <a href="{{ route('admin.verif.show') }}">К таблице</a>
            <h1 class="h2 text-center mb-3">
                Верификация клиента
                @if ($user->is_verif)
                    <span class="text-success">Верифицирован</span>
                @endif
            </h1>
            <div class="row">
                @if(!$anket->phone_verif)
                    <div class="col-md-6">
                        <div class="d-flex justify-content-center" style="max-width: 700px">
                            <img style="max-width: 100%" src="{{ $anket->photo }}" alt="">
                        </div>
                        <a href="{{ $anket->photo }}" target="_blank">Открыть в браузере</a>
                    </div>
                    @else 
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <b>Пользователь хочет пройти верификацию по телефону</b>
                    </div>
                @endif

                <div class="col-md-6">
                    <h2 class="h4 mt-3">Данные в системе:</h2>
                    @foreach ($userInfo['system'] as $key => $value)
                        @php $value ??= '-' @endphp
                        <p>{!! "<b>$key:</b> $value " !!}</p>
                    @endforeach
                    <h2 class="h4 mt-3">Данные из анкеты:</h2>
                    @foreach ($userInfo['anket'] as $key => $value)
                        @php $value ??= '-' @endphp
                        <p>{!! "<b>$key:</b> $value " !!}</p>
                    @endforeach
                </div>

                <div class="col-md-6">
                    <h2 class="h4 mt-3">Что там по ip?</h2>
                    @if ($ipUsers !== null && count($ipUsers) > 0)
                        Такой же ip имеют следующие пользователи:
                        @foreach ($ipUsers as $uIp)
                            <div>
                                <a
                                    href="{{ route('admin.client.verify', $uIp->user->email) }}">{{ $uIp->user->email }}</a>
                            </div>
                        @endforeach
                    @else
                        Не найдено совпадений по ip
                    @endif

                    <h2 class="h4 mt-3">Что там с паспортом?</h2>
                    @if ($ipUsers !== null && count($ipUsers) > 0)
                        Такой же номер паспорта имеют следующие пользователи:
                        @foreach ($documentAnketUsers as $a)
                            <div>
                                <a
                                    href="{{ route('admin.client.verify', $a->user->email) }}">{{ $a->user->email }}</a>
                            </div>
                        @endforeach
                    @else
                        Не найдено совпадений по номеру паспорта
                    @endif

                    <h2 class="h4 mt-3">Что там с фейками?</h2>
                    @if ($fakes !== null && count($fakes) > 0)
                        Пользователь сказал, что это его фейки:
                        <ul class="ml-3">
                            @foreach ($fakes as $fake)
                                <li>
                                    <a
                                        href="{{ route('admin.client.verify', $fake->fake->email) }}">{{ $fake->fake->email }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        Фейков не найдено
                    @endif

                    @if ($currentUserfakes !== null && count($currentUserfakes) > 0)
                        Пользователь является фейком для (по словам тех, кто ниже):
                        <ul class="ml-3">
                            @foreach ($currentUserfakes as $fake)
                                <li>
                                    <a href="{{ route('admin.client.verify', $fake->fake->email) }}">{{ $fake->fake->email }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        Пользователь не является чьим-либо фейком (исходя из данных анкет)
                    @endif
                    

                    <h2 class="h4 mt-3">Изменить тип пользователя</h2>
                    <form action="{{ route('admin.verif.updateUserVerifeType') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <div class="input-group" style="max-width: 450px; gap: 10px">
                                <select name="id" class="form-control">
                                    @foreach ($userTypes as $id => $type)
                                        <option value="{{ $id }}" @if ($id === $user->verif_type) selected @endif>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-secondary">Изменить</button>
                            </div>
                           
                        </div>
                    </form>

                    <form action="{{ route('admin.verif.verife') }}" method="POST" style="margin-right: 5px">
                        @csrf
                        @method('PATCH')
                        <h3 class="h5 mb-2">Верификация</h3>
                        <input name="id" type="hidden" value="{{ $anket->id }}">
                        <button type="submit" class="btn btn-success">Верифицировать</button>
                    </form>
                    <form action="{{ route('admin.verif.refuse') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <hr>
                        <h3 class="h5 mb-2">Отказ</h3>
                        <div class="form-group">
                            <label for="">Причина на русском:</label>
                            <textarea class="form-control" id="add_info_ru" name="add_info_ru" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Причина на английском:</label>
                            <textarea class="form-control" id="add_info_en" name="add_info_en" rows="3"></textarea>
                        </div>
                        <input name="id" type="hidden" value="{{ $anket->id }}">
                        <button type="submit" class="btn btn-danger">Отказать</button>
                    </form>
                    
                </div>

                @php $userStatistic = new App\Models\UserStatisticFull($user) @endphp
                <div class="col-md-6">
                    <h2 class="h4">Статистика</h2>
                    <b>Общая инвестированная (в планы) сумма: </b> ${{ $user->invested_usd }} <br>
                    <b>Долг компании:</b> ${{ $user->debt_usd }} <br>
                    <b>Баланс:</b> ${{ $user->balance_usd }} <br>
                    <b>Общая заработанная сумма:</b> ${{ $user->profit_usd }} <br>
                    <b>Всего пополнений:</b> ${{ $userStatistic->getAllReplenishment() }} <br>
                    <b>Вывел:</b> ${{ $userStatistic->getAllWithdrawal() }} <br>
                    <b>Прибыль по партнерке: </b> ${{ $userStatistic->getProfitAffiliateProgram() }} <br>
                    <b>Количество партнеров: </b> {{ $userStatistic->getReferralsCount() }} <br>
                    <b>Получил переводом:</b> ${{ $userStatistic->receivedByTransfer() }} <br>
                    <b>Перевел кому-то:</b> ${{ $userStatistic->sendByTransfer() }}<br>

                    <h2 class="h4 mt-3">Прикрепить аккаунт(ы)</h2>

                    <form id="form-accs">
                        <div class="form-group">
                            <div class="accs">
                                <div class="input-group mb-2">
                                    <input class="form-control" type="text" name="acc">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Прикрепить</button>
                            <button type="button" class="btn btn-secondary" onclick="addEmail()">Ещё</button>
                        </div>
                    </form>
                    
                    

                    @if(isset($attachedUsers) && count($attachedUsers) > 0)
                        <h2 class="h4 mt-3">Прикрепленные аккаунты:</h2>
                        <ul class="ml-3">
                            @foreach ($attachedUsers as $aUser)
                                <li>
                                    <a href="{{ route('admin.client.verify', $aUser->attach->email) }}">{{ $aUser->attach->email }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if(isset($currentUserAttached) && count($currentUserAttached) > 0)
                        <h2 class="h4 mt-3">Аккаунт прикреплен за:</h2>
                        <ul class="ml-3">
                            @foreach ($currentUserAttached as $u)
                                <li>
                                    <a href="{{ route('admin.client.verify', $u->user->email) }}">{{ $u->user->email }}</a>
                                </li>
                            @endforeach
                        </ul>
                        @else 
                        Аккаунт ни к кому не прикреплен
                    @endif

                </div>
                
            </div>
        @endif
    </div>
@endsection


@section('scripts')
    <script defer>
        
        const accs = document.querySelector('.accs');

        function addEmail() {
                accs.insertAdjacentHTML('beforeend', `
                    <div class="input-group mb-2">
                        <input class="form-control" name="acc" type="email">
                        <button class="btn btn-danger" onclick="removeEmail.call(this)">X</button>
                    </div>
                `);
            }

        function removeEmail() {
            this.closest('.input-group').remove();
        }

        !function() {
            const form = document.querySelector('#form-accs');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                const emails = formData.getAll('acc');

                emails.forEach(email => {
                    formData.append('emails[]', email);
                });

                formData.delete('acc');
                formData.append('user_id', "{{$user->id}}");
                fetch("{{ route('admin.verif.addAttached') }}", {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        method: 'POST',
                        body: formData
                })
                .then(res => res.json())
                .then(res => alert(res.content))
                .catch(alert)

            });

        }();
        
    </script>


@endsection