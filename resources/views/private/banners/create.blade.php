@extends('main')
@section('title', 'Добавить баннер')
@section('content')
    <div class="private-lobby">
        <div class="_container">
            <h1 class="private-lobby__title">Добавить новый баннер</h1>

            <form action="{{ route('private.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="image">Изображение</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Создать баннер</button>
            </form>
        </div>
    </div>
@endsection
