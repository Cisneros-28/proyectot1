@extends('adminlte::page')
@section('title', 'Nuevo Profesor')
@section('content_header')
    <h1>Nuevo Profesor</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'director.profesores.store']) !!}


            @include('director.profesores.partials.form')

            <br>
            {!! Form::submit('Guardar Profesor', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>




@stop



