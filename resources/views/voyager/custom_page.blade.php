@extends('voyager::master')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <h1>Заявки</h1>
            <ul>
                @foreach ($data as $item)
                    <li><b>ФИО:</b> {{ $item->fio }} <b>Телефон:</b> {{ $item->phone }} <b>Ref:</b> {{ $item->ref }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection