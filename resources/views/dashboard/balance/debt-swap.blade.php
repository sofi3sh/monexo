@php 
$user = Auth::user(); 
$time_allow = $dateLastDinwayWalletTransaction == null ? true : Illuminate\Support\Carbon::parse($dateLastDinwayWalletTransaction) <= Illuminate\Support\Carbon::now()->subDays(30);
@endphp
{{-- false верменная заглушка --}}
@if($user->debt_usd > 0 && $user->is_verif && false)
    @php $settings = App\Models\DebtsTransferSettings::find(1); @endphp
    <div class="card">
        <div class="card-header border-0">
            <h3 class="mb-0">@lang('debt-swap.title')</h3>
            @if($time_allow)
                <div class="row align-items-center">
                    <div class="col">
                        {{-- Индикатор последней транзакции этого типа? --}}
                        @if($user->debt_usd > $settings->min) 
                            @lang('debt-swap.can_withdraval', [
                                'percent' => $settings->percent * 100,
                                'debt_fixed' => $user->debt_usd_fixed,
                                'sum' => $user->debt_usd_fixed * $settings->percent
                            ])
                        @else
                            <p>
                                @lang('debt-swap.available_for_withdrawal', [
                                    'sum' => $user->debt_usd
                                ])
                            </p>
                        @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{route('home.balance.dinway-wallet-withdrawal')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input name="amount_usd" placeholder="0 USD" type="text" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Перевести</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @lang('debt-swap.next_transfer', [
                    'date' => Illuminate\Support\Carbon::parse($dateLastDinwayWalletTransaction)->addDays(30)->format('d.m.Y h:i:s')
                ])
            @endif
        </div>
    </div>
@endif
