@extends('main')
@section('title', 'Ссылки футера')
@section('content')
    <div class="private-lobby">
        <div class="_container footer-links-container">
            <h1 class="private-lobby__title">Ссылки футера</h1>
            <a href="{{ route('private.footer-links.create') }}" class="btn btn-primary">Добавить ссылку</a>
            <table class="table-ipr table_res">
                <thead class="table-ipr__top">
                <tr>
                    <td>Заголовок</td>
                    <td>URL</td>
                    <td>Действия</td>
                </tr>
                </thead>
                <tbody>
                @foreach($footerLinks as $link)
                    <tr>
                        <td>{{ $link->title }}</td>
                        <td>{{ $link->url }}</td>
                        <td>
                            <a style="width: auto" href="{{ route('private.footer-links.edit', $link->id) }}" class="btn btn-warning">Редактировать</a>
                            <form action="{{ route('private.footer-links.destroy', $link->id) }}" method="POST" style="display:inline-block;">
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
    </div>
@endsection
