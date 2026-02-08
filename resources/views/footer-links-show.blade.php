@extends('main')
@section('title', $footerLink->title)
@section('content')
    <main class="main policy">
        <div class="_container">
            <h1>{{ $footerLink->title }}</h1>
            {!! $footerLink->content !!}
        </div>
    </main>
@endsection
