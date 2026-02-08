<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="/css/style.min.css?_v=20230904172117">
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
    <link rel="apple-touch-icon" sizes="57x57" href="/img/favicon/favicon.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/img/favicon/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/favicon.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/favicon/favicon.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/favicon.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/img/favicon/favicon.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/img/favicon/favicon.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/favicon/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/img/favicon/favicon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="//img/favicon/favicon.png">
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
                    <a class="header__logo logo" href="/"><img class="p-img-c" src="/img/logo.png" loading="lazy"
                                                               width="100" height="100" alt="img"></a>
                    <div data-side="right" class="header__nav-bg-mbl" data-burger="header"></div>
                        <nav class="header__nav nav">
                            <ul class="nav__list">
                                <li class="header__mbl nav__btn-box header__of-mbl-login"
                                    @if (Auth::check()) style="display: none;" @endif>
                                    <button class="btn btn-in nav__btn btn-fh btn-fh--b" type="button" aria-label="кнопка"
                                            data-popup="#pplogin">Войти
                                    </button>
                                    <button style="background-color: #d42a28" class="btn nav__btn btn-fh" type="button"
                                            aria-label="кнопка" data-popup="#ppReg"><span class="btn__ico"> <img
                                                class="p-img-c" src="/img/plus.png" loading="lazy" width="100" height="100"
                                                alt="img"></span><span>Регистрация</span></button>
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
                                            <span class="btn__ico"> <img class="p-img-c" src="/img/plus.png"
                                                                         loading="lazy" width="100" height="100"
                                                                         alt="img"></span><span>Пополнить </span>
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
                                                data-popup="#ppBalance"><span class="btn__ico"> <img class="p-img-c"
                                                                                                     src="/img/plus.png"
                                                                                                     loading="lazy"
                                                                                                     width="100"
                                                                                                     height="100" alt="img"></span><span>Пополнить</span>
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

                                <li class="nav__itm"
                                    @if (Auth::check()) @if(auth()->user()->role->id==1) style="display: none" @endif @endif>
                                    <a href="/casino">Казино</a></li>
                                

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
                    <button class="btn" type="button" aria-label="кнопка" data-popup="#ppReg"><span
                            class="btn__ico"> <img class="p-img-c" src="/img/plus.png" loading="lazy" width="100"
                                                   height="100" alt="img"></span><span>Регистрация</span></button>
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
                        <button class="btn btn-bolster" type="button" aria-label="кнопка" data-popup="#ppBalance"><span
                                class="btn__ico"> <img class="p-img-c" src="/img/plus.png" loading="lazy" width="100"
                                                       height="100" alt="img"></span><span>Пополнить</span></button>
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
                        <button class="btn" type="button" aria-label="кнопка" data-popup="#ppBalance"><span
                                class="btn__ico"> <img class="p-img-c" src="/img/plus.png" loading="lazy" width="100"
                                                       height="100" alt="img"></span><span>Пополнить</span></button>
                    </div>
                @endif
            </div>
            <section class="header__footer-box" @if (Auth::check()) style="display: none;" @endif>
                <div class="header__r header__mbl header__of-mbl-login header__box-fh"
                     @if (Auth::check()) style="display: none;" @endif>
                    <button class="btn btn-fh btn-fh--b btn-in" type="button" aria-label="кнопка" data-popup="#pplogin">
                        Войти
                    </button>
                    <button style="background-color: #d42a28; " class="btn btn-fh" type="button" aria-label="кнопка"
                            data-popup="#ppReg"><span class="btn__ico"> <img class="p-img-c" src="/img/plus.png"
                                                                             loading="lazy" width="100" height="100"
                                                                             alt="img"></span><span>Регистрация</span>
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
                               placeholder="Почта" autocomplete="off" required>
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
                <li class="nav-ftr__itm"><a href="/casino">Казино</a></li>
                <li class="nav-ftr__itm"><a href="/sport">Спорт</a></li>


                @foreach(App\Http\Controllers\FooterLinkController::getFooterLinks() as $link)
                    <li class="nav-ftr__itm"><a href="/{{ $link->url }}">{{ $link->title }}</a></li>
                @endforeach
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


            <div class="footer__line-box"><a href="mailto:fonbetkz.supp@outlook.com ">Email адрес службы поддержки -
                    fonbetkz.supp@outlook.com </a></div>
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
                    <img src="/img/ico/list.png" alt="Спорт">
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
                    <img src="/img/ico/voucher.png" alt="Мои ставки">
                    <span>Мои ставки</span>
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
<script type = "text/javascript">
    (function(w, d, v3) {
        w.chaportConfig = {
            appId: '6728677af1d5626b7e11ba28'
        };

        if (w.chaport) return;
        v3 = w.chaport = {};
        v3._q = [];
        v3._l = {};
        v3.q = function() {
            v3._q.push(arguments)
        };
        v3.on = function(e, fn) {
            if (!v3._l[e]) v3._l[e] = [];
            v3._l[e].push(fn)
        };
        var s = d.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'https://app.chaport.com/javascripts/insert.js';
        var ss = d.getElementsByTagName('script')[0];
        ss.parentNode.insertBefore(s, ss)
    })(window, document); <
/script>

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
                url: "/adminuserdelete",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
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
                    console.error('Ошибка при удалении:', xhr.responseJSON);
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
                    const message = response.no_vivod_message;
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
    const formData = new FormData();

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
                image.height = 100;
                image.title = file.name;
                image.src = reader.result;

                const removeButton = document.createElement('button');
                removeButton.innerText = 'X';
                removeButton.type = 'button';
                removeButton.addEventListener('click', function (event) {
                    event.stopPropagation();
                    event.preventDefault();
                    formData.delete('files[]', file);
                    imagePreviewDiv.remove();
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
            url: '/user/verification-request',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
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


@stack('scripts')
</body>
</html>
