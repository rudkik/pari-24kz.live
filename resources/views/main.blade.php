<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="/css/style.min.css?_v=<?php echo rand(0, 999999) ?> ">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="description" content=" Winline">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="document-state" content="dynamic">
    <meta name="revisit-after" content="15 days">
    <meta name="copyright" content="(c)">
    <meta name="Publisher-Email" content="">
    <meta property="og:type" content="website">
    <meta property="og:title" content=" Winline">
    <meta property="og:description" content=" Winline">
    <meta property="og:image" content="">
    <meta property="og:site_name" content=" Winline">
    <meta property="og:url" content="">
    <link rel="apple-touch-icon" sizes="57x57" href="/img/favicon/favicon.png?v=1">
    <link rel="apple-touch-icon" sizes="60x60" href="/img/favicon/favicon.png?v=1">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/favicon.png?v=1">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/favicon/favicon.png?v=1">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/favicon.png?v=1">
    <link rel="apple-touch-icon" sizes="120x120" href="/img/favicon/favicon.png?v=1">
    <link rel="apple-touch-icon" sizes="144x144" href="/img/favicon/favicon.png?v=1">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/favicon/favicon.png?v=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/favicon.png?v=1">
    <link rel="icon" type="image/png" sizes="192x192" href="/img/favicon/favicon.png?v=1">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon.png?v=1">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon/favicon.png?v=1">
    <link rel="icon" type="image/png" sizes="16x16" href="//img/favicon/favicon.png?v=1">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-title" content=" Winline">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="date=no">
    <meta name="format-detection" content="address=no">
    <meta name="format-detection" content="email=no">
    <script defer src="/js/app.min.js?_v=20230904172117"></script>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
