@extends('main')
@section('title', 'Редактировать категорию')
@section('content')
    <div class="footer-links-container">
        <h1 class="private-lobby__title">Редактировать категорию</h1>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
@endsection
