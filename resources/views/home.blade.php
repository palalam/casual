@extends('layouts.app')

@section('content')



<h3>Усі продукти: </h3>

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
                    
                    <div class="container-fluid">
                        <div class="row ">
                            <div class="col-md-12  image">
                            <a href="/product/{{$product -> product_id}}">
                                <img style="height: 100%; width: 100%;" src="/storage/images/{{unserialize($product -> product_photos)[0]}}">
                                </a>
                            </div>
                            
                        </div>
                        
                        Продукт: {{$product -> product_title}}<br>
                        Опис: {{$product -> product_desc}}
                    </div>
                    
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
        border: 1px solid #1fff15;
        /*height: 600px;*/
    }
    div.sam-product
    {
        /*margin-left: 5px;*/
        border: 1px solid red;
        height: 450px;

    }
    div.sam-product:hover
    {
        cursor: pointer;
    }
    div.image
    {
        padding: 0;
        margin: 0;
        /*width: 250px;*/
        margin-top: 10px;
        height: 320px;
        /*border: 1px solid blue;*/
    }
</style>

