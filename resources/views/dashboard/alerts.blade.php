@extends('dashboard.app')

@section('css')
    <style type="text/css">
        .dataTables_wrapper .dataTables_paginate a {
            padding: 8px;
            cursor: pointer;
        }

        .dataTables_wrapper .dataTables_paginate a.current {
            z-index: 3;
            color: #ffffff;
            border: none !important;
            background-color: #B6F2CC !important;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 15px;
            margin-left: 13px;
        }

        .dataTables_info {
            margin-left: -3px !important;
        }

        .dataTables_paginate.paging_simple_numbers {
            min-width: 530px;
            display: flex;
            flex-direction: row;
            align-items: baseline;
            padding-bottom: 20px;
        }

        #table-notifications td {
            vertical-align: middle;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .alerts-table td,
        th {
            max-width: 320px;
        }
        #currency_type,
        #add_info {
            overflow: hidden;
            text-indent: -9999px;
        }

    </style>
@endsection


@section('content')

    <div class="header">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center pt-3">
                    <div class="col-md-4 col-12">
                        <h6 class="h2 text-white d-inline-block">@lang('base.dash.menu.alerts')</h6>
                    </div>
                    <div class="col-md-8 col-12 text-md-right text-left">
                        <a href="javascript:" data-tab="all"
                            class="btn btn-neutral tab-item mb-1">@lang('base.dash.alerts.title.all')</a>
                        <a href="javascript:" data-tab="balance"
                            class="btn btn-neutral tab-item mb-1">@lang('base.dash.alerts.title.balance')</a>
                        <a href="javascript:" data-tab="investments"
                            class="btn btn-neutral tab-item mb-1">@lang('base.dash.alerts.title.investments')</a>
                        <a href="javascript:" data-tab="partners"
                            class="btn btn-neutral tab-item mb-1">@lang('base.dash.alerts.title.partners')</a>
                        <!-- <a href="javascript:" {{-- data-tab="transfers" --}}
                            class="btn btn-neutral {{-- tab-item mb-2 --}} disabled">@lang('base.dash.alerts.title.transfers') (@lang('base.general.soon'))</a>
                        @if (!auth()->user()->telegram_id)
                            <a href="#" data-toggle="modal" data-target="#modal-guide-telegram"
                                class="btn btn-neutral disabled">@lang('base.dash.alerts.telegram.connect') (@lang('base.general.soon'))</a>
                        @endif -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-6">
        <div id="buffer_filter" style="display: none">all</div>
        <div class="card">
            <div class="card-header border-0">
                <h3 class="mb-0" id="title-alert">@lang('base.dash.alerts.title.all')</h3>
            </div>
            <div class="table-responsive overflow-auto">
                <table class="table table-flush alerts-table" id="table-notifications">
                    <thead class="bg-gradient-green">
                        <tr>
                            <th id="date" scope="col">@lang('base.dash.alerts.history.date')</th>
                            <th id="email" scope="col">@lang('base.dash.alerts.history.email')</th>
                            <th id="type" scope="col">@lang('base.dash.alerts.history.type')</th>
                            <th id="volume" scope="col">@lang('base.dash.alerts.history.volume')</th>
                            <!-- <th id="currency_type" scope="col">@lang('base.dash.alerts.history.currency_type')</th>
                            <th id="add_info" scope="col">@lang('base.dash.alerts.history.add_info')</th> -->
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <div id="modal-guide-telegram" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">@lang('base.dash.alerts.telegram.modal_title')</div>
                <div class="modal-body">
                    <div class="telegram-default">
                        <p>
                            @lang('base.dash.alerts.telegram.modal_description')
                        </p>
                        <div>
                            <script async src="https://telegram.org/js/telegram-widget.js?14"
                                data-telegram-login="{{ env('TG_BOT_NAME') }}" data-size="large"
                                data-onauth="onTelegramAuth(user)" data-request-access="write"></script>
                        </div>
                        <p>@lang('base.dash.alerts.telegram.modal_hint')</p>
                    </div>
                    <div class="telegram-success" style="display: none">
                        <p>@lang('base.dash.alerts.telegram.modal_success')</p>
                    </div>
                    <button class="btn btn-primary js-decline-close-investment"
                        data-dismiss="modal">@lang('website_home.guide.close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        function onTelegramAuth(user) {
            $.post('{{ route('home.changeTelegramId') }}', {
                id: user.id,
                "_token": "{{ csrf_token() }}",
            }, function() {
                $('.telegram-default').fadeOut(function() {
                    $('.telegram-success').fadeIn()
                });
            });
        }

    </script>
    <script>
        $(function() {
            /**
             * Языковые настройки для таблицы
             */
            let langMap = {
                en: {
                    path: 'English',
                    mods: {
                        sLengthMenu: "Display _MENU_ records per page - custom test"
                    }
                },
                ru: {
                    path: 'Russian',
                    mods: {
                        sLengthMenu: "Отображение записей _MENU_ на странице-пользовательский тест"
                    }
                }
            };

            /**
             * Для выброног в интерфейсе языка вернет json.
             * Набор элементов с описанием этих элементов на выбранном языке.
             */
            function getLanguage() {
                let lang = $('html').attr('lang');
                let path = '//cdn.datatables.net/plug-ins/1.10.13/i18n/';
                let result = null;
                $.ajax({
                    async: false,
                    url: path + langMap[lang].path + '.json',
                    success: function(obj) {
                        result = $.extend({}, obj, langMap[lang].mods)
                    }
                })
                return result;
            }

            /**
             * Настраиваем таблицу уведомлений и заполняем ее куском данных с сервера
             *
             * @type {jQuery}
             */
            let tableNotifications = $('#table-notifications').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                language: getLanguage(),
                pageLength: 20,
                searching: false,
                bLengthChange: false,
                order: [
                    [0, "desc"]
                ],
                ordering: false,
                columnDefs: [{
                    className: "dt-center",
                    targets: "_all",
                    visible: true
                }],
                ajax: {
                    url: "{{ url('home/notifications') }}",
                    contentType: 'application/json',
                    type: 'GET',
                    data: function(d) {
                        d.currentfilter = $('#buffer_filter').text();
                    }
                },
                preDrawCallback: function( settings ) {
                    $('#currency_type, #add_info').css('text-indent', '0');
                },
                columns: [{
                        data: 'created_at',
                        id: 'date'
                    },
                    {
                        data: 'email',
                        id: 'email'
                    },
                    {
                        data: 'type_name',
                        id: 'type'
                    },
                    {
                        data: 'volume',
                        id: 'volume'
                    },
                    {
                        data: 'payment_system',
                        id: 'currency_type',
                        visible: false,
                    },
                    {
                        data: 'add_info',
                        id: 'add_info',
                        visible: false,
                    }
                ]
            });

            /**
             * Обработчик кнопок фильтра
             *
             * <Все> <Баланс> <Инвестиции> <Партнеры>
             */
            $(document).off('click', '.tab-item').on('click', '.tab-item', function(e) {
                e.preventDefault();

                let textButtonFilter = $(this).data('tab'); // id нажатой кнопки

                // В скрытый див сохраняем ид кнопки. Потом прочитаем это когда аяксом будем отправлять
                $('#buffer_filter').text(textButtonFilter);

                // Считываем надпись на кнопке и записываем в заголовок для листа.
                $('#title-alert').html($(this).text());

                function setNotificationsTable(settings = null) {
                    let arraySettings = [true, true, true, true, true, true];

                    let map = {
                        'date': 0,
                        'email': 1,
                        'type': 2,
                        'volume': 3,
                        'system': 4,
                        'add_info': 5
                    }

                    if (settings) {
                        for (let key in settings) {
                            arraySettings[map[key]] = settings[key];
                        }
                    }

                    arraySettings.forEach((val, index) => {
                        tableNotifications.column(index).visible(val);
                    });

                }

                let tableSettigs = {
                    'all': {
                        'system': false,
                        'add_info': false
                    },
                    'balance': {
                        'email': false,
                        'add_info': false,
                        'system': true,
                    },
                    'investments': {
                        'email': false,
                        'system': false,
                        'add_info': false
                    },
                    'partners': {
                        'add_info': false,
                        'system': false
                    },
                    {{-- 'transfers': {
                        'system': false,
                        'add_info': true,
                    } --}}
                }

                setNotificationsTable(tableSettigs[textButtonFilter]);

                // Обновляем лист
                $('#table-notifications').DataTable().ajax.reload();
            })
        });
    </script>
@endsection
