@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        <strong>Успешная операция: </strong> {{ Session::get('success') }}
    </div>
@endif
