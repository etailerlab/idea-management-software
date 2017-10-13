@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row page-header">
        <div class="col-sm-8">
            <h1>Редактировать идею</h1>
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
            <form method="POST" action="{{ route('edit-idea', ['id' => $idea->id]) }}" class="js-disable-after-submit">
                @include('index.partials.add-fields')
                <button type="submit" class="btn btn-primary pull-right">Изменить</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('edit-idea.partials.change-status')
        </div>
    </div>
    <hr>
</div>
@endsection
