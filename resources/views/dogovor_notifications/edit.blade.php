@extends('main')
@section('title', 'Редактировать уведомление для договорных матчей')
@section('content')
    <div class="private-lobby">
        <div class="_container">
            <h1 class="private-lobby__title">Редактировать уведомление для договорных матчей</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('dogovorNotf.update') }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="message">Сообщение</label>
                    <textarea name="message" id="message" class="form-control" rows="5">{{ $notification ? $notification->message : '' }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
