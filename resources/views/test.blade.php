@extends('layouts.app')

@section('content')
<div class="container">
<form action="" method="post">
<div class="forms">
	<label>Имя продукта</label><br>
	<input type="text" name="name[]"><br>
	<br>
	<label>Описание продукта</label><br>
	<input type="text" name="desc[]"><br>
	<br>
	
</div>
	
	{{csrf_field()}}
	<img class="plus" style="width: 40px; cursor: pointer;" src="http://s1.iconbird.com/ico/0612/MustHave/w256h2561339195591Add256x256.png"><br>

	<br>
	<input type="submit" name="submit" value="OK">

</form>
</div>




@endsection
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
		var html = "<label>Имя продукта</label><br><input type='text' name='name[]'><br><br><label>Описание продукта</label><br><input type='text' name='desc[]'><br><br>";
		$('img.plus').on('click', function(){
			$('div.forms').append(html);
		});
	
			//$('div.forms').append().html(html);
		});

</script>