</head>
<body>
<style>
    .spinner-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .spinner {
        border: 8px solid rgba(0, 0, 0, 0.1);
        border-left-color: #d42a28;
        border-radius: 50%;
        width: 64px;
        height: 64px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
<div class="spinner-overlay" id="spinner">
    <div class="spinner"></div>
</div>

<script>
    window.addEventListener('load', function () {
        document.getElementById('spinner').style.display = 'none';
    });
</script>
<div class="wrapper">
    <section class="p-box-lng">
        <div class="_container p-box-lng__c-box">
        </div>
    </section>


    <header class="header page__header" id="header">
        <div class="_container">
            <div class="header__c-box">
                <div class="header__l">
                    <a class="header__logo logo" href="/"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 240 50" style="enable-background:new 0 0 240 50;" xml:space="preserve">
<style type="text/css">
	.st2{fill:#FFFFFF;}
	.st1{fill:#00C7B1;}
</style>
<path class="st2" d="M215.5,0c-2.8,0-5.3,1.8-6.2,4.5L194.8,49h13.7l13.2-40.5C223,4.3,219.9,0,215.5,0z"></path>
<path class="st1" d="M120.8,1H78l-3.9,12h30L65.4,39c-3,2-3.5,6.1-1.2,8.8c2,2.4,5.4,2.8,8,1.1l39-26.2L102.6,49h13.7l12.2-37.5  C130.1,6.3,126.3,1,120.8,1z"></path>
<path class="st2" d="M15.6,1L0,49h13.7l11.7-36h27.9l-19,12.8c-2.8,1.9-3.7,5.6-1.8,8.4c1.9,2.8,5.6,3.5,8.4,1.7l23.7-16  C73,14.2,69,1,58.8,1H15.6z"></path>
<path class="st2" d="M187.8,1h-43.1L129,49h13.7l11.7-36h27.9l-24.7,16.7l15.3,18.2c2,2.4,5.4,2.8,8,1.1c3-2,3.5-6.1,1.2-8.8l-6.7-8  L193.6,20C202,14.2,198,1,187.8,1z"></path>
</svg></a>
                    <div data-side="right" class="header__nav-bg-mbl" data-burger="header"></div>
                        <nav class="header__nav nav">
                            <ul class="nav__list">
                                <li class="header__mbl nav__btn-box header__of-mbl-login"
                                    @if (Auth::check()) style="display: none;" @endif>
                                    <button class="btn btn-in nav__btn btn-fh btn-fh--b" type="button" aria-label="кнопка"
                                            data-popup="#pplogin">Войти
                                    </button>
                                    <button style="background-color: #00b8a3" class="btn nav__btn btn-fh" type="button"
                                            aria-label="кнопка" data-popup="#ppReg"></span><span>Регистрация</span></button>
                                </li>
                                @if (Auth::check())
                                    <li class="nav__user header__on-login header__on-login--mbl">
                                        <div class="header__balance nav__balance">
                                            <div class="balance balance--mbl">
                                                <h6>Баланс</h6><span>
						@if (Auth::check())

                                                        @if (auth()->user()->cur == 'RUB')
                                                            {{auth()->user()->money??'0'}} ₽
                                                        @else
                                                            {{auth()->user()->money??'0'}} ₸
                                                        @endif

                                                    @endif
						</span>
                                            </div>
                                        </div>
                                        <div class="nav__user-box-btn nav__user-box-btn--mbl">
                                            <button class="btn btn-user" type="button" aria-label="кнопка"
                                                    data-popup="#ppUser"><span class="btn-user__ico"><img class="p-img-c"
                                                                                                          src="/img/svg/user.svg"
                                                                                                          loading="lazy"
                                                                                                          width="100"
                                                                                                          height="100"
                                                                                                          alt="img"></span>
                                            </button>
                                            <button class="btn" type="button" aria-label="кнопка" data-popup="#ppBalance">
                                            <span>Пополнить </span>
                                            </button>
                                        </div>
                                    </li>
                                    <li class="nav__itm mob_item ava">

                                        <div class="popup-form__ava">
                                                <picture>
                                                    <label for="file_avatar">
                                                        @if(auth()->user()->avatar && auth()->user()->avatar !== 'users/default.png')
                                                            <img class="p-img" id="img_avatar" src="img/{{ auth()->user()->avatar }}"
                                                                 loading="lazy" width="100" height="100" alt="img">
                                                        @else
                                                            <img id="preview-image" src=""  style="display: none"/>
                                                            <div class="user-avatar" id="user-avatar">
                                                                {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                                                            </div>
                                                        @endif
                                                    </label>
                                                </picture>
                                                <input type="file" id="file_avatar" name="avatar" style="display: none;">
                                            </div>


                                    </li>
                                @endif
                                @if (Auth::check())
                                    <li class="nav__itm mob_item balance">
                                        <div class="header__balance nav__balance">
                                            <div class="balance balance--mbl">
                                                <h6>Баланс</h6><span>
						@if (Auth::check())

                                                        @if (auth()->user()->cur == 'RUB')
                                                            {{auth()->user()->money??'0'}} ₽
                                                        @else
                                                            {{auth()->user()->money??'0'}} ₸
                                                        @endif

                                                    @endif
						</span>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if (Auth::check())

                                    <li class="nav__itm mob_item" style="width: 100%">
                                        <button style="width: 100%" class="btn btn-bolster" type="button" aria-label="кнопка"
                                                data-popup="#ppBalance"><span class="btn__ico"> <span>Пополнить</span>
                                        </button>
                                    </li>
                                @endif
                                <li class="nav__itm nav__home"><a href="/">Главная </a></li>

                                <li class="nav__itm mob_item"><a href="/match" @if (!Auth::check()) style="display: none"
                                                                 data-popup="#pplogin" @endif>Мои ставки</a>
                                </li>

                                <li @if (!Auth::check()) style="display: none" @endif class="nav__itm mob_item">
                                    <button class="modal_link" data-popup="#deposit">Вывод средств</button>
                                </li>
                                <li @if (!Auth::check()) style="display: none" @endif class="nav__itm mob_item">

                                    <a href="{{route('deposit.history')}}" class="modal_link">
                                        <button class="modal_link">Финансовая история</button>
                                    </a>
                                </li>
                                <li @if (!Auth::check()) style="display: none" @endif class="nav__itm mob_item">
                                    <button class="modal_link" data-popup="#ppUser">Настройки</button>
                                </li>
                                <li @if (!Auth::check()) style="display: none" @endif class="nav__itm mob_item">
                                    <button class="modal_link" data-popup="#verify">Верификация</button>
                                </li>

                                <li class="nav__itm"
                                    @if (Auth::check()) @if(auth()->user()->role->id==1) style="display: none" @endif @endif>
                                    <a href="/sport">Спорт</a></li>

                                <li class="nav__itm"
                                    @if (Auth::check()) @if(auth()->user()->role->id==1) style="display: none" @endif @endif>
                                    <a href="/live">Лайв</a></li>



                                @foreach(App\Http\Controllers\FooterLinkController::getFooterLinks() as $link)
                                    <li class="nav__itm mob_item"><a href="{{ $link->url }}">{{ $link->title }}</a></li>
                                @endforeach

                                <li @if (!Auth::check()) style="display: none" @endif class="nav__itm mob_item">
                                    <a href="/logout" class="modal_link">Выйти</a>
                                </li>

                                @if (Auth::check())
                                    @if(auth()->user()->role->id==1)
                                        <li class="nav__itm"><a href="/private">Админка</a></li>
                                        <li class="nav__itm"><a href="{{route('private.users')}}">Пользователи</a>
                                        </li>

                                    @endif
                                @endif
                            </ul>
                        </nav>

                </div>
                <div class="header__r header__of-mbl-login" @if (Auth::check()) style="display: none;" @endif>
                    <button class="btn btn-in" type="button" aria-label="кнопка" data-popup="#pplogin">Войти</button>
                    <button class="btn" type="button" aria-label="кнопка" data-popup="#ppReg"><span>Регистрация</span></button>
                </div>
                <div class="header__r header__mbl">

                    <button class="header__btn-burger btn-burger" type="button" data-burger="header"><span
                            class="btn-burger__l"></span><span class="btn-burger__r"></span></button>
                </div>
                @if (Auth::check())
                    <div @if (Auth::check()) @if(auth()->user()->role->id==1) style="display: none"
                         @endif @endif class="header__r  header__of-mbl-login">
                        <div class="header__balance">
                            <div class="balance">
                                <h6>Баланс</h6>
                                <span>
                                        @if (Auth::check())
                                        @php
                                            $money = number_format(auth()->user()->money ?? 0, 0, '', '');
                                        @endphp

                                        @if (auth()->user()->cur == 'RUB')
                                            {{ $money }} ₽
                                        @else
                                            {{ $money }} ₸
                                        @endif
                                    @endif
                                </span>

                            </div>


                        </div>
                        <div class="btn-user-wrapper">
                            <button style="padding: 5px 5px 5px 5px;" class="btn btn-user" type="button"
                                    aria-label="кнопка"
                            >
                                <span class="btn-user__ico"
                                      style="background-color: #2C3756; border-radius: 60%; padding: 5px">
                                    <img class="p-img-c" src="/img/ico/user.png" loading="lazy" width="100" height="100"
                                         alt="img">
                                </span>
                                <span class="btn-user__ico" style="width: 1rem">
                                    <img class="p-img-c" src="/img/ico/dots.png" loading="lazy" width="100" height="100"
                                         alt="img">
                                </span>
                            </button>
                            <div class="btn-user-dropdown">
                                <div class="dropdown-content">
                                    <button class="modal_link" data-popup="#ppBalance">Пополнить баланс</button>
                                    <button class="modal_link" data-popup="#deposit">Вывод средств</button>
                                    <button class="modal_link"
                                            onclick="window.location.href='{{ route('deposit.history') }}'">
                                        Финансы
                                    </button>
                                    <button class="modal_link" data-popup="#ppUser">Настройки</button>
                                    <button class="modal_link" data-popup="#verify">Верификация</button>
                                    <button onclick="window.location.href = '/logout'" class="modal_link">Выйти</button>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-bolster" type="button" aria-label="кнопка" data-popup="#ppBalance"><span>Пополнить</span></button>
                    </div>
                @else
                    <div class="header__r header__on-login  header__of-mbl-login">
                        <div class="header__balance">
                            <div class="balance">
                                <h6>Баланс</h6><span>
				  @if (Auth::check())

                                        @if (auth()->user()->cur == 'RUB')
                                            {{auth()->user()->money??'0'}} ₽
                                        @else
                                            {{auth()->user()->money??'0'}} ₸
                                        @endif

                                    @endif</span>
                            </div>
                        </div>
                        <button class="btn btn-user" type="button" aria-label="кнопка" data-popup="#ppUser"><span
                                class="btn-user__ico"><img class="p-img-c" src="/img/svg/user.svg" loading="lazy"
                                                           width="100" height="100" alt="img"></span></button>
                        <button class="btn" type="button" aria-label="кнопка" data-popup="#ppBalance"><span>Пополнить</span></button>
                    </div>
                @endif
            </div>
            <section class="header__footer-box" @if (Auth::check()) style="display: none;" @endif>
                <div class="header__r header__mbl header__of-mbl-login header__box-fh"
                     @if (Auth::check()) style="display: none;" @endif>
                    <button class="btn btn-fh btn-fh--b btn-in" type="button" aria-label="кнопка" data-popup="#pplogin">
                        Войти
                    </button>
                    <button style="background-color: #00b8a3; " class="btn btn-fh" type="button" aria-label="кнопка"
                            data-popup="#ppReg"><span>Регистрация</span>
                    </button>
                </div>
                <div class="header__on-login header__on-login--mbl" @if (Auth::check()) style="display: grid;" @endif>
                    <div class="header__balance">
                        <div class="balance">
                            <h6>Баланс</h6><span> @if (Auth::check())

                                    @if (auth()->user()->cur == 'RUB')
                                        {{auth()->user()->money??'0'}} ₽
                                    @else
                                        {{auth()->user()->money??'0'}} ₸
                                    @endif

                                @endif</span>
                        </div>
                    </div>
                    <button class="btn btn-user" type="button" aria-label="кнопка" data-popup="#ppUser"><span
                            class="btn-user__ico"><img class="p-img-c" src="img/svg/user.svg" loading="lazy" width="100"
                                                       height="100" alt="img"></span></button>
                    <button class="btn" type="button" aria-label="кнопка" data-popup="#ppBalance"><span
                            class="btn__ico"> <img class="p-img-c" src="img/plus.png" loading="lazy" width="100"
                                                   height="100" alt="img"></span><span>Пополнить</span></button>
                </div>
            </section>
        </div>
    </header>


    @if (Auth::check())
        @if (auth()->user()->ban == 1)
            <h2 align="center">Ваш аккаунт находится в бане!</h2>
        @else
            @yield('content')
        @endif
    @else
        @yield('content')
    @endif


    <section class="popup page__popup" id="pplogin" aria-hidden="true">
        <div class="popup__wrapper">
            <article class="popup__content popup-form">

                <button class="popup__close" type="button" data-close><span class="popup__ico-close"><img
                            class="p-img-c" src="/img/svg/cross2.svg" loading="lazy" width="100" height="100" alt="img"></span>
                </button>
                <h2 class="popup-form__ttl"> Вход в аккаунт</h2>
                <form class="form" action="#!" method="POST">
                    <input class="form__input" type="email" id="email_login" placeholder="Email" autocomplete="off"
                           required>
                    <input style="font-family: sans-serif;" class="form__input" type="password" id="password_login" placeholder="Password"
                           autocomplete="off" required>
                    <button class="form__r-link" type="button" data-popup="#forgotpassword">
                        Забыли пароль?
                    </button>
                    <button type="submit" class="form__submit btn login_btn">Войти</button>
                    <p class="form__tt"> Ещё нет аккаунта?
                        <button class="form__link" type="button" aria-label="кнопка" data-popup="#ppReg">
                            Зарегистрируйтесь
                        </button>
                    </p>
                </form>
            </article>
        </div>
    </section>
    <section class="popup page__popup" id="verify" aria-hidden="true">
        <div class="popup__wrapper">
            <article class="popup__content popup-form">

                <button class="popup__close" type="button" data-close><span class="popup__ico-close"><img
                            class="p-img-c" src="/img/svg/cross2.svg" loading="lazy" width="100" height="100" alt="img"></span>
                </button>
                <h2 class="popup-form__ttl">Верификация</h2>
                <form class="private-verify__form" id="verifyForm">
                    <label for="verify-image-upload" class="private-contract__label">
                        <input type="file" id="verify-image-upload" class="form__input" name="images[]" multiple
                               onchange="previewImages()" accept="image/*" max="4">
                        @if (Auth::check())
                            @if (auth()->user()->socument_suc == 1)
                                <div class="private-verify__label-text" style="background-color: #93fa93">

                                    <div>Ваши документы подтверждены</div>
                                    @else
                                        <div class="private-verify__label-text">

                                            <div>Выберите файлы для загрузки</div>
                                            <div>Кликните для выбора</div>

                                        </div>
                    </label>
                    <div id="image-preview"></div>
                    <button type="submit" class="form__submit btn">Отправить</button>

                    <div class="private-verify__info">
                        <h3 class="private-verify__info-title">
                            Загрузите ваши документы для прохождения модерации аккаунта
                        </h3>
                        <ul class="private-verify__info-list">
                            <li>- Фото карты с замаскированным номером (первые 6 цифр и последние 4 должны быть видны)
                            </li>
                            <li>- Селфи с картой (Если ваша карта виртуальная то загрузите квитанцию об оплате из
                                приложения)
                            </li>
                            <li>- Удостоверяющий документ крупным планом (паспорт или права/SSN и пр)</li>
                            <li>- Селфи с удостов. Документом</li>
                        </ul>
                    </div>
                </form>
                @endif
                @endif
            </article>
        </div>
    </section>
    <section class="popup page__popup" id="forgotpassword" aria-hidden="true">
        <div class="popup__wrapper">
            <article class="popup__content popup-form">
                <button class="popup__close" type="button" data-close><span class="popup__ico-close"><img
                            class="p-img-c" src="/img/svg/cross2.svg" loading="lazy" width="100" height="100" alt="img"></span>
                </button>
                <h2 class="popup-form__ttl">Забыли пароль?</h2>
                <div style="margin: 10px 0;">Обратитесь в тех. поддержку</div>
                <form class="form" action="" onsubmit="this.preventDefault()" method="POST">
                    <input class="form__input " type="text" name="sum" placeholder="Ваш email" autocomplete="off"
                           required>
                    <button type="submit" class="form__submit btn">Отправить</button>
                </form>
            </article>
        </div>
    </section>
    <section class="popup page__popup" id="needhelp" aria-hidden="true">
        <div class="popup__wrapper">
            <article class="popup__content popup-form">
                <button class="popup__close" type="button" data-close><span class="popup__ico-close"><img
                            class="p-img-c" src="/img/svg/cross2.svg" loading="lazy" width="100" height="100" alt="img"></span>
                </button>
                <h2 class="popup-form__ttl">Обратитесь в тех. поддержку</h2>
                <div style="margin: 10px 0;">Текст</div>
            </article>
        </div>
    </section>
    <section class="popup page__popup" id="pplogin" aria-hidden="true">
        <div class="popup__wrapper">
            <article class="popup__content popup-form">

                <button class="popup__close" type="button" data-close><span class="popup__ico-close"><img
                            class="p-img-c" src="/img/svg/cross2.svg" loading="lazy" width="100" height="100" alt="img"></span>
                </button>
                <h2 class="popup-form__ttl"> Вход в аккаунт</h2>
                <form class="form" action="#!" method="POST">
                    <input class="form__input" type="email" id="email_login" placeholder="Email" autocomplete="off"
                           required>
                    <input style="font-family: sans-serif;"  class="form__input" type="password" id="password_login" placeholder="Password"
                           autocomplete="off" required>

                    <a class="form__r-link" href="#!" target="_blank"> Забыли
                        пароль?</a>
                    <a class="form__submit btn login_btn" target="_blank"> Сохранить</a>
                    <p class="form__tt"> Ещё нет аккаунта?
                        <button class="form__link" type="button" aria-label="кнопка" data-popup="#ppReg">
                            Зарегистрируйтесь
                        </button>
                    </p>
                </form>
            </article>
        </div>
    </section>
    <section class="popup page__popup" id="insuffunds" aria-hidden="true">
        <div class="popup__wrapper">
            <article class="popup__content popup-form">
                <h2 class="popup-form__ttl">Недостаточно средств на счету</h2>
            </article>
        </div>
    </section>
    <section class="popup page__popup" id="ppReg" aria-hidden="true">
        <div class="popup__wrapper">
            <article class="popup__content popup-form">
                <button class="popup__close" type="button" data-close><span class="popup__ico-close"><img
                            class="p-img-c" src="/img/svg/cross2.svg" loading="lazy" width="100" height="100" alt="img"></span>
                </button>
                <h2 class="popup-form__ttl"> Регистрация аккаунта</h2>
                <form class="form" action="/reg" method="POST">

                    <input class="form__input" type="text" id="name" name="name" placeholder="Имя Фамилия"
                           autocomplete="off" required>

                    <input class="form__input" type="tel" id="phone" placeholder="+7" autocomplete="off" required>
                    <h6>Выберите валюту</h6>
                    <div class="form__radio-box">
                        <input class="form__radio _hide" id="radio2" checked="checked" type="radio" name="currency" aria-label="чекбокс"
                               value="KZT">
                        <label class="form__lbl" for="radio2"> KZT</label>
                    </div>
                    <input class="form__input" type="email" id="email" placeholder="Email" autocomplete="off" required>
                    <input class="form__input" type="password" id="password" placeholder="Пароль" autocomplete="off"
                           required>
                    <input class="form__input" ty[[p[e="password" id="passsword_rep" placeholder="Подтвердите пароль"
                           autocomplete="off" required>
                    <div class="form__lbl-box">
                        <input class="form__radio _hide" id="check1" type="checkbox" name="group1" aria-label="чекбокс"
                               required>
                        <label class="form__lbl" for="check1"> Я прочитал и принял </label><a class="form__b-link"
                                                                                              href="/rules-provisions">положения и
                            условия</a>
                    </div>

                    <input class="form__radio _hide" id="check2" type="checkbox" name="group1" aria-label="чекбокс">
                    <label class="form__lbl" for="check2"> Мне уже есть 18 лет или больше</label>

                    <button class="form__submit btn reg_btn" type="submit" name="submitForm" aria-label="кнопка">
                        Регистрация
                    </button>
                    <p class="form__tt">Уже есть аккаунт?
                        <button class="form__link" type="button" aria-label="кнопка"> Войти</button>
                    </p>
                </form>
            </article>
        </div>
    </section>
    @if (Auth::check())
        <section class="popup page__popup" id="ppBalance" aria-hidden="true">
            <div class="popup__wrapper">
                <article class="popup__content popup-form">
                    <button class="popup__close" type="button" data-close><span class="popup__ico-close"><img
                                class="p-img-c" src="/img/svg/cross2.svg" loading="lazy" width="100" height="100"
                                alt="img"></span></button>
                    <h2 class="popup-form__ttl">Пополнить баланс</h2>
                    <div class="box-pay-step1">
                        <form class="form" action="" method="POST">
                            <input class="form__input form__input--cnt" type="text" name="text"
                                   placeholder="Введите сумму ₸" autocomplete="off" required>
                            <div class="box-pay">
                                <button type="button" class="pay-btn" type="submit" name="submitForm"
                                        aria-label="кнопка"><span class="pay-btn__img"> <picture><source
                                                srcset="/img/pay1.avif" type="image/avif"><source
                                                srcset="/img/pay1.webp" type="image/webp"><img class="p-img-c"
                                                                                               src="/img/pay1.png"
                                                                                               loading="lazy"
                                                                                               width="100" height="100"
                                                                                               alt="img"></picture></span>
                                </button>
                                <button type="button" class="pay-btn" type="submit" name="submitForm"
                                        aria-label="кнопка"><span class="pay-btn__img"> <picture><source
                                                srcset="/img/pay2.avif" type="image/avif"><source
                                                srcset="/img/pay2.webp" type="image/webp"><img class="p-img-c"
                                                                                               src="/img/pay2.png"
                                                                                               loading="lazy"
                                                                                               width="100" height="100"
                                                                                               alt="img"></picture></span>
                                </button>
                                <button type="button" class="pay-btn" type="submit" name="submitForm"
                                        aria-label="кнопка"><span class="pay-btn__img"> <picture><source
                                                srcset="/img/pay3.avif" type="image/avif"><source
                                                srcset="/img/pay3.webp" type="image/webp"><img class="p-img-c"
                                                                                               src="/img/pay3.png"
                                                                                               loading="lazy"
                                                                                               width="100" height="100"
                                                                                               alt="img"></picture></span>
                                </button>
                                <button type="button" class="pay-btn" type="submit" name="submitForm"
                                        aria-label="кнопка"><span class="pay-btn__img"> <picture><source
                                                srcset="/img/pay4.avif" type="image/avif"><source
                                                srcset="/img/pay4.webp" type="image/webp"><img class="p-img-c"
                                                                                               src="/img/pay4.png"
                                                                                               loading="lazy"
                                                                                               width="100" height="100"
                                                                                               alt="img"></picture></span>
                                </button>
                            </div>
                        </form>
                        <button class="form__submit btn next-step" type="button" aria-label="кнопка">Далее</button>
                    </div>
                    <div class="box-pay-step2" style="display: none; padding: 25px 0;font-size: 17px;">
                        <div>Обратитесь в тех. поддержку</div>
                    </div>
                </article>
            </div>
        </section>
        <section class="popup page__popup" id="deposit" aria-hidden="true">
            <div class="popup__wrapper">
                <article class="popup__content popup-form">
                    <button class="popup__close" type="button" data-close><span class="popup__ico-close"><img
                                class="p-img-c" src="/img/svg/cross2.svg" loading="lazy" width="100" height="100"
                                alt="img"></span></button>
                    <h2 class="popup-form__ttl">Вывод средств</h2>
                    <form class="form" action="!#" onsubmit="this.preventDefault()" method="POST">
                        <input class="form__input " type="text" name="sum" placeholder="Введите сумму"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '');" autocomplete="off" required>
                        <input class="form__input" type="text" name="details" placeholder="Карта"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '');" autocomplete="off" required>
                        <select class="form__input select-ignore" name="payment_gateway">
                            <option value="">Выберите способ оплаты</option>
                            <option value="Visa/Mastercard">Visa/Mastercard</option>
                            <option value="Payeer">Payeer</option>
                            <option value="BTC">BTC</option>
                            <option value="USDT">USDT</option>
                            <option value="TON">TON</option>
                            <option value="ETH">ETH</option>


                        </select>

                        <div class="notifications"></div>

                        <button class="form__submit btn" type="button" aria-label="кнопка">Вывести</button>
                        <a href="{{route('deposit.history')}}" class="check-history">Посмотреть историю</a>
                    </form>
                </article>
            </div>
        </section>
        <section class="popup page__popup" id="ppNotification" aria-hidden="true">
            <div class="popup__wrapper">
                <article class="popup__content popup-form">
                    <button class="popup__close" type="button" data-close><span class="popup__ico-close"><img
                                class="p-img-c" src="/img/svg/cross2.svg" loading="lazy" width="100" height="100"
                                alt="img"></span></button>
                    @php
                        $notification = App\Http\Controllers\PopupNotificationController::getNotification();
                    @endphp
                    <h2 class="popup-form__ttl">{{ $notification->title ?? 'Временный заголовок' }}</h2>
                    <div class="pp-notification">
                        {{ $notification->content ?? 'Временный текст' }}
                    </div>
                </article>
            </div>
        </section>
        <section class="popup page__popup" id="ppUser" aria-hidden="true">
            <div class="popup__wrapper">
                <article class="popup__content popup-form">
                    <button class="popup__close" type="button" data-close=""><span class="popup__ico-close"><img
                                class="p-img-c" src="/img/svg/cross2.svg" loading="lazy" width="100" height="100"
                                alt="img"></span></button>
                    <h2 class="popup-form__ttl">Настройки аккаунта</h2>
                    @if (session()->exists('suc'))
                        @if (session('suc') == '1')
                            <p style="color: green;">Данные успешно обновлены!</p>
                            {{ session()->forget('suc') }}
                        @endif
                    @endif
                    @if (session()->exists('error'))
                        @if (session('error') == '1')
                            <p style="color: red;">Старый пароль введен не правильно и/или новые пароли не
                                совпадают!</p>
                            {{ session()->forget('error') }}
                        @endif
                    @endif
                    <form class="form" action="/editprofile" method="POST" enctype='multipart/form-data'>
                        @csrf
                        <div class="popup-form__ava">
                            <picture>
                                <label for="file_avatar-2">
                                    @if(auth()->user()->avatar && auth()->user()->avatar !== 'users/default.png')
                                        <img class="p-img" id="img_avatar-2" src="img/{{ auth()->user()->avatar }}"
                                             loading="lazy" width="100" height="100" alt="img">
                                    @else
                                        <img id="preview-image-2" src=""  style="display: none"/>
                                        <div class="user-avatar" id="user-avatar-2">
                                            {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </label>
                            </picture>
                            <input type="file" id="file_avatar-2" name="avatar" style="display: none;">
                        </div>




                        <h4 class="popup-form__account">Счет
                            №2240{{ str_pad(auth()->user()->id, 2, '0', STR_PAD_LEFT) }}</h4>
                        <h3 class="popup-form__ttl">Персональные данные</h3>
                        <input class="form__input" type="text" name="name_edit" value="{{ auth()->user()->name }}"
                               placeholder="Имя Фамилия" autocomplete="off" required>
                        <input class="form__input" type="tel" name="phone_edit" value="{{ auth()->user()->phone }}"
                               placeholder="Номер телефона" autocomplete="off" required>
                        <input class="form__input" type="email" name="email_edit" value="{{ auth()->user()->email }}"
                               disabled placeholder="Почта" autocomplete="off" required>
                        <h3 class="popup-form__ttl">Изменить пароль</h3>
                        <input class="form__input" type="password" name="password_old" placeholder="Старый пароль"
                               autocomplete="off">
                        <input class="form__input" type="password" name="password_new" placeholder="Новый пароль"
                               autocomplete="off">
                        <input class="form__input" type="password" name="password_new_rep"
                               placeholder="Подтвердите пароль" autocomplete="off">
                        <button class="form__submit btn" type="submit" name="submitForm" aria-label="кнопка">Сохранить
                        </button>
                    </form>
                </article>
            </div>
        </section>
    @endif
    <style>


        .lazy2 {
            opacity: 0;
        }

        .lazy2.lazyloaded {
            opacity: 1;
        }

        .footer__separator_new {
            position: relative;
            height: 2px;
            background-color: #1a2a38;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .scroll-indicator {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 10%;
            background-color: #ffff;
            transition: transform 0.1s ease-out;
        }

        .lazy3 .banner-ftr__img img {
            filter: grayscale(100%);
        }

        .lazy3 .banner-ftr__img img:hover {
            filter: none;
        }

    </style>
    <footer class="footer">
        <div class="_container">
            <div class="footer__separator"><img class="p-img-c" src="/img/separator.svg" loading="lazy" width="100"
                                                height="100" alt="img"></div>
            <ul class="footer__nav nav-ftr">
                <li class="nav-ftr__itm"><a href="/">Главная</a></li>
                <li class="nav-ftr__itm"><a href="/sport">Спорт</a></li>


                <li class="nav-ftr__itm"><a href="/">Главная</a></li>
                <li class="nav-ftr__itm"><a href="/sport">Спорт</a></li>
                <li class="nav-ftr__itm"><a href="/risk_notification">Уведомление о рисках</a></li>
                <li class="nav-ftr__itm"><a href="/rules">Правила и условия</a></li>
                <li class="nav-ftr__itm"><a href="/return">Условия возврата</a></li>
                <li class="nav-ftr__itm"><a href="/kyc">KYC & AML</a></li>
                <li class="nav-ftr__itm"><a href="/license">Лицензия </a></li>

            </ul>
            @if (Auth::check())
                @if(auth()->user()->role->id==1)
                    <style>
                        .banner-ftr, .footer__separator {
                            display: none;
                        }
                    </style>
                @endif
            @endif
            <div class="middle_seporator"></div>

            <article class="banner-ftr lazy2">
                <div class="banner-ftr__img"><img class="p-img-c" src="/img/ftr/bnr1.svg" loading="lazy" width="100"
                                                  height="100" alt="img"></div>
                <div class="banner-ftr__img"><img class="p-img-c" src="/img/ftr/bnr2.svg" loading="lazy" width="100"
                                                  height="100" alt="img"></div>
                <div class="banner-ftr__img"><img class="p-img-c" src="/img/ftr/bnr3.svg" loading="lazy" width="100"
                                                  height="100" alt="img"></div>
                <div class="banner-ftr__img"><img class="p-img-c" src="/img/ftr/bnr4.svg" loading="lazy" width="100"
                                                  height="100" alt="img"></div>
                <div class="banner-ftr__img"><img class="p-img-c" src="/img/ftr/bnr5.svg" loading="lazy" width="100"
                                                  height="100" alt="img"></div>
                <div class="banner-ftr__img"><img class="p-img-c" src="/img/ftr/bnr6.svg" loading="lazy" width="100"
                                                  height="100" alt="img"></div>
                <div class="banner-ftr__img"><img class="p-img-c" src="/img/ftr/bnr7.svg" loading="lazy" width="100"
                                                  height="100" alt="img"></div>
                <div class="banner-ftr__img"><img class="p-img-c" src="/img/ftr/bnr8.svg" loading="lazy" width="100"
                                                  height="100" alt="img"></div>
            </article>
            <div class="middle_seporator"></div>


            <style>
                .lazy3 {
                    display: flex;
                    flex-wrap: nowrap;
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
                    padding: 10px;
                }

                .lazy3::-webkit-scrollbar {
                    display: none;
                }

                .banner-ftr__img {
                    flex: 0 0 auto;
                    margin-right: 20px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .banner-ftr__img img {
                    max-width: 100px;
                    max-height: 100px;
                }

                .middle_seporator {
                    width: 100%;
                    height: 1px;
                    margin: 10px 0 20px 0;
                    background: linear-gradient(90deg, hsla(0, 0%, 100%, 0.2) 29.12%, hsla(0, 0%, 100%, 0));
                }

            </style>
            <article class="banner-ftr lazy3">

                <div class="banner-ftr__img">
                        <img class="p-img-c" src="/img/ftr/visa.svg" loading="lazy" width="100" height="100" alt="img">
                </div>
                <div class="banner-ftr__img">

                        <img class="p-img-c" src="/img/ftr/mastercard.svg" loading="lazy" width="100" height="100" alt="img">
                </div>
                <div class="banner-ftr__img">

                        <img class="p-img-c" src="/img/ftr/applepay.svg" loading="lazy" width="100" height="100" alt="img">
                </div>
                <div class="banner-ftr__img">

                        <img class="p-img-c" src="/img/ftr/googlepay.svg" loading="lazy" width="100" height="100" alt="img">
                </div>
                <div class="banner-ftr__img">

                        <img class="p-img-c" src="/img/ftr/bitcoin.svg" loading="lazy" width="100" height="100" alt="img">
                </div>
                <div class="banner-ftr__img">
                        <img class="p-img-c" src="/img/ftr/etherium.svg" loading="lazy" width="100" height="100" alt="img">
                </div>
                <div class="banner-ftr__img">
                        <img class="p-img-c" src="/img/ftr/tether.svg" loading="lazy" width="100" height="100" alt="img">
                </div>
                <div class="banner-ftr__img">
                        <img class="p-img-c" src="/img/ftr/tron.svg" loading="lazy" width="100" height="100" alt="img">
                </div>
                <div class="banner-ftr__img">
                        <img class="p-img-c" src="/img/ftr/skrill.svg" loading="lazy" width="100" height="100" alt="img">
                </div>
                <div class="banner-ftr__img">
                        <img class="p-img-c" src="/img/ftr/payeer.svg" loading="lazy" width="100" height="100" alt="img">
                </div>
                <div class="banner-ftr__img">
                        <img class="p-img-c" src="/img/ftr/qiwi.svg" loading="lazy" width="100" height="100" alt="img">
                </div>
                <div class="banner-ftr__img">
                    <img class="p-img-c" src="/img/ftr/piastrix.svg" loading="lazy" width="100" height="100" alt="img">
                </div>

            </article>
            <div class="middle_seporator"></div>


            <div class="footer__line-box"><a href="mailto:pari-kz@outlook.com ">Email адрес службы поддержки -
                    pari-kz@outlook.com </a></div>
            <div class="middle_seporator"></div>
            <div class="footer__line-box">
                <small class="footer__copy">
                    Copyright © 2024, <span id="domain"></span>, All rights reserved.
                </small>
            </div>

            <script>
                document.getElementById('domain').textContent = window.location.hostname;
            </script>


        </div>
    </footer>
    <div class="footer__nav-icons">
        <ul class="footer__nav-icons-list">
            <li class="footer__nav-icon-item">
                <a href="/sport">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M9.93238 1.16036C7.67972 1.63046 5.97258 2.5381 4.30279 4.15337C2.01801 6.36362 0.873559 9.3123 1.01109 12.6348C1.12394 15.3642 2.13875 17.6483 4.15232 19.7056C5.69083 21.2774 7.21493 22.175 9.3185 22.7481C10.1112 22.9641 10.3818 22.9913 11.8132 22.9993C13.5567 23.0089 14.1764 22.9242 15.4982 22.4952C17.1626 21.9549 18.4185 21.1481 19.8411 19.7054C21.3434 18.1816 22.1461 16.7517 22.699 14.6142C22.9846 13.51 23.0851 11.6781 22.9215 10.5568C22.2599 6.02189 19.1118 2.48559 14.6749 1.29324C13.4512 0.964484 11.1766 0.900664 9.93238 1.16036ZM13.0793 2.37248C13.0608 2.42821 12.8097 2.62058 12.5212 2.8C11.9967 3.12636 11.9967 3.12636 11.4722 2.8C11.1837 2.62058 10.9326 2.42821 10.9141 2.37248C10.8909 2.30259 11.2254 2.27132 11.9967 2.27132C12.768 2.27132 13.1025 2.30259 13.0793 2.37248ZM10.2747 3.54018L11.351 4.24845L11.3502 5.81177L11.3495 7.37508L9.38126 8.68449L7.41301 9.99391L6.13442 9.517C4.85584 9.04019 4.85584 9.04019 4.47555 7.67193C4.09526 6.30366 4.09526 6.30366 4.33728 5.98566C4.72088 5.48154 5.48045 4.73851 6.08543 4.27549C7.0396 3.54533 8.76628 2.67944 9.06079 2.78335C9.13648 2.81002 9.68274 3.15064 10.2747 3.54018ZM15.6183 2.95679C17.1437 3.53227 18.6529 4.69078 19.7817 6.15266C19.8845 6.28591 19.8515 6.4953 19.5644 7.53205C19.3781 8.20437 19.1889 8.82381 19.1439 8.90869C19.0655 9.05619 18.8967 9.13096 17.3074 9.72226C16.6087 9.98223 16.6087 9.98223 14.6238 8.65497L12.6389 7.32781L12.6412 5.78813L12.6435 4.24845L13.7651 3.49586C14.382 3.08195 14.9167 2.74059 14.9534 2.73719C14.9901 2.73388 15.2893 2.83264 15.6183 2.95679ZM3.39917 8.56265C3.48541 8.88708 3.55597 9.19137 3.55597 9.23882C3.55597 9.28628 3.30825 9.52013 3.00548 9.75858C2.68354 10.0121 2.455 10.1392 2.455 10.0647C2.455 9.74534 3.06622 7.97282 3.17641 7.97282C3.21265 7.97282 3.31293 8.23821 3.39917 8.56265ZM21.0629 8.45561C21.2964 9.08185 21.5384 9.90213 21.5384 10.0672C21.5384 10.1767 21.2355 9.96641 20.4965 9.34375C20.4098 9.27073 20.7143 7.97282 20.8182 7.97282C20.8538 7.97282 20.964 8.19003 21.0629 8.45561ZM15.785 11.0069C15.8249 11.0417 15.5376 11.9871 15.1465 13.1079L14.4353 15.1457H12.0004H9.5654L8.88977 13.213C8.5182 12.1502 8.20855 11.22 8.20167 11.1461C8.19433 11.0668 8.97335 10.4869 10.1017 9.73182L12.0143 8.45183L13.8634 9.6978C14.8804 10.383 15.7451 10.9721 15.785 11.0069ZM5.6222 10.6883C6.22452 10.9174 6.74537 11.1346 6.77959 11.1711C6.95547 11.3584 8.42544 15.7953 8.35204 15.917C8.318 15.9733 7.98349 16.4472 7.60843 16.9701L6.92666 17.9208L5.53954 17.8571C3.93479 17.7833 4.09232 17.8769 3.41899 16.5983C2.71474 15.261 2.27151 13.6524 2.27151 12.4337C2.27151 11.9528 2.27151 11.9528 3.34009 11.1123C3.92772 10.65 4.43527 10.2718 4.46784 10.2718C4.50041 10.2718 5.01979 10.4592 5.6222 10.6883ZM20.6655 11.1219C21.7462 11.972 21.7462 11.972 21.692 12.8001C21.6104 14.0465 21.3302 15.0482 20.7141 16.2952C19.9207 17.9011 20.0935 17.7817 18.4538 17.8571L17.0667 17.9208L16.3601 16.9376C15.9714 16.3968 15.6344 15.9043 15.6111 15.8433C15.5877 15.7822 15.9334 14.7044 16.3792 13.4479L17.1898 11.1634L18.286 10.725C18.889 10.4839 19.4279 10.2832 19.4835 10.2792C19.5392 10.2751 20.0711 10.6544 20.6655 11.1219ZM15.2069 17.5059C15.6279 18.0959 15.9724 18.6262 15.9724 18.6843C15.9724 18.7423 15.7722 19.3408 15.5274 20.0141C15.0149 21.4245 15.0563 21.3882 13.689 21.6272C12.6697 21.8053 11.3236 21.8053 10.3044 21.6272C8.94757 21.39 8.99124 21.4285 8.4726 20.0101C8.22488 19.3325 8.02184 18.7357 8.02157 18.684C8.0212 18.6322 8.36846 18.1054 8.79316 17.5133L9.5654 16.4366L12.0034 16.4348L14.4415 16.4331L15.2069 17.5059ZM6.78197 19.2726C6.86427 19.3501 7.32484 20.5028 7.28814 20.5395C7.20952 20.6183 5.40274 19.3098 5.39485 19.1683C5.39036 19.0882 6.69014 19.186 6.78197 19.2726ZM18.6942 19.139C18.6942 19.2035 17.2315 20.288 16.9429 20.4376C16.6755 20.5762 16.6755 20.5762 16.9096 19.9531C17.0382 19.6104 17.1724 19.3014 17.2078 19.2665C17.2647 19.2103 17.5592 19.1745 18.4419 19.1165C18.5806 19.1074 18.6942 19.1175 18.6942 19.139Z" fill="currentColor"></path>
</svg>
                    <span>Спорт</span>
                </a>
            </li>
            <li class="footer__nav-icon-item">
                <a href="/live">
                    <img src="/img/ico/tv.png" alt="Лайв">
                    <span>Лайв</span>
                </a>
            </li>
            <li class="footer__nav-icon-item active">
                <a href="/sport">
                    <img src="/img/ico/voucher.png" alt="Купон">
                </a>
            </li>
            <li class="footer__nav-icon-item ">
                <a href="/match"     @if (!Auth::check())
                    data-popup="#pplogin" @endif>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M18.8569 3H5.14308C2.85766 3 1.00107 4.84262 1.00107 7.12134L1 9.87555C0.999849 10.2662 1.28859 10.5891 1.66328 10.6402L1.76744 10.6473C2.60598 10.6473 3.2273 11.231 3.2273 12.0011C3.2273 12.7975 2.57944 13.4407 1.76744 13.4407C1.3436 13.4407 1 13.786 1 14.2121V16.8787C1 19.1577 2.85585 21 5.14201 21H18.858C21.1441 21 23 19.1577 23 16.8787V14.2121C23 13.786 22.6564 13.4407 22.2326 13.4407C21.4206 13.4407 20.7727 12.7975 20.7727 12.0011C20.7727 11.2043 21.4209 10.5604 22.2326 10.5604C22.6565 10.5604 23.0002 10.2148 23 9.78867L22.9989 7.12103C22.9989 4.84262 21.1423 3 18.8569 3ZM18.8569 4.54286L19.0286 4.54835C20.3903 4.63579 21.4641 5.75603 21.4641 7.12134L21.4641 9.11691L21.3818 9.13909C20.1416 9.50301 19.2378 10.6432 19.2378 12.0011L19.2429 12.1769C19.317 13.4564 20.1954 14.5142 21.3818 14.8621L21.4651 14.8841V16.8787C21.4651 18.3013 20.3007 19.4571 18.858 19.4571H14.6602V17.9247L14.6532 17.82C14.6023 17.4435 14.2812 17.1532 13.8927 17.1532C13.4689 17.1532 13.1253 17.4986 13.1253 17.9247V19.4571H5.14201L4.97027 19.4517C3.60799 19.3642 2.53488 18.2444 2.53488 16.8787V14.8831L2.61821 14.8621C3.85849 14.4984 4.76218 13.3588 4.76218 12.0011L4.75714 11.8262C4.68344 10.5557 3.81015 9.54859 2.62127 9.21916L2.53386 9.19714L2.53595 7.12164C2.53595 5.69915 3.70101 4.54286 5.14308 4.54286H13.1253V6.51802L13.1323 6.6227C13.1831 6.99924 13.5042 7.28945 13.8927 7.28945C14.3166 7.28945 14.6602 6.94407 14.6602 6.51802V4.54286H18.8569ZM13.8927 8.66085C14.2812 8.66085 14.6023 8.95106 14.6532 9.3276L14.6602 9.43227V14.391C14.6602 14.8171 14.3166 15.1624 13.8927 15.1624C13.5042 15.1624 13.1831 14.8722 13.1323 14.4957L13.1253 14.391V9.43227C13.1253 9.00623 13.4689 8.66085 13.8927 8.66085Z" fill="currentColor"></path>
</svg>
                    <span>Мои пари</span>
                </a>
            </li>
            <li class="footer__nav-icon-item">
                <a href="/account" @if (!Auth::check()) data-popup="#pplogin" @else  data-popup="#ppUser" @endif>
                    <img src="/img/ico/account.png" alt="Аккаунт">
                    <span>Аккаунт</span>
                </a>
            </li>
        </ul>
    </div>

    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const container = document.querySelector('.lazy3');

            imagesLoaded(container, function () {
                container.classList.add('lazyloaded');
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
            const container = document.querySelector('.lazy2');

            imagesLoaded(container, function () {
                container.classList.add('lazyloaded');
            });
        });

        $(document).ready(function() {
            $('.footer__nav-icon-item.active     a').on('click', function(event) {
                event.preventDefault();
                $('.h1').show();
                $('.coupon__bets').html(res.join(''));
                $('.coupon-as').addClass('active');
                $('.overlay').addClass('active');

            });
        });


    </script>


</div>
<div id="notificationPopup" class="popup-overlay">
    <div class="pop-up-success">
        <button class="popup-close">&times;</button>
        <h2>Уведомление</h2>
        <p id="notificationMessage"></p>
        <button id="reloadButton" class="popup-reload-button">Перезагрузить страницу</button>
    </div>
</div>

<section class="popup page__popup" id="#ppNoBalance" aria-hidden="true">
    <div class="popup__wrapper">
        <article class="popup__content popup-form">
            <button class="popup__close" type="button" data-close>
                    <span class="popup__ico-close">
                        <img class="p-img-c" src="/img/svg/cross2.svg" loading="lazy" width="100" height="100" alt="img">
                    </span>
            </button>
            <h2 class="popup-form__ttl">Ошибка !</h2>

            <div class="pp-notification">
                Недостаточно средств на счету, пополните баланс!
            </div>
            <button class="btn" data-popup="#ppBalance">Пополнить баланс</button>
        </article>
    </div>
</section>


<section class="popup page__popup" id="notificationPopup-match" aria-hidden="true">
    <div class="popup__wrapper">
        <article class="popup__content popup-form">
            <button class="popup__close" type="button" data-close>
                    <span class="popup__ico-close">
                        <img class="p-img-c" src="/img/svg/cross2.svg" loading="lazy" width="100" height="100" alt="img">
                    </span>
            </button>
            <h2 class="popup-form__ttl">Внимание!</h2>
            @php
                $notification = App\Http\Controllers\MatchNotificationController::getNotification();
            @endphp
            <div class="pp-notification">
                {{ $notification->message ?? 'Временный текст' }}
            </div>
        </article>
    </div>
</section>

<div data-popup="dogovor-match"></div>

<section class="popup page__popup" id="dogovor-match" aria-hidden="true">
    <div class="popup__wrapper">
        <article class="popup__content popup-form">
            <button class="popup__close" type="button" data-close>
                    <span class="popup__ico-close">
                        <img class="p-img-c" src="/img/svg/cross2.svg" loading="lazy" width="100" height="100" alt="img">
                    </span>
            </button>
            <h2 class="popup-form__ttl">Внимание!</h2>
            @php
                $notification = App\Http\Controllers\DogovorNotificationController::getNotification();
            @endphp
            <div class="pp-notification">
                {{ $notification->message ?? 'Временный текст' }}
            </div>
        </article>
    </div>
</section>

<script src="{{asset('/js/jquery-mask.min.js')}}"></script>

<script type="text/javascript">
            document.umnicoWidgetHash = '4196e102e55d13f3137d66d4ae4fb429';
            var x = document.createElement('script');
            x.src = 'https://umnico.com/assets/widget-loader.js';
            x.type = 'text/javascript';
            x.charset = 'UTF-8';
            x.async = true;
            document.body.appendChild(x);
        </script>


<script>
    $("#phone").mask("+7(999) 999-99-99");

    $('.reg_btn').on('click', function (e) {
        e.preventDefault();
        let cur = '';
        if ($('#radio1').is(':checked')) {
            cur = $('#radio1').val();
        } else {
            cur = $('#radio2').val();
        }
        let name = $('#name');
        if (name.val().length < 3) {
            name[0].setCustomValidity('Имя слишком короткое!');
            name[0].reportValidity();
            return;
        } else {
            name[0].setCustomValidity('');
        }

        let phone = $('#phone');
        if (phone.val().length < 5) {
            phone[0].setCustomValidity('Телефон обязательно для заполнения');
            phone[0].reportValidity();
            return;
        } else {
            phone[0].setCustomValidity('');
        }

        let email = $('#email');
        if (email.val().length < 5) {
            email[0].setCustomValidity('email обязательно для заполнения');
            email[0].reportValidity();
            return;
        } else {
            email[0].setCustomValidity('');
        }

        let password = $('#password').val();
        let password_rep = $('#passsword_rep').val();
        if ($('#check1').is(':checked')) {
            if ($('#check2').is(':checked')) {
                if (password == password_rep) {
                    if (password.length > 8) {
                        $.ajax({
                            url: "/reg",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                name: name.val(),
                                phone: phone.val(),
                                email: email.val(),
                                password: password,
                                cur: cur
                            },
                            success: function (response) {
                                if (response?.errors) {
                                    alert(response.errors);
                                }

                                if (response == 1) {
                                    location.reload();
                                }
                            },
                        });
                    } else {
                        let passwordInput = $('#password')[0];
                        passwordInput.setCustomValidity('Пароль слишком короткий!');
                        passwordInput.reportValidity();
                    }
                } else {
                    let passwordRepInput = $('#passsword_rep')[0];
                    passwordRepInput.setCustomValidity('Пароли не совпадают!');
                    passwordRepInput.reportValidity();
                }
            } else {
                let check2Input = $('#check2')[0];
                check2Input.setCustomValidity('Нажмите галочку "Мне уже есть 18 лет или больше"');
                check2Input.reportValidity();
            }
        } else {
            let check1Input = $('#check1')[0];
            check1Input.setCustomValidity('Нажмите галочку "Я прочитал и принял положения и условия"');
            check1Input.reportValidity();
        }
    });

    $('.login_btn').on('click', function (e) {
        e.preventDefault();
        let email_login = $('#email_login').val();
        let password_login = $('#password_login').val();
        $.ajax({
            url: "/auth",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                email_login: email_login,
                password_login: password_login,
            },
            success: function (response) {
                if (response == 1) {
                    document.location.href = '/';
                } else {
                    let emailLoginInput = $('#email_login')[0];
                    emailLoginInput.setCustomValidity('Логин и/или пароль не подходит');
                    emailLoginInput.reportValidity();
                }
            },
        });
    });

    $('#file_avatar').change(function (event) {
        var tmp_url = window.URL.createObjectURL(event.target.files[0]);


        $("#preview-image").attr("src", tmp_url).show();

        $("#user-avatar").hide();
    });

    $('#file_avatar-2').change(function (event) {
        var tmp_url = window.URL.createObjectURL(event.target.files[0]);


        $("#preview-image-2").attr("src", tmp_url).show();

        $("#user-avatar-2").hide();
    });


    $('.user_update').on('click', function () {
        let user_id = $('.user_id').val();
        let name = $('.private_name').val();
        let login = $('.private_login').val();
        let country = $('div[data-id="1"] .select__content').text();
        let email = $('.private_email').val();
        let phone = $('.private_phone').val();
        let balance = $('.balance-priv__val.bal').val();
        let bonus = $('.balance-priv__val.bonus').val();
        let cur = $('.select_cur-bln select').val();
        let password_1 = $('.private_password_1').val();
        let password_2 = $('.private_password_2').val();
        let adminlabel = $('.private_adminlabel').val();
        let role = $('div[data-id="3"] .select__content').text();

        let docum = $('.doc ._js-active').text() == ' Нет' ? 0 : 1;
        let ban = $('.ba ._js-active').text() == ' Нет' ? 0 : 1;
        let nomo = $('.nomon ._js-active').text() == ' Нет' ? 0 : 1;
        let vivod = $('.vivod ._js-active').text() == ' Нет' ? 0 : 1;
        let transfer = $('.transfer ._js-active').text() == ' Нет' ? 0 : 1;

        $.ajax({
            url: "/adminuseredit",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                name: name,
                login: login,
                country: country,
                email: email,
                phone: phone,
                password_1: password_1,
                password_2: password_2,
                adminlabel: adminlabel,
                role: role,
                docum: docum,
                ban: ban,
                nomo: nomo,
                vivod: vivod,
                transfer: transfer,
                user_id: user_id,
                balance: balance,
                bonus: bonus,
                cur: cur
            },
            success: function (response) {
                if (response == 'erp') {
                    showNotification('error', 'Пароли не совпадают!');
                } else {
                    showNotification('success', 'Данные успешно обновлены!');
                    document.location.href = '/private/' + response;
                }
            },
        });
    });

    $('.balance_update').on('click', function () {
        let balance = $('.balance-priv__val.bal').val();
        let bonus = $('.balance-priv__val.bonus').val();
        let user_id = $('.user_id').val();

        $.ajax({
            url: "/adminuserbalanceedit",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                balance: balance,
                bonus: bonus,
                user_id: user_id,
            },
            success: function (response) {
                if (response == 'erp') {
                    showNotification('error', 'Пароли не совпадают!');
                } else {
                    showNotification('success', 'Данные успешно обновлены!');
                    document.location.href = '/private/' + response;
                }
            },
        });
    });

    $('.docum').on('click', function () {
        $('.docum').removeClass('_js-active');
        $(this).addClass('_js-active');
    });
    $('.ban').on('click', function () {
        $('.ban').removeClass('_js-active');
        $(this).addClass('_js-active');
    });
    $('.nomo').on('click', function () {
        $('.nomo').removeClass('_js-active');
        $(this).addClass('_js-active');
    });
    $('.vivo').on('click', function () {
        $('.vivo').removeClass('_js-active');
        $(this).addClass('_js-active');
    });
    $('.transfe').on('click', function () {
        $('.transfe').removeClass('_js-active');
        $(this).addClass('_js-active');
    });
    $('.delete_user').on('click', function () {
        let conf = confirm('Вы уверены, что хотите удалить данного пользователя!');
        if (conf) {
            let user_id = $('.user_id').val();
            $.ajax({
                url: "/adminuserdelete", // Убедитесь, что этот URL соответствует маршруту
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}", // Убедитесь, что токен корректен
                    user_id: user_id,
                },
                success: function (response) {
                    if (response.status === 'success') {
                        showNotification('success', response.message);
                        document.location.href = '/private';
                    } else {
                        showNotification('error', response.message);
                    }
                },
                error: function (xhr) {
                    console.error('Ошибка при удалении:', xhr.responseJSON); // Выводим ошибку для диагностики
                    showNotification('error', 'Ошибка при удалении пользователя: ' + xhr.responseJSON.message);
                }
            });
        }
    });

    $('.user_stavki').on('click', function () {
        let user_id = $('.user_id').val();
        $.ajax({
            url: "/adminuserliststavki",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                user_id: user_id,
            },
            success: function (response) {
                if (response.length) {
                    $('.wrap-table-ipr').empty();
                    $('.wrap-table-ipr').append(response);
                } else {
                    const error =
                        `<div class="error-data">
                        Данных не обнаружено
                    </div>`;
                    $('.wrap-table-ipr').empty();
                    $('.wrap-table-ipr').append(error);
                }
            },
        });
    });
    let timer
    $('.search_sports').on('input', function () {
        let word = $('.search_sports').val();
        let url = '{{$_SERVER["REQUEST_URI"]}}';

        clearTimeout(timer);

        if (word.length) {
            timer = setTimeout(() => {
                $.ajax({
                    url: "/searchtxt",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        word: word,
                        url: url
                    },
                    success: function (response) {
                        const newArticle = $(`
                        <article class="spoiler leagues__sect events _js-active">
                            <div class="leagues__top" data-btn-sel="">
                                <div class="leagues__l-top">
                                    <div class="leagues__ico"><img class="p-img-c" src="/img/games/gg-asd.svg" loading="lazy" width="100" height="100" alt="img"></div>
                                    <h3>События</h3>
                                </div>
                                <button class="btn-v spoiler__btn" type="button" aria-label="кнопка" data-go-btn="tl20"><img class="p-img-c" src="/img/ico/v2.svg" loading="lazy" width="100" height="100" alt="img"></button>
                            </div>
                            <div class="spoiler__hide">
                                <ul class="leagues__list list-leag">
                                    ${response}
                                </ul>
                            </div>
                        </article>
                    `)
                        $(".spoiler.leagues__sect.events").remove();
                        $(".spoiler.leagues__sect").hide();
                        $(".leagues__line.search").after(newArticle);
                    },
                });
            }, 500);
        } else {
            $(".spoiler.leagues__sect.events").remove();
            $(".spoiler.leagues__sect").show();
        }
    });

    $('.b_2').hide();
    $('.add_stavka').on('click', function () {
        $('.b_1').hide();
        $('.b_2').show();
    });

    $('.koef').on('click', function () {
        $('.koef').removeClass('active');
        $(this).addClass('active');
    });
    $('.add_btn_minus').on('click', function () {
        if (parseInt($('.switch-dsb__val').text()) < 100) $('.switch-dsb__val').text('0');
        else $('.switch-dsb__val').text(parseInt($('.switch-dsb__val').text()) - 100);
    });
    $('.add_btn_plus').on('click', function () {
        $('.switch-dsb__val').text(parseInt($('.switch-dsb__val').text()) + 100);
    });

    $('.add_fcs').on('click', function () {
        let price = parseInt($('.switch-dsb__val').text());
        let arr_res_k = [];
        let r = $('.active').attr('data');
        let k = [];
        if (r == 1) {
            k.push($('.k1').val());
        }
        if (r == 2) {
            k.push($('.k2').val());
        }
        if (r == 3) {
            k.push($('.k3').val());
        }

        let arr_arr_team = [];
        let arr_game_id = [];
        arr_game_id.push($('.game_id').val());
        arr_arr_team.push($('.active').text());

        $.ajax({
            url: '/ajaxstavka',
            method: 'post',
            dataType: 'html',
            data: {
                '_token': '{{csrf_token()}}',
                arr_res_k: k,
                arr_res_game_id: arr_game_id,
                arr_team: arr_arr_team,
                price: price
            },
            success: function (data) {
                if (data == 0) {
                    showNotification('error', 'Чтобы сделать ставки необходимо зарегистрироваться или авторизироваться!');
                }
                if (data == 1) {
                    showNotification('error', 'Недостаточно денег на счету!');
                }
                if (data == 2) {
                    showNotification('success', 'Вы успешно сделали ставки!');
                    document.location.href = '/bets/1/11121/480123957';
                }
            }
        });
    });

    const body = document.querySelector('body');
    const firstTextNode = body.childNodes[0];
    if (firstTextNode.nodeType === Node.TEXT_NODE) {
        firstTextNode.parentNode.removeChild(firstTextNode);
    }

    $('#deposit .form__submit').on("click", function () {
        const form = $('#deposit .form');
        const sum = parseFloat(form.find('.form__input[name="sum"]').val());
        const details = form.find('.form__input[name="details"]').val();
        const payment_gateway = form.find('.form__input[name="payment_gateway"]').val();

        form.find('.form__input').removeClass('input-error');

        let isValid = true;
        let minAmount = 0;

        switch (payment_gateway) {
            case 'Visa/Mastercard':
                minAmount = 10;
                if (details.length !== 16) {
                    showNotification('error', 'Реквизиты Visa/Mastercard должны содержать 16 цифр.');
                    form.find('.form__input[name="details"]').addClass('input-error');
                    isValid = false;
                    return
                }
                break;
            case 'Payeer':
                minAmount = 10;
                if (details.length < 5) {
                    showNotification('error', 'Реквизиты Payeer должны содержать не менее 5 символов.');
                    form.find('.form__input[name="details"]').addClass('input-error');
                    isValid = false;
                    return
                }
                break;
            case 'BTC':
            case 'USDT':
            case 'TON':
            case 'ETH':
                minAmount = 10;
                if (details.length < 26) {
                    showNotification('error', `Реквизиты ${payment_gateway} должны содержать не менее 26 символов.`);
                    form.find('.form__input[name="details"]').addClass('input-error');
                    isValid = false;
                    return
                }
                break;
            default:
                minAmount = 0;
                break;
        }

        if (!sum || isNaN(sum) || sum <= 0) {
            showNotification('error', 'Введите корректную сумму.');
            form.find('.form__input[name="sum"]').addClass('input-error');
            isValid = false;
        }

        if (sum < minAmount) {
            showNotification('error', `Минимальная сумма для ${payment_gateway} составляет ${minAmount}`);
            form.find('.form__input[name="sum"]').addClass('input-error');
            isValid = false;
        }

        if (!details) {
            showNotification('error', 'Введите корректные реквизиты.');
            form.find('.form__input[name="details"]').addClass('input-error');
            isValid = false;
        }

        if (!payment_gateway) {
            showNotification('error', 'Выберите способ оплаты.');
            form.find('.form__input[name="payment_gateway"]').addClass('input-error');
            isValid = false;
        }

        if (!isValid) {
            return;
        }

        $.ajax({
            url: `/payment/withdrawal`,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                sum,
                details,
                payment_gateway,
            },
            success: function (response) {
                if (response?.errors) {
                    for (const error in response.errors) {
                        showNotification('error', response.errors[error][0]);
                        return;
                    }
                }

                if (response?.status === 'exists') {
                    showNotification('info', 'У вас уже есть заявка на вывод средств. Пожалуйста, дождитесь ее обработки.');
                    return;
                }

                if (response?.status === 'no_money') {
                    showNotification('error', 'Недостаточно средств на балансе');
                    return;
                }

                if (response?.status === 'no_vivod') {
                    const message = response.no_vivod_message; // Добавьте полный текст сообщения здесь
                    showNotification('error', message);
                    return;
                }

                if (response?.success_message) {
                    showNotification('info', response.success_message);
                }

                if (response?.message) {
                    showNotification('success', response.message);
                    $('.popup.page__popup.popup_show').removeClass('popup_show');
                    $('html').removeClass("popup-show lock");
                }
            },
        });
    });

    function showNotificationRegister(type, message) {
        const notificationPopup = $('#notificationPopup');
        const notificationMessage = $('#notificationMessage');

        notificationMessage.text(message);
        notificationPopup.addClass('active');

        setTimeout(function () {
            notificationPopup.removeClass('active');
        }, 3000);
    }

    $('.popup-close, #reloadButton').on('click', function () {
        location.reload();
    });

    if (window.location.hash) {
        history.replaceState(null, null, ' ');
    }


    function showNotification(type, text) {
        const id = 'notification-' + Date.now();

        const html = `
        <div class="notification-wrapper" id="${id}" style="height: 0; overflow: hidden;">
            <div class="notifications-message notifications-${type}">
                <div class="notification-text">${text}</div>
                <div class="notification-indicator">
                    <div></div>
                </div>
            </div>
        </div>
    `;

        $('#deposit .notifications').append(html);

        const $wrapper = $(`#${id}`);
        const naturalHeight = $wrapper.prop('scrollHeight');

        $wrapper.animate({height: naturalHeight}, 300, function () {
            $(this).css('height', 'auto');
        });

        setTimeout(() => {
            $wrapper.fadeOut(400, function () {
                $(this).remove();
            });
        }, 5000);
    }
