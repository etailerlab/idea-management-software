@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row page-header">
            <div class="col-sm-8">
                <h1>{{ $title }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @include('partials.errors')
                <form method="POST" action="{{ $route }}">
                    @include('categories.status.partials.fields')
                    <div class="row">
                        <div class="col-md-6">
                            @if(isset($deleteRoute))
                                <a href="{{ $deleteRoute }}" class="btn btn-danger pull-left">Удалить</a>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary pull-right">Сохранить</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <hr>
    </div>
@endsection
