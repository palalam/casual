@extends('layouts.app')

@section('content')
    <h3>Результати пошуку: </h3>








                    <div class="container cont-product">
                            <div class="row row-product">
                                @foreach($products as $product)
                                <div class="col-md-3 sam-product">
                                    Продукт: {{$product -> product_title}}
                                </div>
                                @endforeach
                            </div>
                    </div>











@endsection
<style type="text/css">

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

