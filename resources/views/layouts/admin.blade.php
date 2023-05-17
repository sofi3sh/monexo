<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Scripts --}}
    {{-- Где-то конфликт. faq accrdion не работает --}}
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    {{-- Styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('backend/css/fonts.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/css/main.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/css/media.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/libs/hint.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}"/>
    <link rel="stylesheet"
          href="{{ asset('https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css') }}"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>

    {{--include summernote css/js--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
    <style type="text/css">
        .modal-backdrop {
            display: none;
        }
    </style>
    @yield('css')
</head>

<body>
<div class="wrapper">
    {{--@include('backend.includes.partials.header')--}}
    <div class="sub-header">
        <div class="d-flex align-items-center">
            <div id="nav-icon1" class="nav_toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        {{--<div class="sub-header__balance">
            Баланс: ${{ number_format(11, 2) }}
        </div>--}}
    </div>

    {{-- Page Content --}}
    <main class="py-4" id="app">
        @include('admin.includes.partials.nav')
        <div class="content content--admin ">
            @if($errors->hasAny())
                <div class="alert alert-danger px-5">
                    <ul>
                        @foreach ($errors as $error)
                            {{$error}}
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success px-5">
                    {{Session::get('success')}}
                </div>
            @endif


            
            @yield('content')
        </div>
    </main>
</div>

{{-- без integrity не работает dropdown-menu  --}}
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{ asset('backend/libs/clipboard.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>


{{--<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>--}}

<script src="{{ asset('backend/js/common.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
{{-- todo Этому здесь не место --}}
<script>
    $(document).ready(function () {
        $('.table').not('.without-datatable').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
                },
                "pageLength": 10,
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
            }
        );

        $('.table1').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
                },
                "searching": false,
                "bLengthChange": false,
                "pageLength": 10,
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
            }
        );

        $('.table2').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
                },
                "searching": false,
                "bLengthChange": false,
                "pageLength": 10,
                "order": [[ 0, "desc" ]],
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
            }
        );

        $('.table3').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
                },
                "searching": false,
                "bLengthChange": false,
                "pageLength": 10,
                "order": [[ 1, "desc" ]],
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
            }
        );



    });
</script>

@yield('scripts')

</body>
</html>
