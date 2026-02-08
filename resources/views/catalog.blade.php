@extends('main')
@section('title', 'Авто из Европы')
@section('content')
<div class="content_main">
		<div class="content_main_catalog">
		<div class="menu_left">
			<h3>Марка автомобиля</h3>
			<ul>
				<li id="v_1"><a href="#" >Volkswagen</a></li>
				<li id="v_1"><a href="#">BMW</a></li>
				<li id="v_1"><a href="#">Audi</a></li>
			</ul>
			<h3>Коробка передач</h3>
			<ul>
				<li id="v_2"><a href="#">Автомат</a></li>
				<li id="v_2"><a href="#">Механика</a></li>
			</ul>
			<h3>Тип топлива</h3>
			<ul>
				<li id="v_3"><a href="#" >Бензин</a></li>
				<li id="v_3"><a href="#">Дизель</a></li>
			</ul>
			<h3>Год выпуска</h3>
			<ul>
				<li id="v_4"><a href="#" >1999</a></li>
				<li id="v_4"><a href="#">2000</a></li>
			</ul>
		</div>
		<div class="catalog_main_item">
			<div class="actual_catalog actual_catalog_catalog">

			<h2 class="h2_catalog">Каталог авто</h2>
			<div class="filter_mobile">
				<p>Фильтр автомобилей</p>
				<img src="assets/img/filter.png" class="img_filter_click" alt="">
			</div>
			<div class="actual_catalog_flex flex_wrap cat_act_m">
			@foreach($catalog as $ca)
				<div class="actual_catalog_item actual_catalog_item25">
					<img src="/storage/{{$ca->img}}">
					<p class="h_item_fl">{{$ca->title}}</p>
					<p class="catalog_description">{{$ca->desc}}</p>
					<p class="price_new">{{$ca->price_new}} ₽</p>
					<p class="price_old">{{$ca->price_old}} ₽</p>
					<button class="btn_order_catalog" onclick="document.location.href = '/catalog/{{$ca->id}}';">Подробнее</button>
				</div>
			@endforeach

			</div>

	</div>
		</div>
	</div>
	</div>
@endsection
