 @extends('main')
@section('title', 'Букмекерская компания')
@section('content')
<style>
  body {
    --container-background-color: #090F1E;
    --primary-background-color: #505053;
    --primary-text-color: #fff;
    --secondary-background-color: #242e49;
    --secondary-text-color: #fff;
    --tertiary-background-color: #EDF2FF;
    --tertiary-text-color: #000;
    --blur-background-color: var(--primary-background-color);
    --gray-text-color1: #9196a4;
    --primary-gradient-background-color1: rgb(30, 40, 63);
    --primary-gradient-background-color2: rgba(28, 38, 64, 0.6);
    --primary-gradient-text-color: #fff;
    --scrollbar-track-background-color: #505053;
    --scrollbar-thumb-background-color: #282d3a;
    --secondary-gradient-background-color1: #108de7;
    --secondary-gradient-background-color2: #d42a28;
    --secondary-gradient-text-color: #fff;
    --skeleton-gradient-background-color1: #1C2438;
    --skeleton-gradient-background-color2: #202B45;
    --icon-background-color: #d42a28;
    --primary-active-background-color: #d42a28;
    --primary-active-text-color: #fff;
    --primary-seperator-background-color: #caddfd;
    --secondary-seperator-background-color: #40475d;
    --line-background-color: #d42a28;
    --line-text-color: #fff;
    --live-background-color: #E92541;
    --live-text-color: #fff;
    --vs-background-color: #d42a28;
    --player1-text-color: #3DA5FF;
    --player2-text-color: #93C738;
    --primary-odd-background-color: #D0DAF3;
    --primary-odd-text-color: #090F1E;
    --primary-odd-active-background-color: #c4f027;
    --primary-odd-active-text-color: #000;
    --primary-odd-empty-background-color: #E7EDFC;
    --secondary-odd-background-color: #2d3750;
    --secondary-odd-text-color: #fff;
    --secondary-odd-active-background-color: #c4f027;
    --secondary-odd-active-text-color: #000;
    --secondary-odd-empty-background-color: #263048;
    --collection-background-color: #d6dcec;
    --coupon-bet-background-color: #fff;
    --coupon-bet-text-color: #000;
    --tab-active-background-color: #d42a28;
    --tab-active-text-color: #fff;
    --input-background-color: #1f2841;
    --input-active-background-color: #2A375A;
    --input-text-color: #fff;
    --dropdown-background-color: #1f2841;
    --dropdown-active-background-color: #2A375A;
    --dropdown-text-color: #fff;
    --dropdown-content-background-color: #fff;
    --dropdown-content-active-background-color: #e9e9e9;
    --dropdown-content-text-color: #000;
    --selector-active-background-color: #2196f3;
    --selector-disabled-background-color: #ccc;
    --primary-button-background-color: #d42a28;
    --primary-button-text-color: #fff;
    --secondary-button-background-color: #273046;
    --secondary-button-text-color: #fff;
    --tertiary-button-background-color: #d42a28;
    --tertiary-button-text-color: #000;
    --gradient-button-background-color1: #108de7;
    --gradient-button-background-color2: #d42a28;
    --gradient-button-text-color: #fff;
    --small-border-radius: 4px;
    --default-border-radius: 8px;
    --big-border-radius: 15px;
    --left_panel-size: 270px;
    --right_panel-size: 300px;
    --container-height: 100vh;
    --top-margin: 10px;
    --event-text-color: #fff;
    --disabled-background-color: rgba(20,27,46,.7);
    --gradient-button-background: linear-gradient(103deg, var(--gradient-button-background-color1) -30%, var(--gradient-button-background-color2));
    --primary-gradient-background: linear-gradient(110deg, var(--primary-gradient-background-color1), var(--primary-gradient-background-color2) 100%);
    --secondary-gradient-background: linear-gradient(103deg,var(--secondary-gradient-background-color1) -30%,var(--secondary-gradient-background-color2));
    --skeleton-gradient-background: linear-gradient(to left, var(--skeleton-gradient-background-color1) 0%, var(--skeleton-gradient-background-color2) 30%, var(--skeleton-gradient-background-color1) 60%, var(--skeleton-gradient-background-color1) 100%) var(--skeleton-gradient-background-color1);
    --error-background-color: #e13434;
    --error-text-color: #fff;
    --success-background-color: #3a974d;
    --success-text-color: #fff;
    --transparent-background-color: rgba(255, 255, 255, 0.1);
    --transparent-text-color: #fff;
    --coupon_close-color: #000;
    --coupon_disabled_close-color: #fff;
    --coupon_possible_win-color: var(--dark_mint_green);
}
.mch-tab__cast-td span:hover{
  background: #c4f027;
}
.coupon__bets{

}
.h1{
  display: none;
  width: 203px;
}
.coupon .bet {
  margin-top: 10px;
    opacity: 1;
    transform: translateX(0px);
    position: relative;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    background: var(--coupon-bet-background-color);
    color: var(--coupon-bet-text-color);
    border-radius: var(--default-border-radius);
    transition: transform 0.2s ease-in-out 0s, opacity 0.2s ease-in-out 0s;
}
 .coupon .coupon__bets .bet__wrap {
    width: 100%;
}
 .coupon .coupon__bets .bet__wrap .bet__header {
    display: flex;
    justify-content: space-between;
}

 .coupon .coupon__bets .bet__wrap .bet__header .header__title {
    opacity: 0.8;
    font-size: 12px;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}
 .coupon .coupon__bets .bet__wrap .bet__header .header__cancel {
    position: relative;
    top: -3px;
}
 .close {
    opacity: 0.8;
    cursor: pointer;
    position: relative;
    display: inline-block;
    width: 15px;
    height: 15px;
    overflow: hidden;
    z-index: 1;
}
 .close::before {
    transform: rotate(45deg);
}
 .close::before {
    content: "";
    position: absolute;
    height: 2px;
    width: 100%;
    top: 50%;
    left: 0px;
    margin-top: -1px;
    background: var(--coupon_close-color);
}
 .close::after {
    transform: rotate(-45deg);
}
 .close::after {
    content: "";
    position: absolute;
    height: 2px;
    width: 100%;
    top: 50%;
    left: 0px;
    margin-top: -1px;
    background: var(--coupon_close-color);
}
 .coupon .coupon__bets .bet__wrap .bet__info {
    display: flex;
    align-items: center;
    overflow: hidden;
    width: 182px;
}
 .coupon .coupon__bets .bet__wrap .bet__info .bet__opps {
    width: 60%;
    font-size: 12px;
    position: relative;
}
 .coupon .coupon__bets .bet__wrap .bet__info .bet__opps::before {
    position: absolute;
    content: "";
    width: 3px;
    height: 100%;
    background: var(--primary-active-background-color);
    left: -10px;
    border-radius: 1px;
}
 .coupon .coupon__bets .bet__wrap .bet__info .bet__opps .opps-opp:first-child {
    margin-bottom: 3px;
}
 .coupon .coupon__bets .bet__wrap .bet__info .bet__opps .opps-opp {
    display: flex;
    align-items: center;
    column-gap: 5px;
}
 .coupon .coupon__bets .bet__wrap .bet__info .bet__opps .opps-opp .opp__icon {
    min-width: 15px;
    height: 15px;
    background-position: center center;
    background-size: contain;
    background-repeat: no-repeat;
}
 .coupon .coupon__bets .bet__wrap .bet__info .bet__opps .opps-opp .opp__name {
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    font-size: 12px;
}
 .coupon .coupon__bets .bet__wrap .bet__info .stake {
    width: 40%;
    padding: 6px 10px;
    text-align: center;
    border-radius: var(--default-border-radius);
    background: var(--primary-odd-background-color);
    color: var(--primary-odd-text-color);
    font-weight: 600;
}
 .stake__value .odd-change {
    position: absolute;
    left: 0px;
    display: none;
    animation: auto ease 0s 1 normal none running none;
    opacity: 0;
}

 .coupon .bet .bet__market {
    font-size: 10px;
    font-weight: 600;
    margin-top: 5px;
}
.info__odd {
    display: flex;
    font-weight: 600;
    margin-bottom: 20px;
    background: var(--primary-button-background-color);
    color: var(--primary-button-text-color);
    padding: 10px;
    border-radius: var(--default-border-radius);
    justify-content: space-between;
    font-size: 11px;
    margin-top: 10px
  }
 .sum__input {
    display: flex;

    align-items: center;
    font-weight: 600;
}
 .sum__input .input-button {
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s ease-in-out 0s, opacity 0.3s ease-in-out 0s;
    cursor: pointer;
    width: 24px;
    height: 24px;
    background-position: center center;
    background-repeat: no-repeat;
    opacity: 0.6;
}
.i--minus {
  height: 10px;
  width: 10px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 class=%27icon%27 fill=%27%23fff%27 viewBox=%270 0 121.805 121.804%27%3E%3Cg%3E%3Cpath d=%27M7.308,68.211h107.188c4.037,0,7.309-3.272,7.309-7.31c0-4.037-3.271-7.309-7.309-7.309H7.308C3.272,53.593,0,56.865,0,60.902C0,64.939,3.272,68.211,7.308,68.211z%27%3E%3C/path%3E%3C/g%3E%3C/svg%3E");
}
 input.input {
    background: var(--input-background-color);
    color: var(--input-text-color);
    border-radius: var(--default-border-radius);
    height: 30px;
    padding: 7px 10px 9px;
    width: 100%;
    min-width: 145px;
    text-align: center;
    transition: opacity 0.3s ease-in-out 0s;
}
 .sum__input .input-button {
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s ease-in-out 0s, opacity 0.3s ease-in-out 0s;
    cursor: pointer;
    width: 24px;
    height: 24px;
    background-position: center center;
    background-repeat: no-repeat;
    opacity: 0.6;
}
 .i--plus {
  height: 10px;
  width: 10px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 class=%27icon%27 fill=%27%23fff%27 viewBox=%270 0 426.66667 424.66667%27%3E%3Cg%3E%3Cpath d=%27m405.332031 192h-170.664062v-170.667969c0-11.773437-9.558594-21.332031-21.335938-21.332031-11.773437 0-21.332031 9.558594-21.332031 21.332031v170.667969h-170.667969c-11.773437 0-21.332031 9.558594-21.332031 21.332031 0 11.777344 9.558594 21.335938 21.332031 21.335938h170.667969v170.664062c0 11.777344 9.558594 21.335938 21.332031 21.335938 11.777344 0 21.335938-9.558594 21.335938-21.335938v-170.664062h170.664062c11.777344 0 21.335938-9.558594 21.335938-21.335938 0-11.773437-9.558594-21.332031-21.335938-21.332031zm0 0%27%3E%3C/path%3E%3C/g%3E%3C/svg%3E")
}
.info__sum{
  margin-bottom: 20px;
}
</style>

