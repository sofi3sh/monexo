<h3>Создание транзакций для {{ $user->email }}</h3>
<ul class="nav nav-tabs nav-tabs--transactions" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#transaction" role="tab" aria-selected="true">
            Одну транзакцию
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#mult-transactions" role="tab" aria-selected="false">
            Начисления за период
        </a>
    </li>
</ul>

{{-- Содержание вкладок --}}

<div class="admin-content-block-border">
    <div class="tab-content mytab-content">
        <div class="tab-pane fade show active" id="transaction" role="tabpanel" aria-labelledby="home-tab">
            @include('admin.includes.partials.client.create-transaction')
        </div>
        <div class="tab-pane fade show" id="mult-transactions" role="tabpanel">
            @include('admin.includes.partials.client.create-multiply-transactions')
        </div>
    </div>
</div>