@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row page-header">
        <div class="col-sm-8">
            <h1>Редактирование пользователя</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('partials.errors')
            @if ($inviteStatus !== 'successful')
                <div class="alert alert-warning alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Пользователь еще не активировал приглашение.
                </div>
            @endif
            <form method="POST" action="{{ route('users.update', ['id' => $user->id]) }}">
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
                    {{ Form::text('email',$user->email, ['class'=>'form-control', 'disabled' => true]) }}
                </div>
                <div class="form-group">
                    <label for="department">{{ trans('users.department') }}</label>
                    {{ Form::select('department_id', $departments, $user->department->id, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <label for="department">Должность</label>
                    {{ Form::select('position_id', $positions, $user->position->id, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <label for="department">{{ trans('users.role') }}</label>
                    {{ Form::select('role_id', $roles, $user->roles()->first()->id, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            {{ Form::checkbox('is_active', '1', $user->is_active) }}
                            Активность
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary pull-right">Сохранить</button>
            </form>
        </div>
    </div>
    <hr>
</div>
@endsection
