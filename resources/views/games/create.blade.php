@extends('main')
@section('title', 'Добавить матч')
@section('content')
    <div class="private-lobby">
        <div class="_container">
            <h1 class="private-lobby__title">Добавить матч</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('games.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="sport_id">Спорт</label>
                    <select name="sport_id" class="form-control">
                        <option value="">Выберите спорт</option>
                        @foreach($sports as $sport)
                            <option value="{{ $sport->id }}">{{ $sport->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="league_id">Лига</label>
                    <select name="league_id" class="form-control">
                        <option value="">Выберите лигу (необязательно)</option>
                        @foreach($leagues as $league)
                            <option value="{{ $league->id }}">{{ $league->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="team1">Команда 1</label>
                    <input type="text" name="team1" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="team2">Команда 2</label>
                    <input type="text" name="team2" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="active_period">Период активности (дни)</label>
                    <input type="text" name="active_period" class="form-control" required placeholder="например, 0-15">
                </div>
                <div class="form-group">
                    <label for="coefficient1_min">Минимальный коэффициент 1</label>
                    <input type="number" step="0.01" name="coefficient1_min" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="coefficient1_max">Максимальный коэффициент 1</label>
                    <input type="number" step="0.01" name="coefficient1_max" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="coefficient2_min">Минимальный коэффициент 2</label>
                    <input type="number" step="0.01" name="coefficient2_min" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="coefficient2_max">Максимальный коэффициент 2</label>
                    <input type="number" step="0.01" name="coefficient2_max" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="type">Тип</label>
                    <select name="type" class="form-control" required>
                        <option value="live">Лайв</option>
                        <option value="line">Линия</option>
                        <option value="top_league">Топ лига</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
