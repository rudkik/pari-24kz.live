@extends('main')
@section('title', 'Управление баннерами')
@section('content')
    <div class="private-lobby">
        <div class="_container banners-container">
            <h1 class="private-lobby__title">Управление баннерами</h1>
            <a href="{{ route('private.banners.create') }}" class="btn btn-primary mb-4">Добавить новый баннер</a>

            @if($banners->isEmpty())
                <p>Баннеров пока нет.</p>
            @else
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Изображение</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($banners as $banner)
                        <tr>
                            <td>
                                <img src="/{{ $banner->image }}" width="150" alt="Баннер">
                            </td>
                            <td>
                                <form action="{{ route('private.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" style="display: inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" name="image" class="form-control mb-2">
                                    <button type="submit" class="btn btn-warning btn-sm">Обновить фото</button>
                                </form>
                                <form action="{{ route('private.banners.destroy', $banner->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить этот баннер?')">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
