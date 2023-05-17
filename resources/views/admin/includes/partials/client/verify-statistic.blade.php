<div class="container">
    {{-- Верифицировать email --}}
    <div class="row">
        <div class="col-lg-12">
            {{--{{ dd($user->id) }}--}}
            @if(!$user->email_verified_at)
                <form action="{{ route('admin.email-verified', $user->id) }}" method="POST">
                    @csrf
                    <div class="input-row">
                        <button type="submit" class="button button--middle">Верифицировать Email</button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <div class="row">
        {{-- Сделать фейковым/реальным --}}
        <div class="col-lg-12">
            <form action="{{ route('admin.change-fake', $user->id) }}" method="POST">
                @csrf
                @if($user->fake)
                <div class="user-fake-or-real">
                    <h4>Статус: <h5 style="color: #221bd6">Фейк</h5></h4>
                    <button type="submit" class="login-page__submit login-block__submit button">Сделать реальным</button>
                </div>
                @else
                <div class="user-fake-or-real">
                    <h4>Статус: <h5 style="color: #221bd6">Реальный</h5></h4>
                    <button type="submit" class="login-page__submit login-block__submit button">Сделать фейковым</button>
                </div>
                @endif
            </form>
        </div>
        <div class="col-lg-12">
            <form action="{{ route('admin.change-ancestor') }}" method="POST">
                @csrf
                {{-- Скрытые поля --}}
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="admin--move_under">
                    <div class="move_under-block">
                        <label for="move_under">Поместить под:</label>
                        <input type="text" name="move_under" required class="form-control" placeholder="email">
                    </div>
                    <button type="submit" class="login-page__submit login-block__submit button">Подтвердить</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Отключить 2FA --}}
    <div class="row">
        <div class="col-lg-12">
        {{--@if(!$user->______)
            <form action="{{ route('admin.disable-2fa', $user->id) }}" method="POST">
                @csrf
                <div class="input-row">
                    <button type="submit" class="button button--middle">Отключить 2FA</button>
                </div>
            </form>
        @endif--}}
        </div>
    </div>
</div>