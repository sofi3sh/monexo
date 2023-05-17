@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>
                @if(session('status'))
                    <div class="alert alert-info">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <div class="admin-content-block admin-content-block--no-table-radius">
                    <h3>Фиксация ip-адреса пользователя</h3>

                    <div class="container-fluid">
                        <form class="row" action="{{ route('admin.user-ip') }}" method="get">
                            <div class="input-group col-3 mb-2">
                                <input class="form-control" name="search" id="ip-search" placeholder="Поиск" value="{{ request('search') }}" type="text">
                            </div>

                            <div class="form-group row col-3">
                                <label for="inputPassword" class="col-sm-7 col-form-label text-nowrap">На странице:</label>
                                <div class="col-sm-5 pl-0">
                                    <select class="form-control" name="per_page">
                                        <option value="25" {{ request('per_page') == 25 ? 'selected="selected"' : '' }}>25</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected="selected"' : '' }}>50</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected="selected"' : '' }}>100</option>
                                        <option value="200" {{ request('per_page') == 200 ? 'selected="selected"' : '' }}>200</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row col-4">
                                <label for="inputPassword" class="col-sm-4 col-form-label text-nowrap">Сортировка:</label>
                                <div class="col-sm-8 pl-0">
                                    <select class="form-control" name="sort">
                                        <option value="updated_at" {{ request('sort') == 'updated_at' ? 'selected="selected"' : '' }}>по дате авторизации</option>
                                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected="selected"' : '' }}>по дате регистрации</option>
                                        <option value="popularity" {{ request('sort') == 'popularity' ? 'selected="selected"' : '' }}>по популярности</option>
                                    </select>
                                </div>
                            </div>


                            <button type="submit" value="get_stats" class="form-control col-2 btn btn-success">Показать</button>
                        </form>
                    </div>


                    <table class="table table-striped without-datatable text-center">
                        <thead>
                        <tr>
                            <th class="text-center">User</th>
                            <th class="text-center">IP Auth</th>
                            <th class="text-center">IP Reg</th>
                            <th class="text-center">Девайс</th>
                            <th class="text-center">ОС</th>
                            <th class="text-center">Браузер</th>
                            <th class="text-center">Регистрация</th>
                            <th class="text-center">Авторизация</th>
                        </tr>
                        </thead>
                        <tbody>
                        @isset($usersIps)
                            @foreach($usersIps as $userIp)
                                <tr>
                                    <td class="text-left">
                                        <a href="{{ route('admin.client', ['id' => $userIp->user_id]) }}">
                                            {{ $userIp->user_name }} {{ $userIp->user_surname }} ({{ $userIp->user_email }})
                                        </a>
                                    </td>
                                    <td class="px-2">{{$userIp->ip_last_auth}}</td>
                                    <td class="px-2">{{$userIp->ip_registration}}</td>
                                    <td>{{$userIp->device}}</td>
                                    <td>{{$userIp->platform}}</td>
                                    <td>{{$userIp->browser}}</td>
                                    <td>{{$userIp->created_at}}</td>
                                    <td>{{$userIp->updated_at}}</td>
                                </tr>
                            @endforeach
                        @endisset
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $usersIps->onEachSide(5)->appends(request()->except('page'))->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $( "#ip-search" ).autocomplete({
            source: "{{ route('admin.user-ip-search') }}",
            minLength: 2,
            select: function( event, ui ) {

            }
        });
    </script>

@endsection
