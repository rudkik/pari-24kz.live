@extends('main')
@section('title', 'Авто из Европы')
@section('content')
  @if (auth()->user()->money + auth()->user()->bonus == 0)
  <h1 style="margin: 20px auto;">На счету недостаточно средств</h1>
  @else
    
  @endif
@endsection