@extends('layouts.email')

@section('content')
    <p>
        Для завершения процедуры восстановления пароля перейдите по
        <a href="{{route('password.reset', ['token' => $token])}}">ссылке</a>.
    </p>
@endsection
