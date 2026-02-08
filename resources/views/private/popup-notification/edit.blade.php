@extends('main')
@section('title', 'Редактировать уведомление')
@section('content')
    <div class="private-lobby">
        <div class="_container notification-container">
            <h1 class="private-lobby__title">Редактировать уведомление</h1>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('private.popup-notification.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" name="title" class="form-control" value="{{ $notification->title ?? '' }}" required>
                </div>
                <div class="form-group"  >
                    <label for="content">Содержание</label>
                    <textarea name="content" class="form-control" rows="10" required>{{ $notification->content ?? '' }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
