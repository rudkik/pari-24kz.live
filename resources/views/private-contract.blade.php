@extends('main')
@section('title', 'Договорной матч')
@section('content')
    <div class="private-lobby">
        <div class="_container">
            <h1 class="private-lobby__title" style="text-align: center">
                Создание договорного матча
            </h1>
            <div class="private-lobby__inner">
                <form class="private-contract__form" action="{{route('private.contract.create')}}" method="POST" class="private-contract">
                    @csrf
                    <select name="tour_sport" class="select-ignore form__input {{ $errors->has('tour_sport') ? 'error' : '' }}">
                        @foreach($sports as $sport)
                            <option value="{{$sport->id}}">{{$sport->title}}</option>
                        @endforeach
                    </select>
                    <input type="datetime-local" class="form__input {{ $errors->has('tour_game_start') ? 'error' : '' }}" name="tour_game_start" placeholder="Начало игры" value="{{old('tour_game_start')}}">
                    <input type="datetime-local" class="form__input {{ $errors->has('tour_game_end') ? 'error' : '' }}" name="tour_game_end" placeholder="Конец игры" value="{{old('tour_game_end')}}">
                    <input type="text" class="form__input {{ $errors->has('tour_name') ? 'error' : '' }}" name="tour_name" placeholder="Название турнира" value="{{old('tour_name')}}">
                    <input type="text" class="form__input {{ $errors->has('team_name_1') ? 'error' : '' }}" name="team_name_1" placeholder="Название первой команды" value="{{ old('team_name_1') }}">
                    <input type="text" class="form__input {{ $errors->has('team_name_2') ? 'error' : '' }}" name="team_name_2" placeholder="Название второй команды" value="{{ old('team_name_2') }}">

                    <h3>Коэффициенты:</h3>
                    <input type="number" step="0.01" class="form__input {{ $errors->has('p') ? 'error' : '' }}" name="p" placeholder="Ничья " value="{{ old('p') }}" required>
                    <input type="number" step="0.01" class="form__input {{ $errors->has('p_1') ? 'error' : '' }}" name="p_1" placeholder="Победитель Команда 1" value="{{ old('p_1') }}" required>
                    <input type="number" step="0.01" class="form__input {{ $errors->has('p_2') ? 'error' : '' }}" name="p_2" placeholder="Победитель Команда 2" value="{{ old('p_2') }}" required>
                    <input type="number" step="0.01" class="form__input {{ $errors->has('d_1') ? 'error' : '' }}" name="d_1" placeholder="Двойной шанс ( Команда 1 )" value="{{ old('d_1') }}" required>
                    <input type="number" step="0.01" class="form__input {{ $errors->has('d_2') ? 'error' : '' }}" name="d_2" placeholder="Двойной шанс ( Команда 2 )" value="{{ old('d_2') }}" required>
                    <input type="number" step="0.01" class="form__input {{ $errors->has('d_12') ? 'error' : '' }}" name="d_12" placeholder="Двойной шанс ( Ничя ) " value="{{ old('d_12') }}" required>

                    <h3>Исходы:</h3>
                    <div id="outcomes-container">
                        <div class="outcome">
                            <input type="text" class="form__input" name="outcomes[0][name]" placeholder="Исход (например, Ничья)">
                            <input type="number" step="0.001" class="form__input" name="outcomes[0][odds]" placeholder="КФ">
                        </div>
                    </div>
                    <button style="margin-bottom: 40px" type="button" id="add-outcome" class="form__submit btn">Добавить исход</button>
                    <button class="form__submit btn">Отправить</button>
                </form>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        @pushOnce('scripts')
            <script>
                alert('{{session()->get('message')}}');
            </script>
        @endPushOnce
    @endif

    @push('scripts')
        <script>
            document.getElementById('add-outcome').addEventListener('click', function() {
                const container = document.getElementById('outcomes-container');
                const index = container.children.length;
                const div = document.createElement('div');
                div.classList.add('outcome');
                div.innerHTML = `
                <input type="text" class="form__input" name="outcomes[${index}][name]" placeholder="Исход (например, Ничья)">
                <input type="number" step="0.001" class="form__input" name="outcomes[${index}][odds]" placeholder="КФ">
            `;
                container.appendChild(div);
            });
        </script>
    @endpush
@endsection
