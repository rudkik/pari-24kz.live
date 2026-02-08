@extends('main')
@section('title', 'Edit Sport')
@section('content')
    <div class="private-lobby">
        <div class="_container">
            <h1 class="private-lobby__title">Редактировать вид спорта</h1>
            <form action="{{ route('sports.update', $sport) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Название</label>
                    <input style="padding: 5px" type="text" name="title" class="form-control" value="{{ $sport->title }}" required>
                </div>
                <div class="form-group" style="display: flex; flex-direction: column; gap: 2rem">
                    <label for="img">Иконка</label>
                    <input style="color: #ffffff" type="file" name="img" class="form-control">
                    @if($sport->img)
                        <img src="{{  $sport->img }}" alt="icon" style="width: 40px; height: 40px">
                    @endif
                </div>
                <button style="margin-top: 20px" type="submit" class="btn btn-success">Обновить</button>
            </form>
        </div>
    </div>
@endsection
