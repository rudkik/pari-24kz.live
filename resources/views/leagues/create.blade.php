@extends('main')
@section('title', 'Добавить лигу')
@section('content')
    <div class="private-lobby">
        <div class="_container">
            <h1 class="private-lobby__title">Добавить лигу</h1>
            <form action="{{ route('leagues.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Название лиги</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="icon">Иконка</label>
                    <input type="file" name="icon" class="form-control">
                </div>
                <div class="form-group">
                    <label for="sport_id">Вид спорта</label>
                    <select name="sport_id" class="form-control">
                        @foreach ($sports as $sport)
                            <option value="{{ $sport->id }}">{{ $sport->title }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
