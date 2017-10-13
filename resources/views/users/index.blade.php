@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row page-header">
        <div class="col-sm-8">
            <h1>{{ trans('users.title') }}</h1>
        </div>
        <div class="col-sm-4">
            <a href="{{ route('users.create') }}">
                <button class="btn btn-primary h1" type="button">{{ trans('users.add_new') }}</button>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ trans('users.name') }}</th>
                        <th>Фамилия</th>
                        <th>{{ trans('users.email') }}</th>
                        <th>{{ trans('users.active_ideas') }}</th>
                        <th>{{ trans('users.frozen_ideas') }}</th>
                        <th>{{ trans('users.completed_ideas') }}</th>
                        <th>{{ trans('users.role') }}</th>
                        <th>{{ trans('users.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="@if (!$user->is_active)danger @endif">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->countActiveIdeas() }}</td>
                            <td>{{ $user->countFrozenIdeas() }}</td>
                            <td>{{ $user->countCompletedIdeas() }}</td>
                            <td>{{ $user->roles()->first()->display_name }}</td>
                            <td>
                                <a href="{{ route('users.edit', ['id' => $user->id]) }}">Редактировать</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <hr>
    {{ $users->render() }}
</div>
@endsection
