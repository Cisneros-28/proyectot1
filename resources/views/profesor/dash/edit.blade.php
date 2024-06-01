@extends('adminlte::page')
@section('title', 'Lista de preguntas')
@section('content_header')
    <h1>Calificar Evaluacion  </h1>
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
<div class="card">
    <div class="card-body">

        {!! Form::open(['route' => 'profesor.dash.store']) !!}
               @csrf
        <?php $e = 0;
        $f = -1;
        ?>
        @foreach ($datos as $datos)


            <div class="card">
                <div class="card-header">
                    <div style="padding-left: 10px">
                    {!! Form::label('pregunta', 'Pregunta :  ') !!}<?php echo ' ' . ($e = $e + 1); ?>

</div>
                    <div style="padding-left: 10px; width:10%">






    {!! Form::label('nota_res', 'Nota:   ') !!}
    {!! Form::number('nota_res[]',0, ['class'=>'form-control', 'placeholder' => 'Nota',  'min' => '0', 'max' => '5','id' => 'nota_res[]']) !!}
    {!! Form::hidden('id_examen', $datos->eval, ['class'=>'form-control','id' => 'id_res[]']) !!}

    @foreach ( $user as $uu)
    {!! Form::hidden('id_user',$uu, ['class' => 'form-control','id' => 'id_user[]',]) !!}
    @endforeach







</div>




                </div>
                <div class="card-body">

                    <table>

                        <tbody>

                            <tr>
                                <td>
                                    <h5 > {{ $datos->detalle_pre }} </h5>

                                </td>
                            </tr>


                        </tbody>
                    </table>
                    {!! Form::hidden('id_respuesta[]', $datos->id, [ 'class' => 'form-control']) !!}

                    <?php $f = $f + 1; ?>
                    <div class="form group">
                        {!! Form::text('', $datos->respuesta, ['class' => 'form-control', 'placeholder' => 'Respuesta','disabled']) !!}

                    </div>








                </div>
            </div>
        @endforeach
        <br>
        <center>
            <a class= 'btn btn-danger href' href="{{ URL::previous() }}">CANCELAR</a>
            {!! Form::submit('Calificar Evaluacion', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </center>

    </div>
</div>

<br>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>



@endsection
