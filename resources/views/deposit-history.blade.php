@extends('main')
@section('title', 'Финансовая история')
@section('content')
    <div class="dephis">
        <div class="_container">
            <h2 class="dephis__title">
                Финансовая история
            </h2>

            <div class="dephis__body">
                <h3 class="dephis__body-title">
                    История пополнений
                </h3>
                <div class="dephis__content">
                    @if ($deposits->isNotEmpty())
                        @foreach ($deposits as $deposit)
                            <div class="dephis__col-pay">
                                <div class="dephis__col-inner">
                                    <div class="dephis__col-price">
                                        {{$deposit->sum}} {{$deposit->currency}} @if (Auth::check())

                                            @if (auth()->user()->cur == 'RUB')
                                                ₽
                                            @else
                                                 ₸
                                            @endif

                                        @endif
                                    </div>
                                    <div class="dephis__col-time">
                                        {{\Carbon\Carbon::parse($deposit->created_at)->format('H:i d.m.Y')}}
                                    </div>
                                </div>
                                <div class="dephis__col-inner">
                                    <div class="dephis__col-repl__success">
                                        Оплачено
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="error-data">
                            Данных не обнаружено
                        </div>
                    @endif
                </div>
                <h3 class="dephis__body-title">
                    История выводов
                </h3>
                <div class="dephis__content">
                    @if ($withdrawalRequests->isNotEmpty())
                        @foreach ($withdrawalRequests as $withdrawalRequest)
                            <div class="dephis__col">
                                <div class="dephis__col-info">
                                    <div class="dephis__col-inner">
                                        <div class="dephis__col-price">
                                            {{$withdrawalRequest->sum}} {{$withdrawalRequest->currency}} @if (Auth::check())

                                                @if (auth()->user()->cur == 'RUB')
                                                    ₽
                                                @else
                                                    ₸
                                                @endif

                                            @endif
                                        </div>
                                        <div class="dephis__col-time">
                                            {{\Carbon\Carbon::parse($withdrawalRequest->created_at)->format('H:i d.m.Y')}}
                                        </div>
                                    </div>
                                    <div @class([
                    'dephis__col-inner',
                    'reject' => $withdrawalRequest->status === 'Отказ',
                    'waiting' => $withdrawalRequest->status === 'Ожидание',
                  ])>
                                        <div class="dephis__col-repl__success">
                                            {{$withdrawalRequest->status}}
                                        </div>
                                    </div>
                                </div>
                                <div class="dephis__col-details">
                                    {{$withdrawalRequest->payment_gateway}}: {{substr_replace($withdrawalRequest->details, '*****', 0, 5)}}
                                </div>
                                @if($withdrawalRequest->reason_for_rejection)
                                    <div class="dephis__col-reason">
                                        <div class="dephis__col-inner dephis-reject">
                                            <div>
                                                {{$withdrawalRequest->reason_for_rejection}}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="error-data">
                            Данных не обнаружено
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