<main class="main">
        <div class="_container p-wrap-aside">

















<aside class="leagues p__leagues">
            <div class="hed-leag leagues__head">
              <button class="btn-self _js-active" type="button" aria-label="кнопка" data-r-btn="a1">  Линия</button>
              <button class="btn-self" type="button" aria-label="кнопка" data-r-btn="a1">Live</button>
            </div>

            <label class="leagues__line search">
              <input class="search__inp search_sports" type="text" name="search" placeholder="Поиск" autocomplete="off"><span class="search__ico"><img class="p-img-c" src="/img/svg/search.svg" loading="lazy" width="100" height="100" alt="img"></span>
            </label>
			<article class="spoiler  leagues__sect _js-active" data-sel-target="">
              <div class="leagues__top" data-btn-sel="">
                <div class="leagues__l-top">
                  <div class="leagues__ico"><img class="p-img-c" src="/img/games/gg-asd.svg" loading="lazy" width="100" height="100" alt="img"></div>
                  <h3>Виды спорта </h3>
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


          </aside>





















<div>

            <section class="match-li">
              <div class="match-li__top">
                <div class="match-li__ico"> <picture>
                  <img class="p-img-c" src="/img/games/gg1.png" loading="lazy" width="100" height="100" alt="img"></picture></div>
                <h2>Договорные матчи</h2>
              </div>













				@if(isset($tour))

				<div class="wrap-tab-ml">
				<table class="mch-tab match-li__tab">
                <thead class="mch-tab__head">
                  <tr class="mch-tab__tr">
                    <th class="mch-tab__th">Договорные матчи</th>

                      <th>1</th>

                      <th>X</th>

                      <th>2</th>

                      <th>1x</th>

                      <th>X</th>

                      <th>2x</th>

                      <th></th>

                      <th></th>

                      <th></th>

                    <th> </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($tour as $event)
                  <tr class="mch-tab__tr">
                    <td class="mch-tab__info"><span>{{date('H:i d.m', strtotime($event->created_at)+(3 * 60 * 60))}}</span>
                      <span class="mch-tab__i-name">
                        <span class="mch-tab__ico">
                          <picture>
                              <img class="p-img-c" src="/img/ico/ico1.png" loading="lazy" width="100" height="100" alt="img">
                            </picture>
                          </span>
                         <a href="{{route('dogmatch.game', ['id' => $event->id])}}">{{$event->name_1}}</a>
                       </span>
                       <span class="mch-tab__i-name"><span class="mch-tab__ico">
                        <img class="p-img-c" src="/img/ico/ico1.png" loading="lazy" width="100" height="100" alt="img">
                      </span>
                    <a href="{{route('dogmatch.game', ['id' => $event->id])}}">{{$event->name_2}}</a>
					</span>
					</td>

                    @if(isset($event->p_1))
						<td class="mch-tab__cast-td"><span id="sp{{$event->p_1}}_12" onclick="selectKoef('{{$event->name_1}}','{{$event->name_2}}', {{$event->p_1}}, {{$event->id}}, '{{$event->name_1}}', 12)">
						  {{$event->p_1}}
						</span> </td>
                    @else
						<td class="mch-tab__cast-td"><span>-</span></td>
                    @endif

					 @if(isset($event->p))
						<td class="mch-tab__cast-td"><span id="sp{{$event->p}}_13" onclick="selectKoef('{{$event->name_1}}','{{$event->name_2}}', {{$event->p}}, {{$event->id}}, 'Ничья', 13)">
						  {{$event->p}}
						</span> </td>
                    @else
						<td class="mch-tab__cast-td"><span>-</span></td>
                    @endif

					@if(isset($event->p_2))
						<td class="mch-tab__cast-td"><span id="sp{{$event->p_2}}_14" onclick="selectKoef('{{$event->name_1}}','{{$event->name_2}}', {{$event->p_2}}, {{$event->id}}, '{{$event->name_2}}', 14)">
						  {{$event->p_2}}
						</span> </td>
                    @else
						<td class="mch-tab__cast-td"><span>-</span></td>
                    @endif

					@if(isset($event->d_1))
						<td class="mch-tab__cast-td"><span id="sp{{$event->d_1}}_15" onclick="selectKoef('{{$event->name_1}}','{{$event->name_2}}', {{$event->d_1}}, {{$event->id}}, '1X', 15)">
						  {{$event->d_1}}
						</span> </td>
                    @else
						<td class="mch-tab__cast-td"><span>-</span></td>
                    @endif

					 @if(isset($event->d_12))
						<td class="mch-tab__cast-td"><span id="sp{{$event->d_12}}_16" onclick="selectKoef('{{$event->name_1}}','{{$event->name_2}}', {{$event->d_12}}, {{$event->id}}, 'X', 16)">
						  {{$event->d_12}}
						</span> </td>
                    @else
						<td class="mch-tab__cast-td"><span>-</span></td>
                    @endif

					@if(isset($event->d_2))
						<td class="mch-tab__cast-td"><span id="sp{{$event->d_2}}_17" onclick="selectKoef('{{$event->name_1}}','{{$event->name_2}}', {{$event->d_2}}, {{$event->id}}, '2X', 17)">
						  {{$event->d_2}}
						</span> </td>
                    @else
						<td class="mch-tab__cast-td"><span>-</span></td>
                    @endif


                  </tr>

                  @endforeach
                </tbody>
              </table>
			  </div>

				@endif





















                @if(isset($events_list))

				<div class="wrap-tab-ml">
                <table class="mch-tab match-li__tab">
                <thead class="mch-tab__head">
                  <tr class="mch-tab__tr">
                    <th class="mch-tab__th">{{$title}}</th>

                      <th>1</th>

                      <th>X</th>

                      <th>2</th>

                      <th>1x</th>

                      <th>X</th>

                      <th>2x</th>

                      <th>Тотал</th>

                      <th>Больше</th>

                      <th>Меньше</th>

                    <th> </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($events_list as $event)

                  <tr class="mch-tab__tr">
                    <td class="mch-tab__info"><span>{{date('H:i d.m', $event['game_start']+(3 * 60 * 60))}}</span>
                      <span class="mch-tab__i-name">
                        <span class="mch-tab__ico">
                          <picture>
                              <img class="p-img-c" src="/img/ico/ico1.png" loading="lazy" width="100" height="100" alt="img">
                            </picture>
                          </span>
                         <span>
                          <a href="{{$_SERVER['REQUEST_URI']}}/{{$event['game_id']}}">{{$event['opp_1_name_ru']}}</a></span>
                       </span>
                       <span class="mch-tab__i-name"><span class="mch-tab__ico">
                        <img class="p-img-c" src="/img/ico/ico1.png" loading="lazy" width="100" height="100" alt="img">
                      </span>
                      <span>
                        <a href="{{$_SERVER['REQUEST_URI']}}/{{$event['game_id']}}">{{$event['opp_2_name_ru']}}</a></span></span></td>

                       @if(isset($event['1x2'][0]['oc_rate']))
                    <td class="mch-tab__cast-td"><span id="sp{{$event['game_id']}}_12" onclick="selectKoef('{{$event['opp_1_name_ru']}}','{{$event['opp_2_name_ru']}}', {{$event['1x2'][0]['oc_rate']}}, {{$event['game_id']}}, '{{$event['1x2'][0]['oc_name']}}', 12)">

                      {{$event['1x2'][0]['oc_rate']}}

                    </span> </td>
                    @else
                    <td class="mch-tab__cast-td"><span>-</span></td>

                    @endif
                    @if(isset($event['1x2'][1]['oc_rate']))
                    <td class="mch-tab__cast-td"><span id="sp{{$event['game_id']}}_121" onclick="selectKoef('{{$event['opp_1_name_ru']}}','{{$event['opp_2_name_ru']}}', {{$event['1x2'][1]['oc_rate']}}, {{$event['game_id']}}, '{{$event['1x2'][1]['oc_name']}}', 121)">

                      {{$event['1x2'][1]['oc_rate']}}


                    </span> </td>
                    @else
                    <td class="mch-tab__cast-td"><span>-</span></td>
                    @endif
                    @if(isset($event['1x2'][2]['oc_rate']))
                    <td class="mch-tab__cast-td"><span id="sp{{$event['game_id']}}_122" onclick="selectKoef('{{$event['opp_1_name_ru']}}','{{$event['opp_2_name_ru']}}', {{$event['1x2'][2]['oc_rate']}}, {{$event['game_id']}}, '{{$event['1x2'][2]['oc_name']}}', 122)">

                      {{$event['1x2'][2]['oc_rate']}}


                    </span> </td>
                    @else
                    <td class="mch-tab__cast-td"><span>-</span></td>
                     @endif
                      @if(isset($event['two'][0]['oc_rate']))
                    <td class="mch-tab__cast-td"><span id="sp{{$event['game_id']}}_123" onclick="selectKoef('{{$event['opp_1_name_ru']}}','{{$event['opp_2_name_ru']}}', {{$event['two'][0]['oc_rate']}}, {{$event['game_id']}}, '{{$event['two'][0]['oc_name']}}', 123)">

                      {{$event['two'][0]['oc_rate']}}

                    </span> </td>
                    @else
                    <td class="mch-tab__cast-td"><span>-</span></td>
                    @endif
                    @if(isset($event['two'][1]['oc_rate']))
                    <td class="mch-tab__cast-td"><span id="sp{{$event['game_id']}}_124" onclick="selectKoef('{{$event['opp_1_name_ru']}}','{{$event['opp_2_name_ru']}}', {{$event['two'][1]['oc_rate']}}, {{$event['game_id']}}, '{{$event['two'][1]['oc_name']}}', 124)">

                      {{$event['two'][1]['oc_rate']}}


                    </span> </td>
                    @else
                    <td class="mch-tab__cast-td"><span>-</span></td>
                    @endif
                    @if(isset($event['two'][2]['oc_rate']))
                    <td class="mch-tab__cast-td"><span id="sp{{$event['game_id']}}_125" onclick="selectKoef('{{$event['opp_1_name_ru']}}','{{$event['opp_2_name_ru']}}', {{$event['two'][2]['oc_rate']}}, {{$event['game_id']}}, '{{$event['two'][2]['oc_name']}}', 125)">

                      {{$event['two'][2]['oc_rate']}}

                    </span> </td>
                    @else
                    <td class="mch-tab__cast-td"><span>-</span></td>
                     @endif
                     @if(isset($event['total'][0]['oc_rate']))
                    <td class="mch-tab__cast-td">
                      <span class="mch-tab__grid">
                      <span>


                      {{$event['total'][0]['oc_rate']}}


                      </span>
                      <span class="mch-tab__v-ico">
                        <img class="p-img-c" src="/img/ico/v.svg" loading="lazy" width="100" height="100" alt="img"></span>
                      </span>

                    </td>
                    @else
                    <td class="mch-tab__cast-td"><span>-</span></td>
                     @endif
                      @if(isset($event['b'][0]['oc_rate']))
                    <td class="mch-tab__cast-td"><span>

                      {{$event['b'][0]['oc_rate']}}


                    </span> </td>
                    @else
                    <td class="mch-tab__cast-td"><span>-</span></td>
                    @endif
                    @if(isset($event['m'][0]['oc_rate']))
                    <td class="mch-tab__cast-td"><span>

                      {{$event['m'][0]['oc_rate']}}


                    </span> </td>
                    @else
                     <td class="mch-tab__cast-td"><span>

                      -


                    </span> </td>
                    @endif
                    <td>+121</td>
                  </tr>

                  @endforeach
                </tbody>
              </table>
			  </div>
              @endif

            </section>
          </div>











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
                  <div class="coupon__bets">


                </div>
            <div class="info__odd">
              <div class="title">Итоговый коэффициент:</div>
              <div class="value">3.68</div>
            </div>
            <div class="info__sum">
              <div class="sum__input">
                <div class="input-button minus btn_minus" onclick="ButtunMinus()">
                  <div class="icon i--minus"></div>
                </div>
                <input placeholder="Сумма ставки" type="text" inputmode="decimal" autocorrect="off" autocapitalize="off" maxlength="10" autocomplete="off" value="100" class="input input_txt">
                <div class="input-button plus btn_plus" onclick="ButtunPlus()">
                  <div class="icon i--plus"></div>
                </div>
              </div>
            </div>
          </div>

                  <h4 class="c-cup__ttl coupon__ttl">Выберите событие</h4>
                  <div class="c-cup__box-btn">
                    <input class="radio-acp _hide" id="check11" type="checkbox" name="checked-coupon" aria-label="чекбокс" checked="checked">
                    <label class="lbl-acp coupon__acpt" for="check11"> <span>Всегда соглашаться с изменением коэффициента</span></label>
                    <button class="btn c-cup__btn" type="button" aria-label="кнопка"> Сделать ставку</button>
                  </div>
                </form>
              </div>

            </article>
            <article class="a-create-bet">
              <div class="a-create-bet__box">
                <h3 class="a-create-bet__ttl">Любые матчи и события по вашим правилам!</h3>
                <p>Выбирайте событие и создавайте свои коэффициенты для более эффективных ставок в нашем новом и удобном конструкторе.</p>
              </div>
              <button class="btn c-cup__btn" type="button" aria-label="кнопка"> Сделать ставку</button>
            </article>
          </aside>
        </div>
      </main>

