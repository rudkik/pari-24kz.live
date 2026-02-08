@extends('main')
@section('title', 'Казино')
@section('content')
    <div class="cas">
        <div class="_container">
            <div class="cas_inner">
                <div class="cas-block">
                    <div class="block-line"></div>
                    <div class="cas_header">
                        <h2 class="games-n__ttl">Новые</h2>
                    </div>
                    <div class="cas-list">
                        @php
                            $newGames = [
                              'Ancient Egypt',
                              'Book of Ra',
                              'Starburst',
                              'Mega Moolah',
                              'Gonzo’s Quest',
                              'Thunderstruck II',
                              'Immortal Romance',
                              'Dead or Alive',
                              'Avalon II',
                              'Hotline',
                              'Jungle Spirit',
                              'Twin Spin'
                            ];
                        @endphp

                        @foreach ($newGames as $game)
                            <div class="cas-col" style="background-image: url('/img/casino/{{ str_replace(' ', '', $game) }}.png');">
                                @if (auth()->check() && auth()->user()->money != 0)
                                    <a class="cas-col-content" data-popup="#ppNotification" >
                                        <span class="play_demo">Демо</span>
                                        <span class="play_money">Играть</span>
                                        <span class="play_game_name">{{ $game }}</span>
                                    </a>
                                @elseif(auth()->check())
                                    <a class="cas-col-content" data-popup="#ppBalance" >
                                        <span class="play_demo">Демо</span>
                                        <span class="play_money">Играть</span>
                                        <span class="play_game_name">{{ $game }}</span>
                                    </a>
                                @else
                                    <a data-popup="#pplogin" class="cas-col-content" >
                                        <span class="play_demo">Демо</span>
                                        <span class="play_money">Играть</span>
                                        <span class="play_game_name">{{ $game }}</span>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="cas-block">
                    <div class="block-line"></div>
                    <div class="cas_header">
                        <h2 class="games-n__ttl">Лайв диллеры</h2>
                    </div>
                    <div class="cas-list">
                        @php
                            $liveGames = [
                              'Live Roulette',
                              'Live Blackjack',
                              'Live Baccarat',
                              'Live Poker',
                              'Live Dream Catcher',
                              'Live Monopoly',
                              'Live Crazy Time',
                              'Live Deal or No Deal',
                              'Live Lightning Roulette',
                              'Live Mega Ball',
                              'Live Dragon Tiger',
                              'Live Sic Bo'
                            ];
                        @endphp

                        @foreach ($liveGames as $game)
                            <div class="cas-col" style="background-image: url('/img/casino/{{ str_replace(' ', '', $game) }}.png');">
                                @if (auth()->check() && auth()->user()->money != 0)
                                    <a class="cas-col-content" data-popup="#ppNotification" >
                                        <span class="play_demo">Демо</span>
                                        <span class="play_money">Играть</span>
                                        <span class="play_game_name">{{ $game }}</span>
                                    </a>
                                @elseif(auth()->check())
                                    <a class="cas-col-content" data-popup="#ppBalance" >
                                        <span class="play_demo">Демо</span>
                                        <span class="play_money">Играть</span>
                                        <span class="play_game_name">{{ $game }}</span>
                                    </a>
                                @else
                                    <a data-popup="#pplogin" class="cas-col-content" >
                                        <span class="play_demo">Демо</span>
                                        <span class="play_money">Играть</span>
                                        <span class="play_game_name">{{ $game }}</span>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
