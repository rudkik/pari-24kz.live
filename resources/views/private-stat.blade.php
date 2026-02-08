@extends('main')
@section('title', 'Статистика')
@section('content')
  <div class="private-stat">
    <div class="_container">
      <h1 class="private-lobby__title">
        Статистика (за текуший день)
      </h1>
      <div class="private-lobby__inner">
        <div class="private-stat__col">
          <div class="private-stat__term">
            Зарегистрировалось:&nbsp;
          </div>
          <div class="private-stat__value">
            {{$usersCount}}
          </div>
        </div>
        <div class="private-stat__col">
          <div class="private-stat__term">
            Количество посетителей:&nbsp;
          </div>
          <div class="private-stat__value">
            {{$visitsCount}}
          </div>
        </div>
        <div class="private-stat__col">
          <div class="private-stat__term">
            Общая сумма пополнений:&nbsp;
          </div>
          <div class="private-stat__value">
            {{$sumAllDeposits}}
          </div>
        </div>
        <div class="private-stat__col">
          <div class="private-stat__term">
            Общее количество пополнений:&nbsp;
          </div>
          <div class="private-stat__value">
            {{$countAllDeposits}}
          </div>
        </div>
        <div class="private-stat__col">
          <div class="private-stat__term">
            Общая сумма ручных пополнений:&nbsp;
          </div>
          <div class="private-stat__value">
            {{$sumManuallyDeposits}}
          </div>
        </div>
        <div class="private-stat__col">
          <div class="private-stat__term">
            Общее количество ручных пополнений:&nbsp;
          </div>
          <div class="private-stat__value">
            {{$countManuallyDeposits}}
          </div>
        </div>
        <div class="private-stat__col">
          <div class="private-stat__term">
            Общая сумма обычных пополнений:&nbsp;
          </div>
          <div class="private-stat__value">
            {{$sumStandardDeposits}}
          </div>
        </div>
        <div class="private-stat__col">
          <div class="private-stat__term">
            Общее количество обычных пополнений:&nbsp;
          </div>
          <div class="private-stat__value">
            {{$countStandardDeposits}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
