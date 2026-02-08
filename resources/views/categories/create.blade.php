@extends('main')
@section('title', 'Добавить категорию')
@section('content')
    <div class="footer-links-container">
        <h1 class="private-lobby__title">Добавить категорию</h1>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
@endsection
