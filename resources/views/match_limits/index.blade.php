@extends('main')
@section('title', 'Ограничение матчей')
@section('content')
    <div class="private-lobby">
        <div class="_container">
            <h1 class="private-lobby__title">Ограничение матчей</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Ограничение</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($limits as $limit)
                    <tr>
                        <td>{{ $limit->id }}</td>
                        <td>{{ $limit->name }}</td>
                        <td>{{ $limit->limit }}</td>
                        <td>
                            <a href="{{ route('match-limits.edit', $limit->id) }}" class="btn btn-warning">Редактировать</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

