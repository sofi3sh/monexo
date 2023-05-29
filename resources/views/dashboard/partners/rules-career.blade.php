<div id="rules-career" class="collapse partner">
    <section class="partner_tabel section" style="
    background: white;
    padding: 2%;
    border-radius: 10px;
">
{{--        <img src="{{ asset('monexo/partners-en.svg') }}">--}}
        <table border="2">
            <tr>
                <td>
                    <dl>
                        <dt>@lang('website_careers.table.table_header.level')</dt>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>@lang('website_careers.table.table_header.bonus')</dt>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>@lang('website_careers.table.table_header.personal_deposit')</dt>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>@lang('website_careers.table.table_header.first_line_turnover')</dt>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>@lang('website_careers.table.table_header.royalty_bonus')</dt>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>@lang('website_careers.table.table_header.invites_investor')</dt>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>@lang('website_careers.table.table_header.matching_bonus')</dt>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>@lang('website_careers.table.table_header.matching_bonus_2')</dt>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>@lang('website_careers.table.table_header.matching_bonus_3')</dt>
                    </dl>
                </td>
            </tr>
            @foreach(\App\Models\Home\Bonus::tableData() as $rowData)
            <tr>
                <td>
                    <dl>
                        <dd>{{ $rowData['level'] }}</dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dd>{{ $rowData['bonus'] }}</dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dd>{{ $rowData['personal_deposit'] }}</dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dd>{{ $rowData['team_turnover'] }}</dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dd>{{ $rowData['royalty_bonus'] }}</dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dd>{{ $rowData['invites_investor'] }}</dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dd>{{ $rowData['matching_bonus'] }}</dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dd>{{ $rowData['matching_bonus_2'] }}</dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dd>{{ $rowData['matching_bonus_3'] }}</dd>
                    </dl>
                </td>
            </tr>
            @endforeach
        </table>

{{--      <div class="tabel_info">--}}
{{--            <div class="tabel_header">@lang('website_careers.table.table_header.level')</div>--}}
{{--            <div class="tabel_header">@lang('website_careers.table.table_header.bonus')</div>--}}
{{--            <div class="tabel_header">@lang('website_careers.table.table_header.personal_deposit')</div>--}}
{{--            <div class="tabel_header">@lang('website_careers.table.table_header.first_line_turnover')</div>--}}
{{--            <div class="tabel_header">@lang('website_careers.table.table_header.matching_bonus')</div>--}}
{{--            <div class="tabel_header">@lang('website_careers.table.table_header.invites_deposit')</div>--}}
{{--            <div class="tabel_header">@lang('website_careers.table.table_header.regional_representative')</div>--}}
{{--            <div class="tabel_header"></div>--}}
{{--            <div class="tabel_header">@lang('website_careers.table.table_header.leadership_bonus')</div>--}}

{{--            @foreach(\App\Models\Home\Bonus::tableData() as $rowData)--}}

{{--                <div class="tabel_info_item">{{ $rowData['level'] }}</div>--}}
{{--                <div class="tabel_info_item">{{ $rowData['bonus'] }}</div>--}}
{{--                <div class="tabel_info_item">{{ $rowData['personal_deposit'] }}</div>--}}
{{--                <div class="tabel_info_item">{{ $rowData['team_turnover'] }}</div>--}}
{{--                <div class="tabel_info_item">{{ $rowData['matching_bonus'] }}</div>--}}
{{--                <div class="tabel_info_item">{{ $rowData['is_invitation_deposit_available'] }}</div>--}}
{{--                <div class="tabel_info_item">{{ $rowData['is_regional_representative_status_available'] }}</div>--}}
{{--                <div class="tabel_info_item"></div>--}}
{{--                <div class="tabel_info_item">{{ $rowData['leadership_bonus'] }}</div>--}}

{{--            @endforeach--}}
{{--        </div>--}}
    </section>
</div>
