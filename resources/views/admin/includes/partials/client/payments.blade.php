<div class="container-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                От старых к новым
                <br>
                <div class="admin-content-block">
                	<div class="payment-wrapper">
	                    @if(!is_null($user->getMedia('payments')))
	                        @foreach($user->getMedia('payments') as $payment)
	                        	<div class="payment-info-block">
	                        		<div class="pib--logo">
			                            {{-- Превью--}}
			                            <img src="{{ $payment->getUrl('thumb') }}">
	                        		</div>
	                        		<div class="pib--data">
			                            {{-- Добавлен --}}
			                            <h3>{{ $payment->created_at }}</h3>
	                        		</div>

		                            {{-- Полный размер --}}
		                            {{--<img src="{{ $payment->getUrl() }}">--}}
	                        	</div>
	                            <br>
	                        @endforeach
	                    @endif
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>