{{-- todo-y Нормально сформулировать, локализировать --}}
Людей на проекте: {{ number_format($globalStat[0], 0, '.', ' ') }}<br>
Общий депозит: ${{ number_format($globalStat[1], 0, '.', ' ') }}<br>
Сколько в сумме мы дали дохода: ${{ number_format($globalStat[2], 0, '.', ' ') }}<br>
Сколько мы выплатили денег: ${{ number_format($globalStat[3], 0, '.', ' ') }}<br>