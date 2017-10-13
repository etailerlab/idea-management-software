@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row page-header">
        <div class="col-sm-8">
            <h1>{{ $idea->title }}</h1>
        </div>
    </div>

    <div class="container-fluid">
        @if (Session::has('alert-success'))
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('alert-success') }}
            </div>
        @endif
        @include('partials.errors')
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Создана : {{ $idea->created_at->format('d.m.Y') }},
                    {{ $user->getFullName() }}, {{ $user->position->name }}
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <b>Основная компетенция:</b>
                        </div>
                        <div class="col-md-9">
                            <ul class="list-group">
                                @foreach ($idea->coreCompetencies as $coreCompetency)
                                    <li  class="list-group-item">{{ $coreCompetency->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <b>Операционная цель:</b>
                        </div>
                        <div class="col-md-9">
                            <ul class="list-group">
                                @foreach ($idea->operationalGoals as $goal)
                                    <li  class="list-group-item">{{ $goal->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <b>Стратегическая задача:</b>
                        </div>
                        <div class="col-md-9">
                            <ul class="list-group">
                                @foreach ($idea->strategicObjectives as $strategicObjective)
                                    <li  class="list-group-item">{{ $strategicObjective->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <b>Отдел:</b>
                        </div>
                        <div class="col-md-9">
                            <ul class="list-group">
                                @foreach ($idea->departments as $department)
                                    <li  class="list-group-item">{{ $department->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <b>Тип:</b>
                        </div>
                        <div class="col-md-9">
                            <ul class="list-group">
                                <li  class="list-group-item">{{ $idea->type->name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    {{ $idea->description }}
                </div>
            </div>
            <div class="col-sm-12">
                @include('review-idea.partials.approve')
                @include('review-idea.partials.pin-priority')
                @include('edit-idea.partials.change-status')
                @include('edit-idea.partials.edit-button')
                @include('review-idea.partials.declined')
            </div>
        </div>
    </div>
    <hr>
</div>
@endsection
