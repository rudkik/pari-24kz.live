@extends('main')
@section('title', 'Редактировать ограничение')
@section('content')
    <div class="private-lobby">
        <div class="_container">
            <h1 class="private-lobby__title">Редактировать ограничение</h1>
            <form action="{{ route('match-limits.update', $limit->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" name="name" class="form-control" value="{{ $limit->name }}" required readonly>
                </div>
                <div class="form-group">
                    <label for="limit">Ограничение</label>
                    <input type="number" name="limit" class="form-control" value="{{ $limit->limit }}" required>
                </div>
                <button type="submit" class="btn btn-success">Обновить</button>
            </form>
        </div>
    </div>
@endsection
