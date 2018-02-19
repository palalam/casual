@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Новий магазин</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('shop_create') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('shop_name') ? ' has-error' : '' }}">
                            <label for="shop_name" class="col-md-4 control-label">Ім'я магазину</label>

                            <div class="col-md-6">
                                <input id="shop_name" type="text" class="form-control" name="shop_name" value="{{ old('shop_name') }}" required autofocus>

                                @if ($errors->has('shop_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shop_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>







                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Створити
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
