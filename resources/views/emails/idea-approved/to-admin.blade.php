@extends('layouts.email')

@section('content')
    <p>
        Опубликована новая идея.
        <a href="{{ route('review-idea', ['id' => $idea->id]) }}">Просмотреть</a>.
    </p>
@endsection
