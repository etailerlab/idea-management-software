@extends('layouts.email')

@section('content')
    <p>
        Ваша идея "{{ $idea->title }}" опубликована.
    </p>
@endsection
