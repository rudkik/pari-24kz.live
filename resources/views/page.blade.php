@extends('main')
@section('title', 'Авто из Европы')
@section('content')
<br /><br /><br /><br /><br /><br />
	<div style="padding: 20px">
		<h2 align="center">{{$p->title}}</h2>
			{!!$p->txt!!}
	</div>
	
@endsection