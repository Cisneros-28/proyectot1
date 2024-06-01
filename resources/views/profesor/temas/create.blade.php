@extends('adminlte::page')
@section('title', 'Nuevo Tema')
@section('content_header')
    <h1>Nuevo Tema</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        {!! Form::open(['route' => 'profesor.temas.store', 'enctype'=>'multipart/form-data']) !!}

        @csrf


        <div class="form-group">
            {!! Form::label('id_materia', 'Materia:') !!}
            {!! Form::select('id_materia', $materia, null, ['class' => 'form-control']) !!}
            @error('id_materia')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('id_bloque', 'Bloque:') !!}
            {!! Form::select('id_bloque', $bloque, null, ['class' => 'form-control']) !!}
            @error('id_bloque')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
            <div class="form group">
                {!! Form::label('titulo', 'Tema:') !!}
                {!! Form::text('titulo', null, ['class' => 'form-control', 'placeholder' => 'Tema']) !!}
                @error('titulo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form group">
                {!! Form::label('detalle_tema', 'Titulo:') !!}
                {!! Form::text('detalle_tema', null, ['class' => 'form-control', 'placeholder' => 'Título del Tema']) !!}
                @error('detalle_tema')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {!! Form::hidden('curso',Auth::user()->curso->id,null, ['class' => 'form-control']) !!}

            <div class="form group">

                {!! Form::label('recurso', 'Recurso:') !!}
                <div class="form group">

                {!! Form::file('recurso', null, ['class'=>'form-control','placeholder'=>'']) !!}
                @error('recurso')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form group">
                {!! Form::label('estado_tema', 'Estado:') !!}
                {!! Form::select('estado_tema', [null => 'SELECCIONE ESTADO','0' => ' NO DISPONIBLE', '1' => 'DISPONIBLE'], null, [
                    'class' => 'form-control',
                ]) !!}
                @error('estado_tema')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <br>
            {!! Form::submit('GUARDAR TEMA', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
