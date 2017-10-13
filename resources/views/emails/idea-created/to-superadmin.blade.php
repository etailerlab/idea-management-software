@extends('layouts.email')

@section('content')
    <p>
        Добавлена новая идея "{{ $idea->title }}".
        <a href="{{ route('review-idea', ['id' => $idea->id]) }}">Просмотреть</a>.
    </p>
@endsection
