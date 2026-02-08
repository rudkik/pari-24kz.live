@extends('main')
@section('title', 'Авто из Европы')
@section('content')
<br /><br /><br /><br /><br /><br />
	<div style="padding: 20px">
		<h2>{{$one_catalog->title}}</h2>
		<p style="float: left;margin: 10px"><img src="/storage/{{$one_catalog->img}}"></p>
		<p><b>Описание: </b>{{$one_catalog->desc}}</p>
		<p><b>Полный текст: </b>{{$one_catalog->text_full}}</p>
		<p><b>Марка: </b>{{$one_catalog->marka}}</p>
		<p><b>Коробка передач: </b>{{$one_catalog->korobka}}</p>
		<p><b>Тип топлива:</b>{{$one_catalog->type_toplivo	}}</p>
		<p><b>Год: </b>{{$one_catalog->year}}</p>
	</div>
	
@endsection