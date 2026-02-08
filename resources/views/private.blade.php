@extends('main')
@section('title', 'Букмекерская компания')
@section('content')
    <main class="priv">
        <div class="_container">
            <h1 class="priv__ttl"><a href="/private">Пользователи</a></h1>
            <div class="priv__c-box">
                <div class="priv__top-c">
                    <form class="priv__section usr-form" id="privForm" action="#!" method="POST">
                        <input type="hidden" class="user_id" value="{{$user->id}}" >
                        <label class="usr-form__lbl lbl-usr"><span class="lbl-usr__ttl">ФИО</span>
                            <input class="usr-form__inp private_name" type="text" placeholder="ФИО" autocomplete="off" value="{{$user->name}}">
                        </label>
                        <label class="usr-form__lbl"> <span class="lbl-usr__ttl">Игровой ник</span>
                            <input class="usr-form__inp private_login" type="text" placeholder="Игровой ник" autocomplete="off" value="{{$user->login}}">
                        </label>
                        <label class="usr-form__lbl"> <span class="lbl-usr__ttl">Страна</span>
                            <div class="select select_form-inp _select-active" data-id="1">
                                <select class="usr-form__inp " data-scroll="" name="currency" data-class-modif="form-inp" hidden="" data-id="1" data-speed="150">
                                    @if($user->country == '')<option class="private_country" value="Не выбрано" selected="">Не выбрано</option>@else<option value="Не выбрано">Не выбрано</option>@endif
                                    @if($user->country == 'Россия')<option class="private_country" value="Россия" selected="">Россия</option>@else<option value="Россия">Россия</option>@endif
                                    @if($user->country == 'Казахстан')<option class="private_country" value="Казахстан" selected="">Казахстан</option>@else<option value="Казахстан">Казахстан</option>@endif
                                    @if($user->country == 'Грузия')<option class="private_country" value="Грузия" selected="">Грузия</option>@else<option value="Грузия">Грузия</option>@endif
                                </select>
                            </div>
                        </label>
                        <label class="usr-form__lbl"> <span class="lbl-usr__ttl">Email</span>
                            <input class="usr-form__inp private_email" type="email" placeholder="Email" autocomplete="off" value="{{$user->email}}">
                        </label>
                        <label class="usr-form__lbl"> <span class="lbl-usr__ttl">Телефон</span>
                            <input class="usr-form__inp private_phone" type="tel" placeholder="Телефон отсутствует" autocomplete="off" value="{{$user->phone}}">
                        </label>
                        <label class="usr-form__lbl"> <span class="lbl-usr__ttl">Пароль</span>
                            <input class="usr-form__inp private_password_1" type="text" placeholder="Сменить пароль" autocomplete="off">
                        </label>
                        <label class="usr-form__lbl"> <span class="lbl-usr__ttl"> </span>
                            <input class="usr-form__inp private_password_2" type="text" placeholder="Подтвердить пароль" autocomplete="off">
                        </label>
                        <article class="balance-priv usr-form__lbl">
                            <h6 class="balance-priv__ttl"> Баланс</h6>
                            <div class="balance-priv__r"><input name="balance" class="balance-priv__val bal usr-form__inp" value="{{$user->money}}">
                                <div class="select select_cur-bln _select-active" data-id="2"><select data-scroll="" name="currency" data-class-modif="cur-bln" hidden="" data-id="2" data-speed="150">
                                        @if($user->cur == '')
                                            <option value="Не выбрана" selected="">Не выбрана</option>
                                            <option value="KZT">KZT</option>
                                            <option value="RUB">RUB</option>
                                        @else
                                            @if($user->cur == 'KZT')
                                                <option value="KZT" selected="">KZT</option>
                                                <option value="RUB">RUB</option>
                                            @else
                                                <option value="KZT" >KZT</option>
                                                <option value="RUB" selected="">RUB</option>
                                            @endif
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </article>
                        <article class="balance-priv usr-form__lbl">
                            <h6 class="balance-priv__ttl"> Бонус</h6>
                            <div class="balance-priv__r"><input name="bonus" class="balance-priv__val bonus usr-form__inp" value="{{$user->bonus}}">
                                <label class="usr-form__lbl"> </label></div><span class="lbl-usr__ttl"></span>
                        </article>
                        <button class="control-priv__btn btn btn--c1 balance_update" type="button" name="submitForm"  aria-label="кнопка" style="margin: 30px 0;">Изменить баланс</button>
                        <label class="usr-form__lbl usr-form__lbl--b"> <span class="lbl-usr__ttl">Пометка администрации:</span>
                            <input class="usr-form__inp private_adminlabel" type="text" placeholder="Пометка" autocomplete="off" value="{{$user->label_admin}}">
                        </label>
                        <label class="usr-form__lbl"> <span class="lbl-usr__ttl">Права</span>
                            <div class="select select_form-inp _select-active" data-id="3"><select class="usr-form__inp" data-scroll="" name="currency" data-class-modif="form-inp" hidden="" data-id="3" data-speed="150">
                                    @foreach(\TCG\Voyager\Models\Role::all() as $role)
                                        @if($role->id==$user->role->id)
                                            <option value="{{$role->id}}" selected="">{{$role->name}}</option>
                                        @else
                                            <option value="{{$role->id}}" >{{$role->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </label>
                        <label class="usr-form__lbl"><span class="lbl-usr__ttl">Партнер / Друг {{$user->ref}}</span><span class="usr-form__box-btn">
                    <button class="btn usr-form__btn" type="button" aria-label="кнопка">Изменить</button></span></label>
                    </form>
                    <section class="info-priv priv__section">
                        <h2 class="info-priv__ttl">Документы</h2>
                        <div class="private-verify__images">
                            @foreach ($verificationRequests as $verify)
                                @foreach ($verify->image_links as $link)
                                    <div class="private-verify__image" style="padding: 15px">
                                        <img  style="padding: 10px; border: 1px solid #ffffff; width: 100px; height: 100px; cursor: pointer;" src="{{ asset($link) }}" alt="Документ">
                                        <button class="open-image-btn" data-link="{{ asset($link) }}">Открыть</button>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const buttons = document.querySelectorAll('.open-image-btn');
                                buttons.forEach(button => {
                                    button.addEventListener('click', function() {
                                        const link = this.getAttribute('data-link');
                                        window.open(link, '_blank');
                                    });
                                });
                            });
                        </script>
                        <ul class="info-priv__list">
                            <li class="info-priv__str str-ip">
                                <h6 class="str-ip__ttl"> Документальное подтверждение</h6>
                                <div class="str-ip__r doc">
                                    @if($user->socument_suc == 0)
                                        <span class="str-ip__ops no _js-active docum" data-state="no"><span></span> Нет</span>
                                        <span class="str-ip__ops yes docum" data-state="yes"><span></span>  Да</span>
                                    @else
                                        <span class="str-ip__ops no docum" data-state="no"><span></span> Нет</span>
                                        <span class="str-ip__ops yes _js-active docum" data-state="yes"><span></span>  Да</span>
                                    @endif
                                </div>
                            </li>
                        </ul>
                        <h2 class="info-priv__ttl">Доступность</h2>
                        <ul class="info-priv__list">
                            <li class="info-priv__str str-ip">
                                <h6 class="str-ip__ttl"> Бан</h6>
                                <div class="str-ip__r ba">
                                    @if($user->ban == 0)
                                        <span class="str-ip__ops no _js-active ban" data-state="no"><span></span> Нет</span>
                                        <span class="str-ip__ops yes ban" data-state="yes"><span></span>  Да</span>
                                    @else
                                        <span class="str-ip__ops no ban"><span></span> Нет</span>
                                        <span class="str-ip__ops yes _js-active ban" data-state="yes"><span></span>  Да</span>
                                    @endif
                                </div>
                            </li>
                            <li class="info-priv__str str-ip">
                                <h6 class="str-ip__ttl"> Запрет пополнения</h6>
                                <div class="str-ip__r nomon">
                                    @if($user->no_money == 0)
                                        <span class="str-ip__ops no _js-active nomo" data-state="no"><span></span> Нет</span>
                                        <span class="str-ip__ops yes nomo" data-state="yes"><span></span>  Да</span>
                                    @else
                                        <span class="str-ip__ops no nomo" data-state="no"><span></span> Нет</span>
                                        <span class="str-ip__ops yes _js-active nomo" data-state="yes"><span></span>  Да</span>
                                    @endif
                                </div>
                            </li>
                            <li class="info-priv__str str-ip">
                                <h6 class="str-ip__ttl"> Запрет вывод</h6>
                                <div class="str-ip__r vivod">
                                    @if($user->no_vivod == 0)
                                        <span class="str-ip__ops no _js-active vivo" data-state="no"><span></span> Нет</span>
                                        <span class="str-ip__ops yes vivo" data-state="yes"><span></span>  Да</span>
                                    @else
                                        <span class="str-ip__ops no vivo" data-state="no"><span></span> Нет</span>
                                        <span class="str-ip__ops yes _js-active vivo" data-state="yes"><span></span>  Да</span>
                                    @endif
                                </div>
                            </li>
                        </ul>
                        <h2 class="info-priv__ttl">Доступность</h2>
                        <ul class="info-priv__list">
                            <li class="info-priv__str str-ip">
                                <h6 class="str-ip__ttl" > Уникальный ID:</h6>
                                <div class="str-ip__r" id="unique_id">{{$user->id}}</div>
                            </li>
                            <li class="info-priv__str str-ip">
                                <h6 class="str-ip__ttl"> Дата регистрации:</h6>
                                <div class="str-ip__r">{{date('d.m.Y H:i', strtotime($user->created_at))}}</div>
                            </li>
                            <li class="info-priv__str str-ip">
                                <h6 class="str-ip__ttl"> Последняя активность:</h6>
                                <div class="str-ip__r">{{date('d.m.Y H:i', strtotime($user->updated_at))}}</div>
                            </li>
                            <li class="info-priv__str str-ip">
                                <h6 class="str-ip__ttl"> Является клиентом:</h6>
                                <div class="str-ip__r">Дней: {{ceil((time() - strtotime($user->created_at))/(60 * 60 * 24))}}</div>
                            </li>
                            <li class="info-priv__str str-ip">
                                <h6 class="str-ip__ttl"> IP адрес (регистрации):</h6>
                                <div class="str-ip__r">{{$user->ip}}</div>
                            </li>
                            <li class="info-priv__str str-ip">
                                <h6 class="str-ip__ttl"> Счет пользователя :</h6>
                                <div class="str-ip__r">( {{ $user->id }} ) №2240{{ str_pad($user->id, 2, '0', STR_PAD_LEFT) }}</div>
                            </li>
                        </ul>
                        <h2 class="info-priv__ttl">Промокоды</h2>
                        <ul class="info-priv__list">
                            @if($user->promo == '')
                                <li class="info-priv__str str-ip">
                                    <h6 class="str-ip__ttl"> Данных не обнаружено</h6>
                                    <div class="str-ip__r"> </div>
                                </li>
                            @else
                                <li class="info-priv__str str-ip">
                                    <h6 class="str-ip__ttl"> {{$user->promo}}</h6>
                                    <div class="str-ip__r"> </div>
                                </li>
                            @endif
                        </ul>
                    </section>
                </div>
                <div class="control-priv">
                    <div class="priv__section">
                        <div class="control-priv__box-c">
                            <button class="control-priv__btn btn btn--c1 user_update" type="submit" name="submitForm" form="#privForm" aria-label="кнопка">Обновить данные</button>
                            <button class="control-priv__btn btn btn--c4 user_sessions" aria-label="кнопка">Сессии</button>
                            <button class="control-priv__btn btn btn--c5 user_deposits" aria-label="кнопка">Финансы</button>
                            <button class="control-priv__btn btn btn--c6 user_withdrawals" aria-label="кнопка">Выводы</button>
                            <button class="control-priv__btn btn btn--c8 user_stavki" aria-label="кнопка">Ставки</button>
                            <form action="{{ route('private.authAsUser', ['id' => $user->id]) }}" target="_blank" style="width: auto;">
                                <button type="submit" class="control-priv__btn btn btn--c9" aria-label="кнопка">Авторизоваться как клиент</button>
                            </form>
                            <button class="control-priv__btn btn btn--c10 delete_user" data-user-id="{{ $user->id }}" aria-label="кнопка">Удалить аккаунт</button>
                        </div>
                    </div>
                </div>
                <div class="wrap-table-ipr">
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
                        <input type="hidden" name="id" id="testw">

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
    </main>

    <script>
        const userId = $("#unique_id").text();

        $('.user_update').on('click', function(){
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

            console.log({
                user_id, name, login, country, email, phone, balance, bonus, cur, password_1, password_2, adminlabel, role, docum, ban, nomo, vivod, transfer
            });

            $.ajax({
                url: "/adminuseredit",
                type:"POST",
                data:{
                    "_token":  "{{ csrf_token() }}",
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
                success:function(response){
                    if(response == 'erp'){
                        showNotification('error', 'Пароли не совпадают!');
                    } else {
                        showNotification('success', 'Данные успешно обновлены!');
                        document.location.href = '/private/' + response;
                    }
                },
            });
        });

        $('.user_sessions').on("click", function() {
            $.ajax({
                url: `/private/${userId}/get-user-sessions`,
                type:"GET",
                data:{
                    _token:  "{{ csrf_token() }}",
                },
                success:function(response){
                    if(response.length){
                        let html = `
                  <table class="table-ipr table_res">
                    <thead class="table-ipr__top">
                      <tr>
                        <td>ID</td>
                        <td>ID Сессии</td>
                        <td>IP Адрес</td>
                        <td>Последняя активность</td>
                      </tr>
                    </thead>
                `;
                        for (let i = 0; i < response.length; i++) {
                            html +=
                                `<tbody>
                    <tr class="table-ipr__line">
                      <td>${i + 1}</td>
                      <td class="session-id">${response[i]['sessionId']}</td>
                      <td>${response[i]['ipAddress'] || 'Не указан'}</td>
                      <td>${response[i]['lastActivity']}</td>
                      <td><button class="remove-session">Удалить сессию</button></td>
                    </tr>
                  </tbody>`;
                        }
                        html += `</table>`;
                        $('.wrap-table-ipr').empty();
                        $('.wrap-table-ipr').append(html);
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

        $('.wrap-table-ipr').on("click", '.remove-session', function() {
            const sessionId = $(this).closest("tr").find('.session-id').text();
            $.ajax({
                url: `/private/${userId}/remove-user-session/${sessionId}`,
                type:"POST",
                data:{
                    _token:  "{{ csrf_token() }}",
                    id: userId,
                    sessionId,
                },
                success:function(response){
                },
            });
            $(this).closest("tr").remove();
        });

        let wdrId = "";
        $(document).on("click", ".withdrawalRequest-edit-settings", function() {
            wdrId = $(this).data('id');
            if (!wdrId) {
                console.error('wdrId is not defined');
                return;
            }

            const row = $(this).closest('tr');
            const details = row.find('td').eq(1).text().split(':')[1].trim();
            const sum = row.find('td').eq(2).text().replace(' RUB', '');
            const payment_gateway = row.find('td').eq(1).text().split(':')[0].trim();

            $('#editRequestId').val(wdrId);
            $('#details').val(details);
            $('#sum').val(sum);
            $('#payment_gateway').val(payment_gateway);

            $('#editSettings').addClass('popup_show');
            $('html').addClass("popup-show lock");
        });

        $(document).on("click", ".user_withdrawals", function() {
            $.ajax({
                url: `/private/${userId}/get-user-withdrawals`,
                type: "GET",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.length) {
                        response.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                        let html = `
                <table class="table-ipr table_res">
                    <thead class="table-ipr__top">
                        <tr>
                            <td>ID</td>
                            <td>Реквизиты</td>
                            <td>Сумма</td>
                            <td>Дата создания</td>
                            <td>Статус</td>
                            <td>Действие</td>
                        </tr>
                    </thead>
                    <tbody>
                `;

                        for (let i = 0; i < response.length; i++) {
                            const createdAt = new Date(response[i]['created_at']);
                            const formattedDate = createdAt.getDate().toString().padStart(2, '0') + '.' +
                                (createdAt.getMonth() + 1).toString().padStart(2, '0') + '.' +
                                createdAt.getFullYear().toString().slice(2) + ' ' +
                                createdAt.getHours().toString().padStart(2, '0') + ':' +
                                createdAt.getMinutes().toString().padStart(2, '0');
                            html += `
                    <tr class="table-ipr__line">
                        <td class="wdr-id">${response[i]['id']}</td>
                        <td style="width: 500px; text-align: start">
                            <button class="withdrawalRequest-edit-settings" style="padding: 3px; margin-right: 10px; background-color: #ffffff; border-radius: 26px" data-id="${response[i]['id']}">
                                <img src="/img/settings.png" alt="Изменить" style="width: 20px; height: 20px;">
                            </button>
                            ${response[i]['payment_gateway']}:
                            ${response[i]['details']}:
                            <br>
                            <span style="color: #ccc;">(Причина отказа:${response[i]['reason_for_rejection'] || "Отказа нет"})</span>
                        </td>
                        <td>${response[i]['sum']}</td>
                        <td>${formattedDate}</td>
                        <td>${response[i]['status']}</td>
                `;
                            if(response[i]['status'] === "Ожидание") {
                                html +=`
                        <td class="td_buttons">
<button class="withdrawalRequest-reject wdr-reject" data-popup="#wdrreject" data-id="${response[i]['id']}">Отказ ( шаблоны) </button>
                                    <button class="withdrawalRequest-text-reject wdr-reject wdr-text-reject" data-popup="#wdrreject" data-id="${response[i]['id']}">Отказать текст</button>
</td>
                        <td><button class="wdr-pay" data-id="${response[i]['id']}">Оплатить</button></td>`;
                            } else if(response[i]['status'] === "Отказ") {
                                html +=`
                        <td class="td_buttons">
                                    <button class="withdrawalRequest-text-reject wdr-reject wdr-text-reject" data-popup="#wdrreject" data-id="${response[i]['id']}">Редактировать ( текст ) </button>
                                    <button class="withdrawalRequest-edit wdr-reject " data-popup="#wdrreject" data-id="${response[i]['id']}">Редактировать ( шаблоны ) </button>
                        </td>`;
                            }
                            html += `</tr>`;
                        }

                        html += `</tbody></table>`;

                        $('.wrap-table-ipr').empty();
                        $('.wrap-table-ipr').append(html);
                    } else {
                        const error = `<div class="error-data">Данных не обнаружено</div>`;
                        $('.wrap-table-ipr').empty();
                        $('.wrap-table-ipr').append(error);
                    }
                },
            });
        });

        $(document).on("click", ".wdr-reject", function() {
            wdrId = $(this).data("id");
            if (!wdrId) {
                console.error('wdrId is not defined');
                return;
            }

            $('#wdrreject').data('wdrId', wdrId);
            $('#wdrreject').addClass('popup_show');
            $('html').addClass("popup-show lock");
        });

        $(document).on("click", ".wdr-pay", function() {
            wdrId = $(this).data("id");
            if (!wdrId) {
                console.error('wdrId is not defined');
                return;
            }

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

        $(document).on("click", "#wdrreject .form__submit", function() {
            const reason = $(this).closest('form').find('[name="reason"]').val();
            const wdrId = $('#wdrreject').data('wdrId');

            if (!wdrId) {
                console.error('wdrId is not defined');
                return;
            }

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

        $(document).on("click", ".withdrawalRequest-text-reject", function() {
            wdrId = $(this).data('id');
            if (!wdrId) {
                console.error('wdrId is not defined');
                return;
            }

            $('#editTextRejectId').val(wdrId);
            $('#wdrTextReject').addClass('popup_show');
            $('html').addClass("popup-show lock");
        });

        $(document).on("click", "#wdrTextReject #saveTextReject", function() {
            if (!wdrId) {
                console.error('wdrId is not defined');
                return;
            }

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

        $("#saveSettings").on("click", function() {
            if (!wdrId) {
                console.error('wdrId is not defined');
                return;
            }

            const details = $("#details").val().trim();
            const sum = $("#sum").val().trim();
            const payment_gateway = $("#payment_gateway").val() || "Visa/Mastercard";

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



        $(".user_deposits").on("click", function() {
            $.ajax({
                url: `/deposit-history/show/${userId}`,
                type: "GET",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.length) {
                        let html = `
                <table class="table-ipr table_res">
                    <thead class="table-ipr__top">
                        <tr>
                            <td>№</td>
                            <td>Дата</td>
                            <td>Сумма</td>
                            <td>Способ</td>
                            <td>Действия</td>
                        </tr>
                    </thead>
                `;
                        for (let i = 0; i < response.length; i++) {
                            const isoDateString = response[i]['created_at'];
                            const date = new Date(isoDateString);

                            date.setHours(date.getHours() + 2);

                            const formattedDate = date.getFullYear() + "-" +
                                String(date.getMonth() + 1).padStart(2, '0') + "-" +
                                String(date.getDate()).padStart(2, '0') + " " +
                                String(date.getHours()).padStart(2, '0') + ":" +
                                String(date.getMinutes()).padStart(2, '0') + ":" +
                                String(date.getSeconds()).padStart(2, '0');

                            html +=
                                `<tbody>
                        <tr class="table-ipr__line" data-deposit-id="${response[i]['id']}">
                            <td>${i + 1}</td>
                            <td>
                                <input type="datetime-local" value="${isoDateString.substring(0, 19).replace(' ', 'T')}"
                                    class="date-input" data-id="${response[i]['id']}">
                            </td>
                            <td>${response[i]['sum']}</td>
                            <td>${response[i]['payment_gateway']}</td>
                            <td>
                                <button class="save-date-btn" data-id="${response[i]['id']}">Сохранить</button>
                                <button class="delete-deposit-btn" data-id="${response[i]['id']}" style="margin-left: 10px; background-color: #dc3545; color: #fff; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">Удалить</button>
                            </td>
                        </tr>
                    </tbody>`;
                        }
                        html += `</table>`;
                        $('.wrap-table-ipr').empty();
                        $('.wrap-table-ipr').append(html);
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

        $(document).on('click', '.save-date-btn', function() {
            const id = $(this).data('id');
            const newDate = $(this).closest('tr').find('.date-input').val();

            console.log('Отправляемая дата:', newDate);

            $.ajax({
                url: `/deposit-history/update/${id}`,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    created_at: newDate
                },
                success: function(response) {
                    alert('Дата успешно обновлена');
                },
                error: function(xhr) {
                    alert('Ошибка при обновлении даты');
                    console.error(xhr.responseText);
                }
            });
        });

        $(document).on('click', '.delete-deposit-btn', function() {
            const id = $(this).data('id');
            const row = $(this).closest('tr');

            if (!confirm('Вы уверены, что хотите удалить это пополнение?')) {
                return;
            }

            $.ajax({
                url: `/deposit-history/delete/${id}`,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "DELETE"
                },
                success: function(response) {
                    if (response.success) {
                        row.fadeOut(300, function() {
                            $(this).remove();
                            if ($('.wrap-table-ipr table tbody tr').length === 0) {
                                $('.wrap-table-ipr').html('<div class="error-data">Данных не обнаружено</div>');
                            }
                        });
                        alert('Пополнение успешно удалено');
                    }
                },
                error: function(xhr) {
                    alert('Ошибка при удалении пополнения');
                    console.error(xhr.responseText);
                }
            });
        });

        $('.wrap-table-ipr').on("click", '.vivod-pay', function() {
            const wdrId = $(this).attr('data-id');
            const btn = $(this);
            $.ajax({
                url: `/ajaxstavka/success`,
                type:"POST",
                data:{
                    _token:  "{{ csrf_token() }}",
                    id: wdrId,
                },
                success:function(response){
                    if(response) {
                        btn.closest('tr').find('.status').text("Оплачено");
                        btn.closest('tr').find('.wdr-pay').closest('td').remove();
                    }
                },
            });
        });
    </script>
@endsection
