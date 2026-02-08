@extends('main')
@section('title', 'Редактировать матч')
@section('content')
    <div class="private-lobby">
        <div class="_container">
            <h1 class="private-lobby__title">Редактировать матч</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('games.update', $game->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Название события</label>
                    <input type="text" name="title" class="form-control" value="{{ $game->title }}" required>
                </div>
                <div class="form-group">
                    <label for="league_id">Лига</label>
                    <select name="league_id" class="form-control" required>
                        <option value="">Выберите лигу</option>
                        @foreach($leagues as $league)
                            <option value="{{ $league->id }}" {{ $league->id == $game->league_id ? 'selected' : '' }}>{{ $league->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="team1">Команда 1</label>
                    <input type="text" name="team1" class="form-control" value="{{ $game->team1 }}" required>
                </div>
                <div class="form-group">
                    <label for="team2">Команда 2</label>
                    <input type="text" name="team2" class="form-control" value="{{ $game->team2 }}" required>
                </div>
                <div class="form-group">
                    <label for="active_period">Период активности (дни)</label>
                    <input type="text" name="active_period" class="form-control" value="{{ $game->active_period }}" required placeholder="например, 0-15">
                </div>
                <div class="form-group">
                    <label for="coefficient1_min">Минимальный коэффициент 1</label>
                    <input type="number" step="0.01" name="coefficient1_min" class="form-control" value="{{ $game->coefficient1_min }}" required>
                </div>
                <div class="form-group">
                    <label for="coefficient1_max">Максимальный коэффициент 1</label>
                    <input type="number" step="0.01" name="coefficient1_max" class="form-control" value="{{ $game->coefficient1_max }}" required>
                </div>
                <div class="form-group">
                    <label for="coefficient2_min">Минимальный коэффициент 2</label>
                    <input type="number" step="0.01" name="coefficient2_min" class="form-control" value="{{ $game->coefficient2_min }}" required>
                </div>
                <div class="form-group">
                    <label for="coefficient2_max">Максимальный коэффициент 2</label>
                    <input type="number" step="0.01" name="coefficient2_max" class="form-control" value="{{ $game->coefficient2_max }}" required>
                </div>
                <div class="form-group">
                    <label for="type">Тип</label>
                    <select name="type" class="form-control" required>
                        <option value="live" {{ $game->type == 'live' ? 'selected' : '' }}>Лайв</option>
                        <option value="line" {{ $game->type == 'line' ? 'selected' : '' }}>Линия</option>
                        <option value="top_league" {{ $game->type == 'top_league' ? 'selected' : '' }}>Топ лига</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

    <div id="overlay-admin" class="overlay-admin">
        <div id="notification-admin" class="notification-admin">
            <p id="notification-text-admin">Сохранение данных...</p>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function showNotification(message, callback) {
                const overlay = document.getElementById('overlay-admin');
                const notification = document.getElementById('notification-admin');
                const notificationText = document.getElementById('notification-text-admin');

                notificationText.textContent = message;

                overlay.style.display = 'flex';
                notification.classList.add('fade-in-admin');

                setTimeout(() => {
                    notification.classList.remove('fade-in-admin');
                    notification.classList.add('fade-out-admin');

                    notification.addEventListener('animationend', () => {
                        overlay.style.display = 'none';
                        notification.classList.remove('fade-out-admin');
                        if (callback) callback();
                    }, { once: true });
                }, 1500);
            }

            document.querySelector('.btn-success').addEventListener('click', function(event) {
                event.preventDefault();
                showNotification('Данные успешно сохранены!', () => {
                    event.target.closest('form').submit();
                });
            });
        });
    </script>
@endsection
