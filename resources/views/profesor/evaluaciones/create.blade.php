@extends('adminlte::page')
@section('title', 'Nueva Evaluacion')
@section('content_header')
    <h1>Nueva Evaluacion</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'profesor.evaluaciones.store']) !!}

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
            {!! Form::submit('GUARDAR EVALUACION', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>




@stop
