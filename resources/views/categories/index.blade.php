@extends('main')
@section('title', 'Категории')
@section('content')
    <div class="footer-links-container">
        <h1 class="private-lobby__title">Категории</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Добавить категорию</a>
        <table class="table-ipr table_res">
            <thead class="table-ipr__top">
            <tr>
                <td>Название</td>
                <td>Действия</td>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Редактировать</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
