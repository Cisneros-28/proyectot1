@extends('adminlte::page')
@section('title', 'Lista de preguntas')
@section('content_header')
    <h1>{{$eval->descripcion}}</h1>
@stop
@section('content')
    @if (session('mensaje'))
        <div class="alert alert-success">
            <strong>{{ session('mensaje') }}</strong>
        </div>
    @endif
    @if (session('deleted'))
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>{{ session('deleted') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if ($count>0)
    <div class="card">
        <div class="card-body" >

            {!! Form::open(['route' => 'estudiante.respuesta.store']) !!}
            @csrf
            <?php $e = 0;
            $f = -1;

            ?>
            @foreach ($preguntas as $pregunta)
                <div class="card">
                    <div class="card-header">
                        {!! Form::label('pregunta', 'Pregunta :  ') !!}<?php echo ' ' . ($e = $e + 1); ?>
                    </div>
                    <div class="card-body">

                        <table>

                            <tbody>

                                <tr>
                                    <td>
                                        <h5 > {{ $pregunta->detalle_pre }} </h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>

                                    </td>
                                </tr>

                            </tbody>
                        </table>



                        {!! Form::hidden('id_pregunta[]', $pregunta->id, [ 'class' => 'form-control','id' => 'id_pregunta[]']) !!}
                        <?php $f = $f + 1; ?>
                        <div class="form group{{ $errors->has('respuesta.' . $f) ? 'has-error' : '' }}">
                            {!! Form::text('respuesta[]', null, ['class' => 'form-control', 'placeholder' => 'Respuesta']) !!}

                            @if ($errors->has('respuesta.' . $f))
                                <span class="text-danger">
                                    {{ $errors->first('respuesta.' . $f) }}
                                </span>
                            @endif

                        </div>

                            <!--evaluacion-->
                        {!! Form::hidden('eval[]',$evaluacion, ['class' => 'form-control','id' => 'eval[]',]) !!}

                        @foreach ($usuario as $uu)
                        {!! Form::hidden('id_user[]',$uu, ['class' => 'form-control','id' => 'id_user[]',]) !!}
                        @endforeach

                    </div>
                </div>
            @endforeach
            <br>



            <center>
                {!! Form::submit('Terminar Evaluacion', ['class' => 'btn btn-primary','id'=>'btn']) !!}
                {!! Form::close() !!}
            </center>

        </div>
    </div>
@else
<center>
    <div class="alert alert-danger" role="alert">
    ¡La Evaluacion no contiene preguntas!
      </div>

</center>

@endif

    <br>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>


    <script>
        function enviar(){
        var btn = document.getElementById('btn');
        btn.setAttribute('disabled','');
        alert('botón disabled');
      }
    </script>




    <script>
        enviando = false; //Obligaremos a entrar el if en el primer submit

           function checkSubmit() {
               if (!enviando) {
                   enviando= true;
                   return true;
               } else {
                   //Si llega hasta aca significa que pulsaron 2 veces el boton submit
                   alert("El formulario ya se esta enviando");
                   return false;
               }
           }
           </script>

@endsection
