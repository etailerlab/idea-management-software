@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row page-header">
        <div class="col-sm-8">
            <h1>Добавить идею</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('partials.errors')
            <form method="POST" action="{{ route('add-idea') }}" class="js-disable-after-submit">
                @include('index.partials.add-fields')
                <button type="submit" class="btn btn-primary pull-right">Добавить</button>
            </form>
        </div>
    </div>
    <hr>
</div>
@endsection
