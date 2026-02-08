@extends('main')
@section('title', 'Редактировать страницу футера')
@section('content')
    <div class="private-lobby">
        <div class="_container footer-links-container">
            <h1 class="private-lobby__title">Редактировать страницу футера</h1>
            <form action="{{ route('private.footer-links.update', $footerLink->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" name="title" class="form-control" value="{{ $footerLink->title }}" required>
                </div>
                <div class="form-group">
                    <label for="url">URL</label>
                    <input style="color: #000000" type="text" name="url" class="form-control" value="{{ $footerLink->url }}" required>
                </div>
                <div class="form-group">
                    <label for="content">Содержание</label>
                    <textarea name="content" id="editor" class="form-control" rows="10" required>{{ $footerLink->content }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.css" />

    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.2/"
            }
        }
    </script>

    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } from 'ckeditor5';

        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
                toolbar: {
                    items: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ],
                    image: {
                        styles: [
                        ]
                    }
                }
            } );
    </script>
@endsection
