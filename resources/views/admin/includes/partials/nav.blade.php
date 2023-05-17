<nav class="menu menu--hidden menu--admin">
    <a href="{{ route('home.main') }}" class="menu-item">
        <span class="menu-item__text">В личн. кабинет</span>
    </a>
        <hr>
    <a href="{{ route('admin.main') }}" class="menu-item {{ isActive('admin.main', 'menu-item--active') }}">
        <span class="menu-item__text">Главная</span>
    </a>

    <a href="{{ route('admin.clients') }}" class="menu-item {{ isActive('admin.clients', 'menu-item--active') }}">
        <span class="menu-item__text">Клиенты</span>
    </a>

    <a href="{{ route('admin.verif.show') }}" class="menu-item {{ isActive('admin.verif.show', 'menu-item--active') }}">
        <span class="menu-item__text">Верификация клиентов</span>
    </a>

    {{-- <a href="{{ route('admin.partner.index') }}" class="menu-item {{ isActive('admin.partner.index', 'menu-item--active') }}">
        <span class="menu-item__text">Партнеры</span>
    </a> --}}

    <a href="{{ route('admin.partners-map.index') }}" class="menu-item {{ isActive('admin.partners-map', 'menu-item--active') }}">
        <span class="menu-item__text">Карта партнёров</span>
    </a>

    <a href="{{ route('admin.withdrawal-regulations.index') }}" class="menu-item {{ isActive('admin.withdrawal-regulations.index', 'menu-item--active') }}">
        <span class="menu-item__text">Регламент вывода</span>
    </a>

    @if(Route::currentRouteName() == 'admin.client')
        <a href="#" class="menu-item menu-item--active">
            <span class="menu-item__text">Карточка клиента</span>
        </a>
    @endif

    <a href="{{ route('admin.withdrawal-requests') }}" class="menu-item {{ isActive('admin.withdrawal-requests', 'menu-item--active') }}">
        <span class="menu-item__text">Заявки на вывод</span>
    </a>

    <a href="{{ route('admin.news-subscribes.index') }}" class="menu-item {{ isActive('admin.news-subscribes.index', 'menu-item--active') }}">
        <span class="menu-item__text">Подписка на новости</span>
    </a>

    <a href="{{ route('admin.crypto-requests') }}" class="menu-item {{ isActive('admin.crypto-requests', 'menu-item--active') }}">
        <span class="menu-item__text">Заявки на крипто</span>
    </a>

    <a href="{{ route('admin.partner.regional-representative.request.index') }}" class="menu-item {{ isActive('admin.partner.regional-representative.request.index', 'menu-item--active') }}">
        <span class="menu-item__text">Заявки на статусы</span>
    </a>

    <a href="{{ route('admin.partner.invitation-deposit.index') }}" class="menu-item {{ isActive('admin.partner.invitation-deposit.index', 'menu-item--active') }}" style="max-width: 220px;">
        <span class="menu-item__text">Пригласительные депозиты</span>
    </a>

    <a href="{{ route('admin.mail.index') }}" class="menu-item {{ isActive('admin.mail.index', 'menu-item--active') }}" style="max-width: 220px;">
        <span class="menu-item__text">Отправить письмо</span>
    </a>

    <a href="{{ route('admin.customTransaction.main') }}" class="menu-item
    {{ isActive('admin.customTransaction.main', 'menu-item--active') }}">
        <span class="menu-item__text">Переводы польз.</span>
    </a>

    <a href="{{ route('admin.accruals') }}" class="menu-item {{ isActive('admin.accruals', 'menu-item--active') }}">
        <span class="menu-item__text">Начисления</span>
    </a>

    <a href="{{ route('admin.news') }}" class="menu-item {{ isActive('admin.news', 'menu-item--active') }}">
        <span class="menu-item__text">Новости</span>
    </a>

    <a href="{{ route('admin.baunty') }}" class="menu-item {{ isActive('admin.baunty', 'menu-item--active') }}">
        <span class="menu-item__text">Baunty</span>
    </a>

    <a href="{{ route('admin.user-ip') }}" class="menu-item {{ isActive('admin.user-ip', 'menu-item--active') }}">
        <span class="menu-item__text">IP адреса</span>
    </a>

    <a href="{{ route('admin.withdrawalModalInfo.index') }}" class="menu-item {{ isActive('admin.withdrawalModalInfo.index', 'menu-item--active') }}">
        <span class="menu-item__text">Моментальный <br> вывод (модалка)</span>
    </a>

    <a href="{{ route('admin.blog.index') }}" class="menu-item {{ isActive('admin.blog.index', 'menu-item--active') }}">
        <span class="menu-item__text">Блог</span>
    </a>

    <a href="{{ route('admin.quote.index') }}" class="menu-item {{ isActive('admin.quote.index', 'menu-item--active') }}">
        <span class="menu-item__text">Цитаты</span>
    </a>

    <a href="{{ route('admin.companyMaterials.index') }}" class="menu-item {{ isActive('admin.mlmup2answer', 'menu-item--active') }}">
        <span class="menu-item__text">Презент. материалы</span>
    </a>

    <a href="{{ route('admin.faq.index') }}" class="menu-item {{ isActive('admin.faq.index', 'menu-item--active') }}">
        <span class="menu-item__text">FAQ</span>
    </a>

    <a href="{{ route('admin.links') }}" class="menu-item {{ isActive('admin.links', 'menu-item--active') }}">
        <span class="menu-item__text">Ссылки</span>
    </a>

    <a href="{{ route('admin.system') }}" class="menu-item {{ isActive('admin.system', 'menu-item--active') }}">
        <span class="menu-item__text">Системные</span>
    </a>

    <a href="{{ route('admin.stats') }}" class="menu-item {{ isActive('admin.stats', 'menu-item--active') }}">
        <span class="menu-item__text">Статистика</span>
    </a>

    <a href="{{ route('admin.services') }}" class="menu-item {{ isActive('admin.services', 'menu-item--active') }}">
        <span class="menu-item__text">Заказы на услуги</span>
    </a>

    <a href="{{ route('admin.mlmup2question') }}" class="menu-item {{ isActive('admin.mlmup2question', 'menu-item--active') }}">
        <span class="menu-item__text">Вопросы</span>
    </a>

    <a href="{{ route('admin.mlmup2answer') }}" class="menu-item {{ isActive('admin.mlmup2answer', 'menu-item--active') }}">
        <span class="menu-item__text">MLM UP 2.0</span>
    </a>

    <a href="{{ route('admin.events.index') }}" class="menu-item {{ isActive('admin.mlmup2answer', 'menu-item--active') }}">
        <span class="menu-item__text">События</span>
    </a>

    <a href="{{ route('admin.suggestion-types.index') }}" class="menu-item {{ isActive('admin.mlmup2answer', 'menu-item--active') }}">
        <span class="menu-item__text">Типы идей</span>
    </a>

    <a href="{{ route('admin.suggestions.index') }}" class="menu-item {{ isActive('admin.mlmup2answer', 'menu-item--active') }}">
        <span class="menu-item__text">Модерация идей</span>
    </a>

    <a href="{{ route('admin.ticket-support') }}" class="menu-item {{ isActive('admin.ticket-support', 'menu-item--active') }}">
        <span class="menu-item__text">Тикеты</span>
    </a>

    <a href="{{ route('admin.invite-commission.index') }}" class="menu-item {{ isActive('admin.invite-commission.index', 'menu-item--active') }}">
        <span class="menu-item__text">Комиссия за инвайты</span>
    </a>

    <a href="{{ route('admin.global-actions.show') }}" class="menu-item {{ isActive('admin.global-actions.show', 'menu-item--active') }}">
        <span class="menu-item__text">Глобальные действия</span>
    </a>
</nav>
