@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row page-header">
        <div class="col-sm-8">
            <h1>{{ $title }}</h1>
        </div>
        <div class="col-sm-4">
            <a href="{{ route($route . '.create') }}">
                <button class="btn btn-primary h1" type="button">Добавить</button>
            </a>
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
                    @foreach($items as $item)
                        <tr class="@if (!$item->is_active)danger @endif">
                            <td>{{ $item->name }}</td>
                            <td><a href="{{ route($route . '.edit', ['id' => $item->id]) }}">Редактировать</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
</div>
@endsection
