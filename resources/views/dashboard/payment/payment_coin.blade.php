@extends('dashboard.app')
@section('content')
<div class="header pb-3 pb-3">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-3">@lang('payment.coin.confirmation') <?=$summ ?> <?=$currency->code ?>@lang('payment.coin.through'){{$currency->name}}.</h6>
                </div>
            </div>
            <!-- Card stats -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col p-0">
                                    <h5 class="card-title text-uppercase text-muted mb-3">
                                        <ol>
											<li>@lang('payment.coin.warning')</li>
											<li>@lang('payment.coin.exact_amount')</li>
											<li>@lang('payment.coin.expectation')</li>
											<li>@lang('payment.coin.delay')<a href="https://t.me/monexo_manager" target="_blank">@monexo_manager</a></li>
										</ol>
									</h5>
                                    <!-- <span class="h2 font-weight-bold mb-0"><a href="https://t.me/monexo_manager" target="_blank">@monexo_manager</a></span> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-3">
	                                    @lang('payment.coin.amount')
	                                </h5>
	                                <span class="h2 font-weight-bold mb-0"><?=$summ ?> <?=$currency->code ?></span>
	                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-stats pi-tile-small">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-3">
	                                    {{$currency->name}}
	                                </h5>
	                                <div class="h2 font-weight-bold mb-0 input-group">
	                                	<input type="text" id="myCoinWallet" value="{{$myCoinWallet}}" readonly="" class="form-control">
	                                	<div class="tooltip bg-none border-bottom">
						                    <button onclick="myFunction()" onmouseout="outFunc()" id="copy-btn">
												<span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
												<i class="fas fa-copy"></i>
											</button>
										</div>
	                                </div>
	                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('keyup change', '#wallet-id', function(){
			if ($(this).val().trim() != '') {
				$('#payed-btn').removeClass('disabled-btn');
				$('#payed-btn').removeAttr('disabled');
			}else {
				$('#payed-btn').addClass('disabled-btn');
				$('#payed-btn').attr('disabled', true);
			}
		})
	})
	function myFunction() {
	  var copyText = document.getElementById("myCoinWallet");
	  copyText.select();
	  copyText.setSelectionRange(0, 99999);
	  document.execCommand("copy");

	  var tooltip = document.getElementById("myTooltip");
	  tooltip.innerHTML = "Copied: " + copyText.value;
	}

	function outFunc() {
	  var tooltip = document.getElementById("myTooltip");
	  tooltip.innerHTML = "Copy to clipboard";
	}
</script>
@stop