<div data-popup="#ppNoBalance"></div>

<section class="popup page__popup" id="ppNoBalance" aria-hidden="true">
    <div class="popup__wrapper">
        <article class="popup__content popup-form">
            <button class="popup__close" type="button" data-close>
                    <span class="popup__ico-close">
                        <img class="p-img-c" src="/img/svg/cross2.svg" loading="lazy" width="100" height="100" alt="img">
                    </span>
            </button>
            <h2 class="popup-form__ttl">Ошибка !</h2>

            <div class="pp-notification" style="margin-bottom: 20px">
                Недостаточно средств на счету, пополните баланс!
            </div>
            <button style="height: 35px;" class="btn" data-popup="#ppBalance">Пополнить баланс</button>
        </article>
    </div>
</section>

      <script type="text/javascript">
        let res = [];
        let arr_res_k = [];
        let arr_res_game_id = [];
		let arr_team = [];
        var i = 0;
        function selectKoef(name_1, name_2, k, game_id, v, r){
			arr_team.push(v);
          var currentURL = window.location.href;

          var startIndex = currentURL.indexOf("/bets/");

          var extractedPath = currentURL.substr(startIndex);

          let fullPath = extractedPath+'/'+game_id;

          let fdc = "sp"+game_id+'_'+r;
          $("#sp"+game_id+'_'+r).css('background' ,'#c4f027');
          if(arr_res_k.includes(k) && arr_res_game_id.includes(game_id)){

          }else{

          f = '<div class="bet bet-appear-done"><div class="bet__wrap"><div class="bet__header"><div class="header__title">Договорной матч</div><div class="header__cancel"><div class="close" onclick="closeClick('+i+','+k+', '+game_id+', '+r+')"></div></div></div><div class="bet__info"><a href="'+fullPath+'" class="bet__opps"><div class="opps-opp opp--1"><div class="opp__icon" style="background-image: url(/img/ico/ico1.png);"></div><div class="opp__name">'+name_1+'</div></div><div class="opps-opp opp--1"><div class="opp__icon" style="background-image: url(/img/ico/ico1.png);"></div><div class="opp__name">'+name_2+'</div></div></a><div class="stake"><div class="stake__value"><span class="odd-change"></span><span class="odd formated-odd">'+k+'</span></div></div></div><div class="bet__details"><div class="bet__market">Победитель: '+v+'</div></div></div></div>';
          res.push(f);
          }
          $('.h1').show();
          $('.coupon__bets').html(res.join(''));
          arr_res_k.push(k);
          arr_res_game_id.push(game_id);
          i++;
          $('.value').text(sumK());
        }
        function closeClick(fc, k, game_id, fdc){
          let index = arr_res_k.indexOf(k);
          let index1 = arr_res_game_id.indexOf(game_id);
          arr_res_k.splice(index, 1);
          arr_res_game_id.splice(index1, 1);
          res[fc] = '';

          console.log(arr_res_k);

          $("#sp"+game_id+"_"+fdc).css('background', '#d0daf3');
          $('.coupon__bets').html(res.join(''));

          d = 0;
          res.forEach(function(item, i, res) {
            if(item != ''){
                d=1;
            }
          });
          if(d==0){
            $('.h1').hide();
          }

          $('.value').text(sumK());

        }


        function sumK(){
          let s = 0;
          for(var i = 0; i < arr_res_k.length; i++){
            s+=arr_res_k[i];
          }
          return s.toFixed(2);
        }

        function ButtunPlus(){
          let l = $('.input_txt').val();
          $('.input_txt').val(Number(l) + 500);
        }

        function ButtunMinus(){
          let l = $('.input_txt').val();
          if(Number(l) >= 500){
          $('.input_txt').val(Number(l) -500);
          }

        }
        $('.c-cup__btn').on('click', function(){
			let price = $('.input_txt').val();
			$.ajax({
					url: '/ajaxstavka',
					method: 'post',
					dataType: 'html',
					data: {'_token':'{{csrf_token()}}',arr_res_k:arr_res_k, arr_res_game_id:arr_res_game_id, arr_team:arr_team, price:price },
					success: function(data){
					console.log(data);
					if(data == 0){
						alert('Чтобы сделать ставки необходимо зарегистрироваться или авторизироваться!');
					}
					if(data == 1){
                        window.location.href = '#ppNoBalance';
					}
					if(data == 2){
						alert('Вы успешно сделали ставки!');
						    document.location.href='{{$_SERVER["REQUEST_URI"]}}';
					}
                    else {
                        alert('Вы успешно сделали ставки!');
                        document.location.href='{{$_SERVER["REQUEST_URI"]}}';
                    }
				}
				});
		});
      </script>

@endsection
