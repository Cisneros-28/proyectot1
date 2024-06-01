@extends('adminlte::page')
@section('title', 'Editar Evaluacion')
@section('content_header')
    <h1>Editar <a href="#">{{ $evaluacion->descripcion }}</a></h1>
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

            {!! Form::model($evaluacion, ['route' => ['profesor.evaluaciones.update', $evaluacion->id], 'method' => 'put']) !!}
            @csrf

            <div class="form-group">
                {!! Form::label('id_trimestre', 'Trimestre:') !!}
                {!! Form::select('id_trimestre', $trimestre, null, ['class' => 'form-control']) !!}
                @error('id_trimestre')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form group">
                {!! Form::label('nombre', 'Evaluacion N°:') !!}
                {!! Form::text('nombre', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Nombre de la Evaluacion',
                ]) !!}
                @error('nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group">
                {!! Form::label('id_tema', 'Tema:') !!}
                {!! Form::select('id_tema', $temas, null, ['class' => 'form-control']) !!}
                @error('id_tema')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {!! Form::hidden('id_user',Auth::user()->id, null,[ 'class' => 'form-control']) !!}

            <div class="form group">
                {!! Form::label('estado_eval', 'Estado:') !!}
                {!! Form::select('estado_eval', [null => 'SELECCIONE ESTADO','0' => ' NO DISPONIBLE', '1' => 'DISPONIBLE'], null, [
                    'class' => 'form-control',
                ]) !!}
                @error('estado_eval')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {!! Form::hidden('id_curso',Auth::user()->curso->id,null, ['class' => 'form-control']) !!}

            <br>
            <a class= 'btn btn-danger href' href="{{ URL::previous() }}">CANCELAR</a>
            {!! Form::submit('ACTUALIZAR EVALUACION', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
