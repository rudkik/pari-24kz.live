@extends('main')
@section('title', 'Добавить страницу футера')
@section('content')
    <div class="private-lobby">
        <div class="_container footer-links-container">
            <h1 class="private-lobby__title">Добавить страницу футера</h1>
            <form action="{{ route('private.footer-links.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" name="url" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="content">Содержание</label>
                    <textarea name="content" class="form-control" rows="10" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
