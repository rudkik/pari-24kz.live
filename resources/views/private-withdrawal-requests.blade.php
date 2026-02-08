@extends('main')
@section('title', 'Заявки на вывод')
@section('content')
    <div class="private-lobby">
        <div class="_container">
            <h1 class="private-lobby__title">
                Заявки на вывод
            </h1>
            <div class="private-verify__body">
                <form action="{{ url()->current() }}" method="GET" class="search-form" style="margin-bottom: 20px; display: flex; gap: 10px;">
                    <select name="status" class="search-input" style="padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">Все</option>
                        <option value="Ожидание" {{ request('status') == 'Ожидание' ? 'selected' : '' }}>Ожидание</option>
                        <option value="Принято" {{ request('status') == 'Принято' ? 'selected' : '' }}>Принято</option>
                        <option value="Отказ" {{ request('status') == 'Отказ' ? 'selected' : '' }}>Отказ</option>
                    </select>
                    <input type="date" name="date" placeholder="dd.mm.yyyy" value="{{ request('date') }}" class="search-input" style="padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    <input type="text" name="user_account" placeholder="Счет пользователя (например, 2240123)" value="{{ request('user_account') }}" class="search-input" style="padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    <button type="submit" class="search-button" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 4px;">Поиск</button>
                </form>
                <table class="table-ipr table_res">
                    <thead class="table-ipr__top">
                    <tr>
                        <td>Пользователь</td>
                        <td>Реквизиты</td>
                        <td>Сумма</td>
                        <td>Дата создания</td>
                        <td>Статус</td>
                        <td>Действие</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($withdrawalRequests as $withdrawalRequest)
                        <tr>
                            <td style="width: 200px; text-align: start; color: #007bff;">
                                <a href="{{ route('private.user', ['id' => $withdrawalRequest->user_id]) }}" target="_blank" style="text-decoration: underline;">
                                    {{ $withdrawalRequest->user->name }} (Счет №2240{{ str_pad($withdrawalRequest->user_id, 2, '0', STR_PAD_LEFT) }})
                                </a>
                            </td>
                            <td style="width: 500px; text-align: start">
                                <button class="withdrawalRequest-edit-settings" style="padding: 3px; margin-right: 10px; background-color: #ffffff; border-radius: 26px" data-id="{{ $withdrawalRequest->id }}">
                                    <img src="/img/settings.png" alt="Изменить" style="width: 20px; height: 20px;">
                                </button>
                                {{ $withdrawalRequest->payment_gateway }} : {{ $withdrawalRequest->details }}:
                                @if($withdrawalRequest->reason_for_rejection)
                                    <br>
                                    <span style="color: #ccc;">(Причина отказа: {{ $withdrawalRequest->reason_for_rejection }})</span>
                                @endif
                            </td>
                            <td>{{ $withdrawalRequest->sum }} RUB</td>
                            <td>{{ date('d.m.y H:i', strtotime($withdrawalRequest->created_at)) }}</td>
                            <td>
                                @if($withdrawalRequest->status === 'Ожидание')
                                    <span class="status-processing">В обработке</span>
                                @elseif($withdrawalRequest->status === 'Отказ')
                                    <span class="status-rejected">Отказ</span>
                                @else
                                    <span class="status-success">Принято</span>
                                @endif
                            </td>

                            <td class="td_buttons" >
                                @if($withdrawalRequest->status === 'Ожидание')
                                    <button class="withdrawalRequest-success wdr-pay" data-id="{{ $withdrawalRequest->id }}">Принять</button>
                                    <button class="withdrawalRequest-reject wdr-reject" data-popup="#wdrreject" data-id="{{ $withdrawalRequest->id }}">Отказать ( шаблоны )</button>
                                    <button class="withdrawalRequest-text-reject wdr-reject wdr-text-reject" data-popup="#wdrreject" data-id="{{ $withdrawalRequest->id }}">Отказать ( текст )</button>
                                @elseif($withdrawalRequest->status === 'Отказ')
                                    <button class="withdrawalRequest-text-reject wdr-reject wdr-text-reject" data-popup="#wdrreject" data-id="{{ $withdrawalRequest->id }}">Редактировать ( текст ) </button>

                                    <button class="withdrawalRequest-edit wdr-pay" data-popup="#wdrreject" data-id="{{ $withdrawalRequest->id }}">Редактировать ( шаблоны ) </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if ($withdrawalRequests->isEmpty())
                    <div class="error-data">
                        Данных не обнаружено
                    </div>
                @endif
            </div>
        </div>
    </div>

    <section class="popup page__popup" id="wdrreject" aria-hidden="true">
        <div class="popup__wrapper">
            <article class="popup__content popup-form">
                <button class="popup__close" type="button" data-close>
                    <span class="popup__ico-close">
                        <img class="p-img-c" src="/img/settings.png" loading="lazy" width="100" height="100" alt="img">
                    </span>
                </button>
                <h2 class="popup-form__ttl">Причина</h2>
                <form class="form" action="#!" method="POST">
                    <select name="reason" id="reason" class="form__input textarea-large">
                        @foreach($reasons as $reason)
                            <option value="{{ $reason->description }}">{{ $reason->title }}</option>
                        @endforeach
                    </select>
                    <button class="form__submit btn" type="button" aria-label="кнопка">Отправить</button>
                </form>
            </article>
        </div>
    </section>

    <section class="popup page__popup" id="editSettings" aria-hidden="true">
        <div class="popup__wrapper">
            <article class="popup__content popup-form">
                <button class="popup__close" type="button" data-close>
                    <span class="popup__ico-close">
                        <img class="p-img-c" src="/img/settings.png" loading="lazy" width="100" height="100" alt="img">
                    </span>
                </button>
                <h2 class="popup-form__ttl">Изменить данные</h2>
                <form class="form" action="#!" method="POST" id="editSettingsForm">
                    <input type="hidden" name="id" id="editRequestId">
                    <label for="payment_gateway">Способ оплаты</label>
                    <select class="form__input" name="payment_gateway" id="payment_gateway">
                        <option value="Visa/MasterCard">Visa/MasterCard</option>
                        <option value="PayPal">PayPal</option>
                        <option value="Payeer">Payeer</option>
                        <option value="BTC">BTC</option>
                        <option value="USDT">USDT</option>
                        <option value="TON">TON</option>
                        <option value="ETH">ETH</option>

                    </select>
                    <label for="details">Реквизиты</label>
                    <input type="text" class="form__input" name="details" id="details" style="text-transform: none;">
                    <label for="sum">Сумма</label>
                    <input type="number" class="form__input" name="sum" id="sum" style="text-transform: none;">
                    <button class="form__submit btn" type="button" aria-label="кнопка" id="saveSettings">Сохранить</button>
                </form>
            </article>
        </div>
    </section>

    <section class="popup page__popup" id="wdrTextReject" aria-hidden="true">
        <div class="popup__wrapper">
            <article class="popup__content popup-form">
                <button class="popup__close" type="button" data-close>
                    <span class="popup__ico-close">
                        <img class="p-img-c" src="/img/settings.png" loading="lazy" width="100" height="100" alt="img">
                    </span>
                </button>
                <h2 class="popup-form__ttl">Причина отказа вручную</h2>
                <form class="form" action="#!" method="POST" id="editTextRejectForm">
                    <input type="hidden" name="id" id="editTextRejectId">
                    <textarea rows="10" cols="50" name="text_reason" id="text_reason" class="form__input" placeholder="Введите причину отказа"></textarea>
                    <button class="form__submit btn" type="button" aria-label="кнопка" id="saveTextReject">Сохранить</button>
                </form>
            </article>
        </div>
    </section>

    @push('scripts')
        <script>
            let wdrId = "";

            $(".withdrawalRequest-reject").on("click", function() {
                wdrId = $(this).attr("data-id");
            });

            $(".withdrawalRequest-text-reject").on("click", function() {
                wdrId = $(this).attr("data-id");
                $('#editTextRejectId').val(wdrId);
                $('#wdrTextReject').addClass('popup_show');
                $('html').addClass("popup-show lock");
            });

            $(".withdrawalRequest-edit").on("click", function() {
                wdrId = $(this).attr("data-id");
            });

            $("#wdrreject").on("click", ".form__submit", function() {
                const reason = $(this).closest('form').find('[name="reason"]').val();

                $.ajax({
                    url: `/private/withdrawal-requests/${wdrId}/reject`,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        reason,
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            window.location.href = "";
                        }
                    },
                });
            });

            $("#wdrTextReject").on("click", "#saveTextReject", function() {
                const textReason = $("#text_reason").val().trim();

                $.ajax({
                    url: `/private/withdrawal-requests/${wdrId}/reject`,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        reason: textReason,
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            window.location.href = "";
                        }
                    },
                });
            });

            $(".withdrawalRequest-success").on("click", function() {
                wdrId = $(this).attr("data-id");

                $.ajax({
                    url: `/private/withdrawal-requests/${wdrId}/pay`,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            window.location.href = "";
                        }
                    },
                });
            });

            $(".withdrawalRequest-edit-settings").on("click", function() {
                console.log("Test")
                const requestId = $(this).data('id');
                wdrId = requestId;

                const row = $(this).closest('tr');
                const details = row.find('td').eq(1).text().split(':')[1].trim();
                const sum = row.find('td').eq(2).text().replace(' RUB', '');
                const payment_gateway = row.find('td').eq(1).text().split(':')[0].trim();

                $('#editRequestId').val(requestId);
                $('#details').val(details);
                $('#sum').val(sum);
                $('#payment_gateway').val(payment_gateway);

                $('#editSettings').addClass('popup_show');
                $('html').addClass("popup-show lock");
            });

            $("#saveSettings").on("click", function() {
                const details = $("#details").val().trim();
                const sum = $("#sum").val().trim();
                const payment_gateway = $("#payment_gateway").val();

                $.ajax({
                    url: `/private/withdrawal-requests/${wdrId}/update`,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        details,
                        sum,
                        payment_gateway
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            window.location.href = "";
                        }
                    },
                });
            });

            $(".popup__close").on("click", function() {
                $(this).closest('.popup').removeClass('popup_show');
                $('html').removeClass("popup-show lock");
            });
        </script>
    @endpush
@endsection
