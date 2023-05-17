@if(session('unsupportedPayment'))
    <p>{{session('unsupportedPayment')}}</p>
@endif
@if(session('messagePayment'))
    <p>{{session('messagePayment')}}</p>
@endif
