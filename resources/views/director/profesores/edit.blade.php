@extends('adminlte::page')
@section('title', 'Editar Profesor')
@section('content_header')
    <h1>Editar Profesor <a href="#">{{$profesor->nombre_user}}</a></h1>
@stop

@section('content')

    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>{{ session('mensaje') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($profesor, ['route' => ['director.profesores.update', $profesor->id], 'method' => 'put']) !!}
            @include('director.profesores.partials.form')
            <br>
            <a class= 'btn btn-danger href' href="{{ URL::previous() }}">CANCELAR</a>
            {!! Form::submit('Actualizar Profesor', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
