<h3>Транзакции</h3>
<div class="container-fluid">
    {{--<div class="head text-center">Все транзакции</div>--}}
    <table class="table3">
        <thead>
        <tr class="no-hover">
            <th>От главного к текущему</th>
        </tr>
        </thead>
        <tbody>
            @foreach($user->getAncestors(20) as $sr)
                {{-- Не выводим предка с id=1, поскольку все, кто пришел не по реф. ссылке, ставятся под него --}}
                @if($sr->id <> 1)
                    <tr class="income">
                        <td aria-label="Email" style="display: flex; align-items: center; justify-content: center;">
                            <a href="{{ route('admin.client', $sr->id) }}" style="text-align: center;">
                                {{ $sr->email }}
                            </a>
                        </td>
                    </tr>
                    @if ($loop->last)
                        <tr class="income">
                            <td aria-label="Email" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                {{ $user->email }} - (текущий)
                            </td>
                        </tr>
                    @endif
                @endif
            @endforeach
        </tbody>
    </table>
</div>