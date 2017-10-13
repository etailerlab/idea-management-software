@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1 class="page-header">{{ $title }}
                <small>({{ $ideas->total() }})</small>
            </h1>
        </div>
        @include('partials.top-users')
    </div>

    @include('browse-ideas.partials.filter')
    @each('browse-ideas.partials.item', $ideas, 'idea')

    @unless($ideas->count())
        Ничего не найдено.
    @endunless

    <div class="row text-center">
        <div class="col-lg-12">
            {{ $ideas->render() }}
        </div>
    </div>
</div>
@endsection
