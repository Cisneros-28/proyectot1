@extends('adminlte::page')
@if (Auth::user()->hasrole('ESTUDIANTE'))
@section('content')
<div class="container-fluid d-print-block">
    <header class="row">
        <div class="col-12 pt-5 pb-3">
            <div class="card">

                <div class="col-12 pt-2 pb-2">
                    <h1>Bienvenido </h1>
                    ALUMNO (A): {{Auth::user()->nombre_user}} {{Auth::user()->apellido_user}}</div>

            </div>
            <div class="card">


                <div class="card-body">


                </div>
            </div>
        </div>
    </header>
</div>

@endsection

@elseif (Auth::user()->hasrole('PROFESOR'))
@section('content')
<div class="container-fluid d-print-block">
    <header class="row">
        <div class="col-12 pt-5 pb-3">
            <div class="card">

                <div class="col-12 pt-2 pb-2">
                    <h1>Bienvenido </h1>
                    PROFESOR(A) : {{Auth::user()->nombre_user}}  {{Auth::user()->apellido_user}}</div>

            </div>
            <div class="card">

                {{-- <p style="padding-left:600px; padding-top:100px " >kajsdfasdfasdf</p> --}}

                <div class="card-body">


                </div>
                {{-- <div style=" padding-left:600px; padding-top:100px ">
                    <p  >kajsdfasdfasdf</p>
                </div> --}}
            </div>





        </div>
    </header>
</div>

@endsection

@elseif (Auth::user()->hasrole('SECRETARIA'))
@section('content')
<div class="container-fluid d-print-block">
    <header class="row">
        <div class="col-12 pt-5 pb-3">
            <div class="card">

                <div class="col-12 pt-2 pb-2">
                    <h1>Bienvenido </h1>
                    SECRETARIO(A) : {{Auth::user()->nombre_user}}  {{Auth::user()->apellido_user}}</div>

            </div>
            <div class="card">

                {{-- <p style="padding-left:600px; padding-top:100px " >kajsdfasdfasdf</p> --}}

                <div class="card-body">


                </div>
                {{-- <div style=" padding-left:600px; padding-top:100px ">
                    <p  >kajsdfasdfasdf</p>
                </div> --}}
            </div>





        </div>
    </header>
</div>

@endsection

@elseif (Auth::user()->hasrole('DIRECTOR'))
@section('content')
<div class="container-fluid d-print-block">
    <header class="row">
        <div class="col-12 pt-5 pb-3">
            <div class="card">

                <div class="col-12 pt-2 pb-2">
                    <h1>Bienvenido </h1>
                    DIRECTOR(A) : {{Auth::user()->nombre_user}}  {{Auth::user()->apellido_user}}</div>

            </div>
            <div class="card">

                {{-- <p style="padding-left:600px; padding-top:100px " >kajsdfasdfasdf</p> --}}

                <div class="card-body">


                </div>
                {{-- <div style=" padding-left:600px; padding-top:100px ">
                    <p  >kajsdfasdfasdf</p>
                </div> --}}
            </div>





        </div>
    </header>
</div>

@endsection


@elseif (Auth::user()->hasrole('ADMIN'))
@section('content')
<div class="container-fluid d-print-block">
    <header class="row">
        <div class="col-12 pt-5 pb-3">
            <div class="card">

                <div class="col-12 pt-2 pb-2">
                    <h1>Bienvenido </h1>
                    ADMINISTRADOR(A) : {{Auth::user()->nombre_user}}  {{Auth::user()->apellido_user}}</div>

            </div>
            <div class="card">

                {{-- <p style="padding-left:600px; padding-top:100px " >kajsdfasdfasdf</p> --}}

                <div class="card-body">


                </div>
                {{-- <div style=" padding-left:600px; padding-top:100px ">
                    <p  >kajsdfasdfasdf</p>
                </div> --}}
            </div>





        </div>
    </header>
</div>

@endsection



@endif
