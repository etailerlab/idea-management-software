@extends('layouts.email')

@section('content')
    <p>
        Для идеи "{{ $idea->title }}" был изменен статус : {{ $status->name }}.
    </p>
@endsection
