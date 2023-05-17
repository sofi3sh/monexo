<h2>Покупка плана</h2>
@include('includes.partials.messages')
<form action="{{ route('home.marketing-plans.buy') }}" method="POST">
    @csrf
    <select name="marketing_plan_id">
        @foreach(json_decode($plans, true) as $plan)
            <option value="{{ $plan['id'] }}" {{ (old("marketing_plan_id") == $plan['id'] ? "selected":"") }}>{{ $plan['name'] }}</option>
        @endforeach
    </select>

    <input name="invested_usd" value="{{ old('invested_usd') }}" type="number">
    <button>
        <span>Инвестировать</span>
    </button>
</form>