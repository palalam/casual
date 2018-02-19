@extends('layouts.app')

@section('content')
<form action="{{route('create_obnova_action')}}" method="post" enctype="multipart/form-data">
<div class="row">
		<div class="col-md-4 col-md-offset-4">
		<label>Назва обнови</label>
			<input size="40" type="text" name="obn_name"><br><br>
		</div>
	</div>

<div class="container cont-product">
	
	<div class="row">
	
		<div class="main">


					<div class="col-md-4 add-product">
						<div class="container-fluid cont-image">
							<div class="row">
								<div class="col-md-offset-1 col-md-10 col-image">
									<input id="files" type="file" multiple name="0images[]">
								</div>
							</div>
							<div class="row row-forms">
										
								<div class="col-md-offset-1 col-md-10">
										
									<div class="forms">
										<label>Имя продукта</label><br>
										<input type="text" name="name[]"><br>
										<br>
										<label>Описание продукта</label><br>
										<input type="text" name="desc[]"><br>
										<br>
												
									</div>
								</div>
							</div>

						</div>

					</div> 



	</div>

<img class="plus" style="width: 40px; cursor: pointer;" src="http://s1.iconbird.com/ico/0612/MustHave/w256h2561339195591Add256x256.png">
{{csrf_field()}}
<input type="submit" name="submit" value="OK">
</form>
	</div>

</div>





@endsection
<!-- <img class="plus" style="width: 40px; cursor: pointer;" src="http://s1.iconbird.com/ico/0612/MustHave/w256h2561339195591Add256x256.png"><br> -->
<style type="text/css">
	.cont-product
	{
		border: 1px solid silver;
	}
	.add-product
	{
		height: 400px;
		border: 1px solid red;
	}
	.col-image
	{
		height: 200px;
		border: 1px solid black;
	}
	.cont-image
	{
		margin: 10px;
	}
</style>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
	
		var html = $('.main').html();

		var sc = 0;

		$('img.plus').on('click', function(){
			sc++;
			html = html.replace((sc-1)+'images[]',sc+'images[]');
			$('div.main').append(html);

		});


		$('#files').on('change', function(){
			console.log(this.files.length);
		});

		});

</script>