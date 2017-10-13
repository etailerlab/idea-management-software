@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row page-header">
        <div class="col-sm-8">
            <h1>Профиль</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @if (Session::has('alert-success'))
                <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('alert-success') }}
                </div>
            @endif
            @include('partials.errors')
            <form method="POST" action="{{ route('profile.update') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">{{ trans('users.name') }}</label>
                    {{ Form::text('name',$user->name, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <label for="name">Фамилия</label>
                    {{ Form::text('last_name',$user->last_name, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <label for="email">{{ trans('users.email') }}</label>
                    {{ Form::text('email',$user->email, ['class'=>'form-control' , 'disabled' => true]) }}
                </div>
                <button type="submit" class="btn btn-primary pull-right">Сохранить</button>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form method="POST" action="{{ route('profile.change-pass') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Новый пароль</label>
                    <input class="form-control" name="password" type="password" value="">
                </div>
                <div class="form-group">
                    <label for="email">Подтверждение пароля</label>
                    <input class="form-control" name="password_confirmation" type="password" value="">
                </div>
                <button type="submit" class="btn btn-primary pull-right">Изменить пароль</button>
            </form>
        </div>
    </div>
    <hr>
</div>
@endsection
