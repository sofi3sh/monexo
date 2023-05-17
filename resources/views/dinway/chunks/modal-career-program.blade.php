{{-- Карьерная программа --}}
<div class="modal micromodal-slide modal-career-program" id="modal-career-program" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container modal__container--big" style="overflow: initial" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <div class="modal__header">
                <h3 class="modal__title" id="modal-title">
                    @lang('dinway.modal-career-program.title')
                </h3>
                <button class="modal__close" aria-label="@lang('dinway.modal-career-program.close')" data-micromodal-close></button>
            </div>
            <p class="modal-career-program__text">@lang('dinway.modal-career-program.descr')</p>
            <div class="table-wrap modal-career-program__table-wrap">
                <table class="table-fixed table--blue modal-career-program__table">
                    <thead>
                        <tr>
                            <th class="col-1">@lang('website_careers.table.table_header.level')</th>
                            <th class="col-2">@lang('website_careers.table.table_header.bonus')</th>
                            <th class="col-3">@lang('website_careers.table.table_header.personal_deposit')</th>
                            <th class="col-4">@lang('website_careers.table.table_header.first_line_turnover')</th>
                            <th class="col-5">@lang('website_careers.table.table_header.matching_bonus')</th>
{{--                            <th class="col-6">@lang('website_careers.table.table_header.leadership_bonus')</th>--}}
                            <th class="col-7">@lang('website_careers.table.table_header.invites_deposit')</th>
                            <th class="col-8">@lang('website_careers.table.table_header.regional_representative')</th>
                            <th class="col-1"></th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach(\App\Models\Home\Bonus::tableData() as $rowData)
                            <tr>
                                <td class="col-1">{{ $rowData['level'] }}</td>
                                <td class="col-2">{{ $rowData['bonus'] }}</td>
                                <td class="col-3">{{ $rowData['personal_deposit'] }}</td>
                                <td class="col-4">{{ $rowData['team_turnover'] }}</td>
                                <td class="col-5">{{ $rowData['matching_bonus'] }}</td>
{{--                                <td class="col-6">{{ $rowData['leadership_bonus'] }}</td>--}}
                                <td class="col-7">{{ $rowData['is_invitation_deposit_available'] }}</td>
                                <td class="col-8">{{ $rowData['is_regional_representative_status_available'] }}</td>
                                <td class="col-1"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal__footer">
                <a
                    class="modal__btn btn-blue"
                    @guest
                        href="{{route('login')}}"
                    @else
                        href="{{route('home.referrals')}}"
                    @endguest
                >@lang('dinway.btns.more')</a>
            </div>
        </div>
    </div>
</div>
