@extends('layouts.email')

@section('content')
    <p>
        Добавлена новая идея "{{ $idea->title }}". Скоро ее промодерируют.
    </p>
@endsection
