@extends('main')
@section('title', 'Букмекерская компания')
@section('content')
    <main class="main">
        <div class="_container p-wrap-aside">
            <aside class="leagues p__leagues">
                <div class="hed-leag leagues__head">
                    <button class="btn-self _js-active" type="button" aria-label="кнопка" data-r-btn="a1">Линия</button>
                    <button class="btn-self" type="button" aria-label="кнопка" data-r-btn="a1">Live</button>
                </div>
                <article class="leagues__line line-lg">
                    <h6>Все<br>события</h6>
                    <div class="line-lg__line"><span> </span><span> </span><span> </span><span> </span><span> </span><span> </span><span class="_js-active"> </span></div>
                </article>
                <label class="leagues__line search">
                    <input class="search__inp" type="text" name="search" placeholder="Поиск" autocomplete="off"><span class="search__ico"><img class="p-img-c" src="/img/svg/search.svg" loading="lazy" width="100" height="100" alt="img"></span>
                </label>
                <article class="spoiler leagues__sect _js-active" data-sel-target="">
                    <div class="leagues__top" data-btn-sel="">
                        <div class="leagues__l-top">
                            <div class="leagues__ico"><img class="p-img-c" src="/img/games/gg-asd.svg" loading="lazy" width="100" height="100" alt="img"></div>
                            <h3>Виды спорта</h3>
                        </div>
                        <button class="btn-v spoiler__btn" type="button" aria-label="кнопка" data-go-btn="tl20"><img class="p-img-c" src="/img/ico/v2.svg" loading="lazy" width="100" height="100" alt="img"></button>
                    </div>
                    <div class="spoiler__hide">
                        <ul class="leagues__list list-leag">
                            @foreach($arr_res_sport as $arr_res_spor)
                                <li class="list-leag__box-itm">
                                    <a class="list-leag__itm" href="/bets/{{$arr_res_spor['id_sport']}}"> <span class="list-leag__ico">
                                    <picture>
                                        <img class="p-img-c" src="{{$arr_res_spor['img']}}" loading="lazy" width="100" height="100" alt="иконка">
                                    </picture></span><span>{{$arr_res_spor['name']}}</span>
                                    </a>
                                    <div class="list-leag__r-itm">
                                        <span class="list-leag__i-val">@if(isset($arr_res_spor['counter'])) {{$arr_res_spor['counter']}} @else 0 @endif</span>
                                        <span class="btn-v spoiler__btn" type="button" aria-label="кнопка" data-go-btn="tl20">
                                    <img class="p-img-c" src="/img/ico/v2.svg" loading="lazy" width="100" height="100" alt="img">
                                </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </article>
                <article class="spoiler leagues__sect _js-active" data-sel-target="">
                    <div class="leagues__top">
                        <div class="leagues__l-top">
                            <div class="leagues__ico">
                                <picture>
                                    <source srcset="/img/ico/l1.avif" type="image/avif">
                                    <source srcset="/img/ico/l1.webp" type="image/webp">
                                    <img class="p-img-c" src="/img/ico/l1.png" loading="lazy" width="100" height="100" alt="img">
                                </picture>
                            </div>
                            <h3>Топ лиги</h3>
                        </div>
                        <button class="btn-v spoiler__btn" type="button" aria-label="кнопка" data-btn-sel="">
                            <img class="p-img-c" src="/img/ico/v2.svg" loading="lazy" width="100" height="100" alt="img">
                        </button>
                    </div>
                    <div class="spoiler__hide">
                        <ul class="leagues__list list-leag">
                            @if ($data_leagues == null)
                                Данные не загружены
                            @else
                                @foreach($data_leagues as $data_league)
                                    <li>
                                        <a class="list-leag__itm" href="/bets/{{$data_league->sport_id}}/{{$data_league->id}}">
                            <span class="list-leag__ico">
                                <picture>
                                    <img class="p-img-c" src="/{{$data_league->image}}" loading="lazy" width="100" height="100" alt="иконка">
                                </picture>
                            </span>
                                            <span>{{$data_league->name}}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </article>

            </aside>
                <section class="sport">
                    <h3>Мои ставки</h3>
                    <table class="table-ipr table_res">
                        <thead class="table-ipr__top">
                        <tr>
                            <th>ID</th>
                            <th>Коэфициент</th>
                            <th>Сумма</th>
                            <th>Дата</th>
                            <th>Статус</th>
                            <th>Возможный выигрыш</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stavki as $st)
                            <tr class="table-ipr__line">
                                <td>{{ str_pad($st->dummy_id, 9, '0', STR_PAD_LEFT) }}</td>
                                <td class="table-ipr__inc">{{ $st->k }}</td>
                                <td>{{ $st->summa }}
                                    @if (Auth::check())

                                        @if (auth()->user()->cur == 'RUB')
                                             ₽
                                        @else
                                             ₸
                                        @endif

                                    @endif
                                </td>
                                <td class="table-ipr__td-clm">
                                    <span>{{ date('d.m.Y', strtotime($st->created_at)) }}</span>
                                    <span>{{ date('H:i', strtotime($st->created_at)) }}
                                    <span class="table-ipr__small">55</span>
                                </span>
                                </td>
                                <td class="@if($st->status == 'Победа') status-win @endif">{{ $st->status }}</td>
                                <td>{{ intval($st->summa * $st->k) }}
                                    @if (Auth::check())

                                        @if (auth()->user()->cur == 'RUB')₽
                                        @else
                                            ₸
                                        @endif

                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
                <aside class="coupon-as">
                <article class="coupon coupon-as__cup spoiler _js-active" data-go-target="c1">
                    <div class="coupon__top">
                        <h3 class="coupon__ttl">Купон</h3>
                        <button class="btn-v spoiler__btn" type="button" aria-label="кнопка" data-go-btn="c1"><img class="p-img-c" src="/img/ico/v2.svg" loading="lazy" width="100" height="100" alt="img"></button>
                    </div>
                    <div class="spoiler__box">
                        <form class="coupon__c-box c-cup" action="#!" method="POST">
                            <div class="c-cup__ct-box">
                                <input class="radio-cc _hide" id="radio11" type="radio" name="coupon" aria-label="чекбокс" checked="checked">
                                <label class="lbl-cc" for="radio11">Ординар</label>
                                <input class="radio-cc _hide" id="radio12" type="radio" name="coupon" aria-label="чекбокс">
                                <label class="lbl-cc" for="radio12">Экспресс</label>
                                <input class="radio-cc _hide" id="radio13" type="radio" name="coupon" aria-label="чекбокс">
                                <label class="lbl-cc" for="radio13">Система</label>
                            </div>
                            <div class="h1">
                                <div class="coupon__bets"></div>

                            </div>
                            <h4 class="c-cup__ttl coupon__ttl">Выберите событие</h4>
                            <div class="c-cup__box-btn">
                                <input class="radio-acp _hide" id="check11" type="checkbox" name="checked-coupon" aria-label="чекбокс" checked="checked">
                                <label class="lbl-acp coupon__acpt" for="check11"><span>Всегда соглашаться с изменением коэффициента</span></label>
                                <button class="btn c-cup__btn" type="button" aria-label="кнопка">Сделать ставку</button>
                            </div>
                        </form>
                    </div>
                </article>
                <article class="a-create-bet">
                    <div class="a-create-bet__box">
                        <h3 class="a-create-bet__ttl">Любые матчи и события по вашим правилам!</h3>
                        <p>Выбирайте событие и создавайте свои коэффициенты для более эффективных ставок в нашем новом и удобном конструкторе.</p>
                    </div>
                    <button class="btn c-cup__btn" type="button" aria-label="кнопка">Сделать ставку</button>
                </article>
            </aside>
        </div>
    </main>
@endsection
