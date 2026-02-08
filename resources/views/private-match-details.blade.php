@extends('main')
@section('title', 'Детали матча')
@section('content')
    <div class="match-details-container">
        <div class="container">
            <h1 class="private-lobby__title">
                Детали матча
            </h1>
            <div class="private-lobby__inner">
                <form action="{{ route('private.match.update', ['id' => $match->id]) }}" method="POST" class="match-details-form">
                    @csrf
                    @method('PUT')

                    <label for="name" class="form-label">Название матча</label>
                    <input type="text" name="name" id="name" value="{{ $match->name }}" placeholder="Название матча" required class="form-input">

                    <label for="name_1" class="form-label">Название команды 1</label>
                    <input type="text" name="name_1" id="name_1" value="{{ $match->name_1 }}" placeholder="Название команды 1" required class="form-input">

                    <label for="name_2" class="form-label">Название команды 2</label>
                    <input type="text" name="name_2" id="name_2" value="{{ $match->name_2 }}" placeholder="Название команды 2" required class="form-input">

                    <label for="game_start" class="form-label">Начало игры</label>
                    <input type="datetime-local" name="game_start" id="game_start" value="{{ $match->game_start }}" placeholder="Начало игры" required class="form-input">

                    <label for="game_end" class="form-label">Конец игры</label>
                    <input type="datetime-local" name="game_end" id="game_end" value="{{ $match->game_end }}" placeholder="Конец игры" required class="form-input">

                    <label for="p" class="form-label">Победитель команда 1 </label>
                    <input type="number" step="0.01" name="p" id="p" value="{{ $match->p }}" placeholder="Коэффициент P" required class="form-input">

                    <label for="p_1" class="form-label">Победитель команда 2 </label>
                    <input type="number" step="0.01" name="p_1" id="p_1" value="{{ $match->p_1 }}" placeholder="Коэффициент P1" required class="form-input">

                    <label for="p_2" class="form-label">Коэффициент Ничя</label>
                    <input type="number" step="0.01" name="p_2" id="p_2" value="{{ $match->p_2 }}" placeholder="Коэффициент P2" required class="form-input">

                    <label for="d_1" class="form-label">Двойной шанс ( команда 1 ) </label>
                    <input type="number" step="0.01" name="d_1" id="d_1" value="{{ $match->d_1 }}" placeholder="Коэффициент D1" required class="form-input">

                    <label for="d_2" class="form-label">Двойной шанс ( команда 2 ) </label>
                    <input type="number" step="0.01" name="d_2" id="d_2" value="{{ $match->d_2 }}" placeholder="Коэффициент D2" required class="form-input">

                    <label for="d_12" class="form-label">Двойной шанс ( Ничя )</label>
                    <input type="number" step="0.01" name="d_12" id="d_12" value="{{ $match->d_12 }}" placeholder="Коэффициент D12" required class="form-input">

                    <h3 class="form-subtitle">Исходы</h3>
                    @foreach($match->outcomes as $outcome)
                        <input type="hidden" name="outcomes[{{ $loop->index }}][id]" value="{{ $outcome->id }}">

                        <label for="outcome_name_{{ $loop->index }}" class="form-label">Название исхода</label>
                        <input type="text" name="outcomes[{{ $loop->index }}][name]" id="outcome_name_{{ $loop->index }}" value="{{ $outcome->name }}" placeholder="Название исхода" required class="form-input">

                        <label for="outcome_odds_{{ $loop->index }}" class="form-label">Коэффициент</label>
                        <input type="number" step="0.001" name="outcomes[{{ $loop->index }}][odds]" id="outcome_odds_{{ $loop->index }}" value="{{ $outcome->odds }}" placeholder="Коэффициент" required class="form-input">
                    @endforeach
                    <button type="submit" class="form-submit btn">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
