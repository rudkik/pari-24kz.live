@extends('main')

@section('title', $footerLink->title)
@section('content')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.css" />
    <main class="main policy ck-content">
        <div class="_container">
            <h1>{{ $footerLink->title }}</h1>
            <article>
                {!! $footerLink->content !!}
            </article>
        </div>
    </main>
@endsection
