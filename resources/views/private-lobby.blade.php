@extends('main')
@section('title', 'Админка')
@section('content')
    <div class="private-lobby">
        <div class="_container">
            <h1 class="private-lobby__title">
                Админка
            </h1>
            <div class="private-lobby__inner">
                <div class="private-lobby__link">
                    <a href="{{route('private.users')}}">Пользователи</a>
                </div>
                <div class="private-lobby__link">
                    <a href="{{route('private.stat')}}">Статистика</a>
                </div>
                <div class="private-lobby__link">
                    <a href="{{route('private.contract')}}">Договорные матчи</a>
                </div>
                <div class="private-lobby__link">
                    <a href="{{ route('private.matches') }}">Просмотр договорных матчей</a>
                </div>
                <div class="private-lobby__link">
                    <a href="{{ route('rejection-reasons.index') }}">Причины отказа</a>
                </div>
                <div class="private-lobby__link">
                    <a href="{{route('private.verify')}}">Заявки на верификацию</a>
                </div>
                <div class="private-lobby__link">
                    <a href="{{route('private.withdrawals')}}">Заявки на вывод</a>
                </div>
                <div class="private-lobby__link">
                    <a href="{{route('private.footer-links.index')}}">Страницы Footer</a>
                </div>
                <div class="private-lobby__link">
                    <a href="{{route('private.popup-notification.edit')}}">Редактировать PopUp ( Казино )</a>
                </div>

                <div class="private-lobby__link">
                    <a href="{{ route('leagues.index') }}">Управление Топ Лигами</a>
                </div>
                <div class="private-lobby__link">
                    <a href="{{ route('sports.index') }}">Управление Категориями</a>
                </div>
                <div class="private-lobby__link">
                    <a href="{{ route('games.index') }}">Управление Матчами</a>
                </div>

                <div class="private-lobby__link">
                    <a href="{{ route('matchNotf.edit') }}">Редактировать PopUp ( Матчи )</a>
                </div>

                <div class="private-lobby__link">
                    <a href="{{ route('match-limits.index') }}">Ограничение</a>
                </div>



                <div class="private-lobby__link">
                    <a href="{{ route('dogovorNotf.edit') }}">Редактировать PopUp ( Кто делал договорный матч ) </a>
                </div>

                <div class="private-lobby__link">
                    <a href="{{ route('private.banners.index') }}">Баннеры </a>
                </div>


            </div>
        </div>
    </div>
@endsection
