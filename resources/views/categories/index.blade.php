@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row page-header">
        <div class="col-sm-8">
            <h1>Категории</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Статусы</td>
                        <td><a href="{{ route('categories.statuses.index') }}">Редактировать</a></td>
                    </tr>
                    <tr>
                        <td>Отделы</td>
                        <td><a href="{{ route('categories.department.index') }}">Редактировать</a></td>
                    </tr>
                    <tr>
                        <td>Должности</td>
                        <td><a href="{{ route('categories.position.index') }}">Редактировать</a></td>
                    </tr>
                    <tr>
                        <td>Основные компетенции</td>
                        <td><a href="{{ route('categories.core-competency.index') }}">Редактировать</a></td>
                    </tr>
                    <tr>
                        <td>Операционные цели</td>
                        <td><a href="{{ route('categories.operational-goal.index') }}">Редактировать</a></td>
                    </tr>
                    <tr>
                        <td>Стратегические задачи</td>
                        <td><a href="{{ route('categories.strategic-objective.index') }}">Редактировать</a></td>
                    </tr>
                    <tr>
                        <td>Типы</td>
                        <td><a href="{{ route('categories.type.index') }}">Редактировать</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
</div>
@endsection
