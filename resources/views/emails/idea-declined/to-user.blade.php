@extends('layouts.email')

@section('content')
    <p>
        Ваша идея "{{ $idea->title }}" была отклонена по причине : {{ $reason->text }}.
    </p>
@endsection
