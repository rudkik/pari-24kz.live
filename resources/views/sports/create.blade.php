@extends('main')
@section('title', 'Add Sport')
@section('content')
    <div class="private-lobby">
        <div class="_container">
            <h1 class="private-lobby__title">Добавить вид спорта</h1>
            <form action="{{ route('sports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Название</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="img">Иконка</label>
                    <input type="file" name="img" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
