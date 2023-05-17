<table class="table" id="table">
    <thead>
    <tr>
        <th class="text-center">id</th>
        <th class="text-center">Процент начисл.</th>
        <th class="text-center">Процент (мес.)</th>
        <th class="text-center">Начали</th>
        <th class="text-center">Закончили</th>
        <th class="text-center">Комментарий</th>
        {{--<th class="text-center">meta</th>--}}
    </tr>
    </thead>
    <tbody>
    @foreach($accruals as $accrual)
        <tr>
            <td aria-label="id">{{ $accrual->id }}</td>
            <td aria-label="Процент начисл.">{{ round($accrual->percent,2) }}%</td>
            <td aria-label="Процент (мес.)">{{ $accrual->percent_month }}%</td>
            <td aria-label="Начали">{{ $accrual->start }}</td>
            <td aria-label="Закончили">{{ $accrual->end }}</td>
            <td aria-label="Комментарий">{{ $accrual->comment }}</td>
            {{--<td>{{ $accrual->meta }}</td>--}}
        </tr>
    @endforeach
    </tbody>
</table>