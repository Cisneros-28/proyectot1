@extends('adminlte::page')
@section('title', 'Editar Estudiante')
@section('content_header')
    <h1>Editar Estudiante <a href="#">{{$estudiante->nombre_user}}</a></h1>
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
            {!! Form::model($estudiante, ['route' => ['secretaria.estudiantes.update', $estudiante->id], 'method' => 'put']) !!}

            @include('secretaria.estudiantes.partials.form')
            <br>

            <a class= 'btn btn-danger href' href="{{ URL::previous() }}">CANCELAR</a>
            {!! Form::submit('Actualizar Estudiante', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
