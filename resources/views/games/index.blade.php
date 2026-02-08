@extends('main')
@section('title', 'Список матчей')
@section('content')
    <div class="private-lobby">
        <div class="_container">
            <h1 class="private-lobby__title">Список матчей</h1>
            <a href="{{ route('games.create') }}" class="btn btn-success">Добавить матч</a>
            <div class="private-verify__body">
                @if ($games->count())
                    <table class="table-ipr table_res">
                        <thead class="table-ipr__top">
                        <tr>
                            <td>№</td>
                            <td>Лига</td>
                            <td>Спорт</td>
                            <td>Команда 1</td>
                            <td>Команда 2</td>
                            <td>Период активности</td>
                            <td>Коэффициент 1</td>
                            <td>Коэффициент 2</td>
                            <td>Тип</td>
                            <td>Действия</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($games as $game)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $game->league ? $game->league->name : '-' }}</td>
                                <td>{{ $game->sport ? $game->sport->title : '-' }}</td>
                                <td>{{ $game->team1 }}</td>
                                <td>{{ $game->team2 }}</td>
                                <td>{{ $game->active_period }}</td>
                                <td>{{ $game->coefficient1 }}</td>
                                <td>{{ $game->coefficient2 }}</td>
                                <td>{{ $game->type }}</td>
                                <td>
                                    <a href="{{ route('games.edit', $game) }}" class="btn btn-primary">Редактировать</a>
                                    <form action="{{ route('games.destroy', $game) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="error-data">Данных не обнаружено</div>
                @endif
            </div>
        </div>
    </div>
@endsection
