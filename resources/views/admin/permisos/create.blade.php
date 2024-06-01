@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>crear rol</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'admin.permisos.store']) !!}

                @include('admin.permisos.partials.form')

                {!! Form::submit('Crear Rol', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
    <script> console.log('Hi!'); </script>
@stop
