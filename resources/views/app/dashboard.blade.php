@extends('layout.main')

@section('title', 'Dashboard')

@section('main')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".add-todo-modal"><i class="fa fa-plus"></i> Add Todo</button>
            </div>
            <h4 class="page-title"><i class="fa fa-list"></i> My Todos</h4>
        </div>
    </div>
</div>

<?php

$todos = \App\Todo::orderBy('id', 'DESC')->where('status', 'IN_PROGRESS')->get()

?>

@if(count($todos) != 0)

<div class="row">
    @foreach($todos as $t)
    <div class="col-md-6 col-xl-3">
        <div class="card-box">
            <i route="{{route('app.todos.complete', $t->id)}}" tip="Mark as Complete!" style="cursor: pointer" class="completeTodo fa fa-check-double fa-2x text-muted float-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as Complete!"></i>
            <h4 class="mt-0 font-16"></h4>
            <h2 class="text-primary my-3 text-center"><span class="fa fa-book fa-2x"></span></h2>
            <p class="text-muted mb-0"> {{$t->title}} <span class="float-right viewTodo" data-toggle="modal" data-target=".view-todo-modal" route="{{route('app.todos.view', $t->id)}}" style="cursor: pointer" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Details"><i class="fa fa-search text-success mr-1"></i></span></p>
        </div>
    </div>
    @endforeach
</div>

@else
<br />
<div class="alert alert-danger">
    <p><i class="fa fa-check-double"></i> You dont have pending todos</p>
</div>

@endif

@endsection