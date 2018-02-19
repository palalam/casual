@extends('layouts.app')

@section('content')
<h2 style="text-align: center;">{{$shop->shop_name}}</h2>
<h3>Мої обнови: </h3>
<a href="{{route('create_obnova')}}">Створити обнову</a><br>
<!--Спочатку перебираємо масив з обновами в яких є продукти, виходить $name = назва обнови, 
$obn_products = продукти обнови -->
<!--Потім перебираємо вже продукти foreach($obn_products as  $product) -->
<div class="container cont-obnova">
	<div class="row row-obnova">
		@foreach($products as $name => $obn_products) 
		<div class="col-md-12 sama-obnova">
		<p>{{ $name}} : </p>
		
			<div class="container-fluid cont-product"> 
			@foreach($obn_products as  $product)
				<div class="row row-product"> 
					<div class="col-md-3 sam-product">
					Продукт: {{$product -> product_title}}
					</div>
					@endforeach
				</div>
			</div>
		
		</div>

@endforeach
	</div>
</div>





@endsection
<style type="text/css">
	
	div.sama-obnova{
		border: 1px solid pink;
		padding: 10px;
	}
	div.cont-product{
		border: 1px solid blue;
		height: 600px;
	}
	div.sam-product
	{
		border: 1px solid red;
		height: 300px;
	}
</style>

