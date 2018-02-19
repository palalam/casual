@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Новий магазин</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('create_obnova_action') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('obnova_name') ? ' has-error' : '' }}">
                            <label for="obnova_name" class="col-md-4 control-label">Ім'я обнови</label>

                            <div class="col-md-6">
                                <input id="obnova_name" type="text" class="form-control" name="obnova_name" value="{{ old('obnova_name') }}" required autofocus>

                                @if ($errors->has('obnova_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('obnova_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>






                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Додати
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