</script>
<script>
    const formData = new FormData(); // Создаем глобальный объект FormData

    document.querySelector('#verifyForm .form__input[type="file"]').addEventListener("change", function () {
        const preview = document.querySelector('#image-preview');

        if (this.files) {
            [].forEach.call(this.files, readAndPreview);
        }

        function readAndPreview(file) {
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                return alert(file.name + " не является изображением");
            }

            formData.append('files[]', file);

            const reader = new FileReader();

            reader.addEventListener("load", function () {
                const imagePreviewDiv = document.createElement('div');
                imagePreviewDiv.classList.add('image-preview');

                const image = new Image();
                image.height = 100; // Set the height of preview image
                image.title = file.name;
                image.src = reader.result;

                const removeButton = document.createElement('button');
                removeButton.innerText = 'X';
                removeButton.type = 'button';
                removeButton.addEventListener('click', function (event) {
                    event.stopPropagation(); // Prevent the event from bubbling up
                    event.preventDefault(); // Prevent default action
                    formData.delete('files[]', file); // Remove the file from formData
                    imagePreviewDiv.remove(); // Remove the image preview from DOM
                });

                imagePreviewDiv.appendChild(image);
                imagePreviewDiv.appendChild(removeButton);
                preview.appendChild(imagePreviewDiv);
            });

            reader.readAsDataURL(file);
        }
    });

    document.querySelector('#verifyForm').addEventListener('submit', function (e) {
        e.preventDefault();

        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: '/user/verification-request', // URL для отправки запроса
            type: 'POST', // Метод запроса
            data: formData, // Передаем formData как данные
            processData: false, // Отключаем обработку данных jQuery
            contentType: false, // Отключаем установку заголовка Content-Type
            success: function (response) {
                if (response.message) {
                    alert(response.message);
                    $('.popup.page__popup.popup_show').removeClass('popup_show');
                    $('html').removeClass("popup-show lock");
                }
            },
            error: function (xhr, status, error) {
                if (xhr.responseJSON.message) {
                    alert(xhr.responseJSON.message);
                    $('.popup.page__popup.popup_show').removeClass('popup_show');
                    $('html').removeClass("popup-show lock");
                }
            }
        });
    });

    $('.pay-btn').on('click', function () {
        $(this).closest('.box-pay').find('.pay-btn').removeClass('active');
        $(this).addClass('active');
    });

    $('#ppBalance .next-step').on("click", function () {
        $('#ppBalance .box-pay-step1').hide();
        $('#ppBalance .box-pay-step2').show();
    });

    $('[data-popup="#ppBalance"]').on("click", function () {
        $('#ppBalance .box-pay-step1').show();
        $('#ppBalance .box-pay-step2').hide();

        $('.box-pay').find('.pay-btn').removeClass('active');
        $('#ppBalance form input').val("");
    });

    $('#forgotpassword .form').on("submit", function (e) {
        e.preventDefault();

        $('.popup.page__popup.popup_show').removeClass('popup_show');
        $('html').removeClass("popup-show lock");
    });
</script>
<style>
    .image-preview {
        position: relative;
        display: inline-block;
        margin: 10px;
    }

    .image-preview img {
        max-width: 100px;
        max-height: 100px;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        background: #f9f9f9;
    }

    .image-preview button {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(255, 0, 0, 0.7);
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
</style>
<script>
function setWidgetBottom() {
  const wrapper = document.getElementById('umnico-widget-wrapper');
  
  if (wrapper && wrapper.shadowRoot) {
    const widgetPreview = wrapper.shadowRoot.querySelector('.widget__preview-block');
    
    if (widgetPreview) {
      widgetPreview.style.bottom = '80px'; // Ваше значение
      return true; // Успешно
    }
  }
  return false;
}

if (!setWidgetBottom()) {
  const interval = setInterval(() => {
    if (setWidgetBottom()) {
      clearInterval(interval);
      console.log('Стиль успешно применен!');
    }
  }, 100);
}
</script>

@stack('scripts')
</body>
</html>
