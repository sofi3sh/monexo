<form action="{{ route('admin.set-manual-accrual-percents') }}" method="POST">
    @csrf

    <div class="form-group">
        <h3>Ручное выставление процентов для следующих начислений:</h3>
    </div>

    @foreach($marketingPlans as $marketingPlan)
        <div class="form-group">
            <label for="{{ $marketingPlan->id }}">{{ $marketingPlan->name }}</label>
            <input type="text" class="form-control" name="{{ $marketingPlan->id }}" id="{{ $marketingPlan->id }}" step="0.01" value="{{ $marketingPlan->manual_percent }}" placeholder="Диапазон 0.1:0:5 или точный 0.1 процент">
            @if($marketingPlan->manual_percent)
                <div class="text-primary">
                    <strong>Ручной режим</strong><br>Указан
                    @if (explode(':', $marketingPlan->manual_percent)[0] === explode(':', $marketingPlan->manual_percent)[1])
                        фиксированный процент {{ explode(':', $marketingPlan->manual_percent)[0] }}%
                    @else
                        случайный процент от {{ explode(':', $marketingPlan->manual_percent)[0] }}% до {{ explode(':', $marketingPlan->manual_percent)[1] }}%
                    @endif
                </div>
            @endif
            <span style="color: #777">
                Активных пакетов: <strong>{{ $activePackages[$marketingPlan->id] ?? 0 }}</strong><br>
                Фиксированный процент: <strong>{{ $marketingPlan->daily_percent }}%</strong><br>
                Диапазон процентов: <strong>{{ $marketingPlan->min_profit }}%</strong> - <strong>{{ $marketingPlan->max_profit }}%</strong>
            </span>
        </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Установить</button>
    <br>
    <div class="form-group">
        <small class="form-text text-muted">Если "-" — убытки. Если на задан — будет устанавливаться согласно маркетингового плана.</small>
        <small class="form-text text-muted">После выполнения начислений, проценты, установленные вручную, сбрасываются и, если не установлены новые, то будут устанавливаться согласно маркетингового плана.</small>
    </div>
</form>
@include('includes.partials.messages')
