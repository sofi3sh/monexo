@php if($key == 6) return true; @endphp
<tr class="treegrid-{{ $children->id }} @if($key > 1)treegrid-parent-{{ $children->parent_id }}@endif">
    <td>
        <span style="display: inline-block">
        <strong>{{ $children->name }}</strong><br>
        <a style="color: inherit;" href="mailto:{{ $children->email }}">{{ $children->email }}</a>
        <a style="color: #858585;" href="tel:{{ $children->getPrettyPhone() }}">{{ $children->getPrettyPhone() }}</a>
        </span>
    </td>
    <td>@lang('base.dash.partners.table.level') {{ $key++ }}</td>
    <th><div style="display: inline-block" class="media align-items-center">{{$children->created_at}}</div></th>
    <td>${{ number_format($children->allmarketingPlanPartnerToUsd()['profit'], 2) }}</td>
    <td>${{ number_format($children->allmarketingPlanPartnerToUsd()['invested'], 2) }}</td>
</tr>
@foreach ($children->refferralsRecursive as $child)
    @include ('dashboard.recursive', [
        'children' => $child,
        'key' => ($children->id != $child->parent_id) ? $key++ : $key
    ])
@endforeach
