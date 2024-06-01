@extends('adminlte::page')
@section('title', 'Nueva Materia')
@section('content_header')
    <h1>Nueva Materia</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        {!! Form::open(['route' => 'admin.materias.store', 'enctype'=>'multipart/form-data']) !!}

        @csrf

            <div class="form group">
                {!! Form::label('descripcion', 'Materia:') !!}
                {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Materia']) !!}
                @error('descripcion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form group">
                {!! Form::label('estado_materia', 'Estado:') !!}
                {!! Form::select('estado_materia', [null => 'SELECCIONE ESTADO','0' => ' NO DISPONIBLE', '1' => 'DISPONIBLE'], null, [
                    'class' => 'form-control',
                ]) !!}
                @error('estado_materia')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <br>
            {!! Form::submit('Guardar Materia', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
