{{-- Если у пользователя есть подключенный мотивационный план - выводим информацию о плане --}}
@if(!is_null($user->motivation_plan_id))
    Подключен мотивационный план: {{ $user->motivationPlan->name }}<br>
    Начало дейсвтия плана: {{ $user->motivation_plan_start_at }}<br>
@endif