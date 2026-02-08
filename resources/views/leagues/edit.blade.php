@extends('main')
@section('title', 'Редактировать лигу')
@section('content')
    <div class="private-lobby">
        <div class="_container">
            <h1 class="private-lobby__title">Редактировать лигу</h1>
            <form action="{{ route('leagues.update', $league) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Название лиги</label>
                    <input type="text" name="name" class="form-control" value="{{ $league->name }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea name="description" class="form-control">{{ $league->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="icon">Иконка</label>
                    <input style="color: #ffffff" type="file" name="icon" class="form-control">
                    <img src="{{ asset($league->image) }}" alt="icon" style="width: 100px; margin-top: 20px">
                </div>
                <div class="form-group" style="margin-top: 20px">
                    <label for="sport_id">Вид спорта</label>
                    <select name="sport_id" class="form-control">
                        @foreach ($sports as $sport)
                            <option value="{{ $sport->id }}" {{ $league->sport_id == $sport->id ? 'selected' : '' }}>{{ $sport->title }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Обновить</button>
            </form>
        </div>
    </div>
@endsection
