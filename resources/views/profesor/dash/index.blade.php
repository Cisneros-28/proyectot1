@extends('adminlte::page')
@section('title', 'Avance de la Materia')
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


    <!--PRUEBA-->
    <div class="container-fluid d-print-block">
        <!--inicio header-->
        <header class="row">
            <!--seg div-->

            <div class="col-12 pt-3 pb-3">
                <div class="card">
                    <div class="card-body">

                        <hr>
                        <div><img src="<?php echo e(URL::asset('imagen/uajms.jpg')); ?>" alt="" width="100px" align="right"></div>
                        <div><img src="<?php echo e(URL::asset('imagen/uajms.jpg')); ?>" alt="" width="100px" align="left"></div>
                        <br>
                        <br>
                        <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" align="center">BLOQUE CERO
                        </h1>
                        <h3 style="text-align: center; font-family:sans-serif ">MATERIA GUARANI -U.E.CAIZA J
                            T.T.</h3>
                            <center>
                                <hr>
                                <dd class="alert alert-light" role="alert" ><img width="30px" >
                                  <b>  INFORMACION</b></dd>
                                    <hr>
                            </center>
                            <dl>
                                @foreach ($user as $uu)
                                    <dd><img width="30px" src="<?php echo e(URL::asset('imagen/curso.png')); ?>">   Curso: {{ Auth::user()->curso->nombre_curso }}</dd>
                                    <dd><img width="35px" src="<?php echo e(URL::asset('imagen/perfil.png')); ?>">   Profesor/a : {{ $uu->nombre_user }} {{ $uu->apellido_user }}</dd>
                                    <dd><img width="25px" src="<?php echo e(URL::asset('imagen/email.png')); ?>">   Email: <a href="">{{ $uu->email }}</a></dd>
                                @endforeach


                            </dl>
                            <hr>
                            <center>
                             <dd class="alert alert-light" role="alert">
                                 <img width="35px"  ?> <b>CONTENIDO BLOQUE CERO</b>
                             </dd>
                            </center>



                        <!--seg div-->

                                    <!--ANTIGUIO VISTS-->


                                    <div class="course-content">

                                        <dt class="topics">
                                        <dd class="section main clearfix" aria-labelledby="sectionid-44434-title">


                                        <div class="content">


                                            <dt>
                                                <dd>
                                                    <!--INICIO TEMAS-->



                                                    @foreach ($temas as $tema)
                                                    @if ($tema->estado_tema == 1)
                                                        <!--estado tema-->
                                                        @if ($tema->bloque->nombre == 'BLOQUE CERO')

                                                        <a href="">
                                                            <hr>
                                                                <h5 style="text-align: center; font-family:Verdana, Geneva, Tahoma, sans-serif "> <img width="40px" src="<?php echo e(URL::asset('imagen/libro.png')); ?>">    {{ $tema->titulo }}:  {{ $tema->detalle_tema }}</h5>
                                                                <hr>
                                                            </a>



                                                        @if ($tema->recurso > 0)
                                                            <dd>
                                                                <a href="{{ route('estudiante.respuesta.download', $tema->id) }}" target="_blank">
                                                                    <img width="25px" src="<?php echo e(URL::asset('')); ?>">{{ $tema->recurso }}
                                                                </a>
                                                            </dd>
                                                        @endif



                                                        @foreach ($evaluaciones as $evaluacion)
                                                        @if ($evaluacion->estado_eval == 1)
                                                            @if ($evaluacion->tema->id == $tema->id)
                                                                <dd>
                                                                    <h7>
                                                                        <a href="{{ route('profesor.dash.show', $evaluacion->id) }}">
                                                                            <img width="25px" src="<?php echo e(URL::asset('')); ?>">   {{ $evaluacion->nombre }}
                                                                        </a>
                                                                    </h7>
                                                                    <br>
                                                                </dd>
                                                            @endif
                                                            @endif
                                                        @endforeach


                                                        @foreach ($actividades as $actividad)
                                                         @if ($actividad->estado_acti == 1)
                                                            @if ($actividad->tema->id == $tema->id)
                                                                <h5>{{ $actividad->nombre }}</h5>
                                                                <center>
                                                                    <iframe width="1000px" height="500px" frameborder="2" src="{{ $actividad->enlace }}"></iframe>
                                                                </center>
                                                            @endif
                                                         @endif
                                                        @endforeach
                                                        <!--INICIO BLOQUE-->
                                                        @foreach ($bloques as $bloque)
                                                        @if($bloque->estado == 1)
                                                            @if ($bloque->id_tema !== null)
                                                               <!---foro--->
                                                       @if ($bloque->type->nombre == 'FORO')
                                                       @if ($bloque->bloque->nombre == 'BLOQUE CERO')
                                                       @if ($bloque->tema->id == $tema->id)




                                                           <dd><a href="">
                                                                   <h5 class="sectionname">
                                                                       <span>
                                                                           <a href="{{ route('comentario.show', $bloque->id) }}">
                                                                               <img width="25px" src="<?php echo e(URL::asset('')); ?>">  {{ $bloque->titulo }}
                                                                           </a>
                                                                       </span>
                                                                   </h5>
                                                               </a>
                                                               <dd wire:model="path" id="ckcontent">{!! $bloque->descripcion !!}</dd>
                                                           </dd>
                                                           <!--si el comentario contine imagenes y videos-->

                                                           @if ($bloque->archivo > 0)
                                                           <dd>
                                                               <a href="{{ route('estudiante.respuesta.act_download', $bloque->id) }}" target="_blank">
                                                                   <img width="35px"  ?>">  {{ $bloque->archivo }}
                                                               </a>
                                                           </dd>
                                                       @endif



                                                       <dd>
                                                           @if ($bloque->imagen > 0)
                                                               <center>
                                                                   <img width="50%" src="<?php echo e(URL::asset("imagen/{$bloque->imagen}")); ?>">
                                                               </center>
                                                           @endif
                                                       </dd>

                                                       <dd>
                                                           @if ($bloque->video > 0)
                                                               @php echo '<center><iframe width="560" height="315" src="' .$bloque['video'] .'" title="YouTube video player" frameborder="0"
                                                                     allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                     allowfullscreen></iframe></center>';
                                                               @endphp
                                                           @endif
                                                       </dd>

                                                           <!--fin contenedor-->
                                                           @endif
                                                       @endif
                                                   @endif
                                                    <!----endforo--->
                                                               <!-----distinto de comentario--->
            @if ($bloque->type->nombre == 'RETROALIMENTACION')
            @if ($bloque->bloque->nombre == 'BLOQUE CERO')
            @if ($bloque->tema->id == $tema->id)
            <dd>
            <h5 class="sectionname">
            <span>

            <img width="25px" src="<?php echo e(URL::asset('imagen/libro.png')); ?>">  {{ $bloque->tema->titulo }}

            </span>
            </h5>
            </dd>

            <dd>
            <h5 class="sectionname">
            <img width="35px" src="<?php echo e(URL::asset('imagen/actividad.png')); ?>">{{ $bloque->titulo }}
            </h5>
            </dd>

            @if ($bloque->archivo > 0)
            <dd>
            <a href="{{ route('estudiante.respuesta.act_download', $bloque->id) }}" target="_blank">
            <img width="35px" src="<?php echo e(URL::asset('imagen/archivo.png')); ?>">  {{ $bloque->archivo }}
            </a>
            </dd>
            @endif

            <dd wire:model="path" id="ckcontent"> {!! $bloque->descripcion !!} </dd>

            <dd>
            @if ($bloque->imagen > 0)
            <center>
            <img width="50%" src="<?php echo e(URL::asset("imagen/{$bloque->imagen}")); ?>">
            </center>
            @endif
            </dd>

            <dd>
            @if ($bloque->video > 0)
            @php echo '<center><iframe width="560" height="315" src="' .$bloque['video'] .'" title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe></center>';
            @endphp
            @endif
            </dd>
            @endif
            @endif
            @endif
            <!------fn distinto de comentario---->
                                                            @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @endif
                                                @endforeach
                                            </dt>
                                            <!--tema-->
                                        </div>
                                    </dd>
                                    <dd>
                                        <!--inicio foro sin tema--->

                                                   @foreach ($bloques as $bloque)
             @if ($bloque->id_curso == Auth::user()->curso->id )
                                                   @if ($bloque->estado == 1)

            {{-- qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq --}}

                                                   @if ($bloque->id_tema == null)
                                                       <!---foro--->
                                                       @if ($bloque->type->nombre == 'FORO')
                                                           @if ($bloque->bloque->nombre == 'BLOQUE CERO')
            <hr>

                                                               <dd><a href="">
                                                                       <h5 class="sectionname">
                                                                           <span>
                                                                               <a href="{{ route('comentario.show', $bloque->id) }}">
                                                                                   <img width="25px" src="<?php echo e(URL::asset('imagen/comentario.png')); ?>">  {{ $bloque->titulo }}
                                                                               </a>
                                                                           </span>
                                                                       </h5>
                                                                   </a>
                                                                   <dd wire:model="path" id="ckcontent">{!! $bloque->descripcion !!}</dd>
                                                               </dd>
                                                               <!--si el comentario contine imagenes y videos-->

                                                               @if ($bloque->archivo > 0)
                                                               <dd>
                                                                   <a href="{{ route('estudiante.respuesta.act_download', $bloque->id) }}" target="_blank">
                                                                       <img width="35px" src="<?php echo e(URL::asset('imagen/archivo.png')); ?>">  {{ $bloque->archivo }}
                                                                   </a>
                                                               </dd>
                                                           @endif



                                                           <dd>
                                                               @if ($bloque->imagen > 0)
                                                                   <center>
                                                                       <img width="50%" src="<?php echo e(URL::asset("imagen/{$bloque->imagen}")); ?>">
                                                                   </center>
                                                               @endif
                                                           </dd>

                                                           <dd>
                                                               @if ($bloque->video > 0)
                                                                   @php echo '<center><iframe width="560" height="315" src="' .$bloque['video'] .'" title="YouTube video player" frameborder="0"
                                                                         allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                         allowfullscreen></iframe></center>';
                                                                   @endphp
                                                               @endif
                                                           </dd>

                                                               <!--fin contenedor-->
                                                           @endif
                                                       @endif
                                                        <!----endforo--->
            <!-----distinto de comentario--->
            @if ($bloque->type->nombre == 'RETROALIMENTACION')
            @if ($bloque->bloque->nombre == 'BLOQUE CERO')
            <hr>
            <dd>
            <h5 class="sectionname">
            <img width="35px" src="<?php echo e(URL::asset('imagen/actividad.png')); ?>">{{ $bloque->titulo }}
            </h5>
            </dd>

            @if ($bloque->archivo > 0)
            <dd>
            <a href="{{ route('estudiante.respuesta.act_download', $bloque->id) }}" target="_blank">
            <img width="35px" src="<?php echo e(URL::asset('imagen/archivo.png')); ?>">  {{ $bloque->archivo }}
            </a>
            </dd>
            @endif

            <dd wire:model="path" id="ckcontent"> {!! $bloque->descripcion !!} </dd>

            <dd>
            @if ($bloque->imagen > 0)
            <center>
            <img width="50%" src="<?php echo e(URL::asset("imagen/{$bloque->imagen}")); ?>">
            </center>
            @endif
            </dd>

            <dd>
            @if ($bloque->video > 0)
            @php echo '<center><iframe width="560" height="315" src="' .$bloque['video'] .'" title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe></center>';
            @endphp
            @endif
            </dd>

            @endif
            @endif
            <!------fn distinto de comentario---->
            @endif


            {{-- qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq --}}
            @endif

            @endif

            @endforeach
                                        <!--fin inicio foro sin tema-->
                                    </dd>

                                </dt>
                             </div>


<!--fin ANTIGUIA VISTA BLOQUE CERO-->

<!--fin nav-->

</div>
</div>
</div>
</header>
<!--fin header-->


        <div class="card">
            <div class="card-body">
                    <h2 align="center">BLOQUE ACADEMICO</h2>

                    <div class="d-flex align-items-center">

                        <div class="mr-auto">
                            <div class="page-context-header">
                                <div class="page-header-headings">

                                </div>
                            </div>
                        </div>

                        <div class="header-actions-container flex-shrink-0" data-requion="header-actions-container"></div>
                    </div>
            </div>
        </div>
<!--- inicio bloque academico-->
        <div class="row pb-3 d-print-block">
            <div class="col-12">

                <section>

                    <!--INICIO CQRD-->
                    <div class="card">
                        <div class="card-body">
                            <center>
                                <dd class="alert alert-light" role="alert">
                                    <img width="35px" src="<?php echo e(URL::asset('imagen/contenid.png')); ?>">  <b>CONTENIDO BLOQUE ACADEMICO</b>
                                </dd>

                               </center>


                               {{-- ----------desde aqio --}}
                            <div class="course-content">

                            <dt class="topics">
                            <dd class="section main clearfix" aria-labelledby="sectionid-44434-title">


                            <div class="content">


                                <dt>
                                    <dd>
                                        <!--INICIO TEMAS-->



                                        @foreach ($temas as $tema)
                                        @if ($tema->estado_tema == 1)
                                            <!--estado tema-->
                                            @if ($tema->bloque->nombre == 'BLOQUE ACADEMICO')

                                            <a href="">
                                                <hr>
                                                    <h5 style="text-align: center; font-family:Verdana, Geneva, Tahoma, sans-serif "> <img width="40px" src="<?php echo e(URL::asset('imagen/libro.png')); ?>">    {{ $tema->titulo }}:  {{ $tema->detalle_tema }}</h5>
                                                    <hr>
                                                </a>



                                            @if ($tema->recurso > 0)
                                                <dd>
                                                    <a href="{{ route('estudiante.respuesta.download', $tema->id) }}" target="_blank">
                                                        <img width="25px" src="<?php echo e(URL::asset('imagen/archivo.png')); ?>">{{ $tema->recurso }}
                                                    </a>
                                                </dd>
                                            @endif



                                            @foreach ($evaluaciones as $evaluacion)
                                            @if ($evaluacion->estado_eval == 1)
                                                @if ($evaluacion->tema->id == $tema->id)
                                                    <dd>
                                                        <h7>
                                                            <a href="{{ route('profesor.dash.show', $evaluacion->id) }}">
                                                                <img width="25px" src="<?php echo e(URL::asset('imagen/test.png')); ?>">   {{ $evaluacion->nombre }}
                                                            </a>
                                                        </h7>
                                                        <br>
                                                    </dd>
                                                @endif
                                                @endif
                                            @endforeach


                                            @foreach ($actividades as $actividad)
                                             @if ($actividad->estado_acti == 1)
                                                @if ($actividad->tema->id == $tema->id)
                                                    <h5>{{ $actividad->nombre }}</h5>
                                                    <center>
                                                        <iframe width="1000px" height="500px" frameborder="2" src="{{ $actividad->enlace }}"></iframe>
                                                    </center>
                                                @endif
                                             @endif
                                            @endforeach
                                            <!--INICIO BLOQUE-->
                                            @foreach ($bloques as $bloque)
                                            @if($bloque->estado == 1)
                                                @if ($bloque->id_tema !== null)
                                                   <!---foro--->
                                           @if ($bloque->type->nombre == 'FORO')
                                           @if ($bloque->bloque->nombre == 'BLOQUE ACADEMICO')
                                           @if ($bloque->tema->id == $tema->id)




                                               <dd><a href="">
                                                       <h5 class="sectionname">
                                                           <span>
                                                               <a href="{{ route('comentario.show', $bloque->id) }}">
                                                                   <img width="25px" src="<?php echo e(URL::asset('imagen/comentario.png')); ?>">  {{ $bloque->titulo }}
                                                               </a>
                                                           </span>
                                                       </h5>
                                                   </a>
                                                   <dd wire:model="path" id="ckcontent">{!! $bloque->descripcion !!}</dd>
                                               </dd>
                                               <!--si el comentario contine imagenes y videos-->

                                               @if ($bloque->archivo > 0)
                                               <dd>
                                                   <a href="{{ route('estudiante.respuesta.act_download', $bloque->id) }}" target="_blank">
                                                       <img width="35px" src="<?php echo e(URL::asset('imagen/archivo.png')); ?>">  {{ $bloque->archivo }}
                                                   </a>
                                               </dd>
                                           @endif



                                           <dd>
                                               @if ($bloque->imagen > 0)
                                                   <center>
                                                       <img width="50%" src="<?php echo e(URL::asset("imagen/{$bloque->imagen}")); ?>">
                                                   </center>
                                               @endif
                                           </dd>

                                           <dd>
                                               @if ($bloque->video > 0)
                                                   @php echo '<center><iframe width="560" height="315" src="' .$bloque['video'] .'" title="YouTube video player" frameborder="0"
                                                         allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                         allowfullscreen></iframe></center>';
                                                   @endphp
                                               @endif
                                           </dd>

                                               <!--fin contenedor-->
                                               @endif
                                           @endif
                                       @endif
                                        <!----endforo--->
                                                   <!-----distinto de comentario--->
@if ($bloque->type->nombre == 'RETROALIMENTACION')
@if ($bloque->bloque->nombre == 'BLOQUE ACADEMICO')
@if ($bloque->tema->id == $tema->id)
<dd>
<h5 class="sectionname">
<span>

<img width="25px" src="<?php echo e(URL::asset('imagen/libro.png')); ?>">  {{ $bloque->tema->titulo }}

</span>
</h5>
</dd>

<dd>
<h5 class="sectionname">
<img width="35px" src="<?php echo e(URL::asset('imagen/actividad.png')); ?>">{{ $bloque->titulo }}
</h5>
</dd>

@if ($bloque->archivo > 0)
<dd>
<a href="{{ route('estudiante.respuesta.act_download', $bloque->id) }}" target="_blank">
<img width="35px" src="<?php echo e(URL::asset('imagen/archivo.png')); ?>">  {{ $bloque->archivo }}
</a>
</dd>
@endif

<dd wire:model="path" id="ckcontent"> {!! $bloque->descripcion !!} </dd>

<dd>
@if ($bloque->imagen > 0)
<center>
<img width="50%" src="<?php echo e(URL::asset("imagen/{$bloque->imagen}")); ?>">
</center>
@endif
</dd>

<dd>
@if ($bloque->video > 0)
@php echo '<center><iframe width="560" height="315" src="' .$bloque['video'] .'" title="YouTube video player" frameborder="0"
allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
allowfullscreen></iframe></center>';
@endphp
@endif
</dd>
@endif
@endif
@endif
<!------fn distinto de comentario---->
                                                @endif
                                                @endif
                                            @endforeach
                                        @endif
                                        @endif
                                    @endforeach
                                </dt>
                                <!--tema-->
                            </div>
                        </dd>
                        <dd>
                            <!--inicio foro sin tema--->

                                       @foreach ($bloques as $bloque)
 @if ($bloque->id_curso == Auth::user()->curso->id )
                                       @if ($bloque->estado == 1)

{{-- qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq --}}

                                       @if ($bloque->id_tema == null)
                                           <!---foro--->
                                           @if ($bloque->type->nombre == 'FORO')
                                               @if ($bloque->bloque->nombre == 'BLOQUE ACADEMICO')
<hr>

                                                   <dd><a href="">
                                                           <h5 class="sectionname">
                                                               <span>
                                                                   <a href="{{ route('comentario.show', $bloque->id) }}">
                                                                       <img width="25px" src="<?php echo e(URL::asset('imagen/comentario.png')); ?>">  {{ $bloque->titulo }}
                                                                   </a>
                                                               </span>
                                                           </h5>
                                                       </a>
                                                       <dd wire:model="path" id="ckcontent">{!! $bloque->descripcion !!}</dd>
                                                   </dd>
                                                   <!--si el comentario contine imagenes y videos-->

                                                   @if ($bloque->archivo > 0)
                                                   <dd>
                                                       <a href="{{ route('estudiante.respuesta.act_download', $bloque->id) }}" target="_blank">
                                                           <img width="35px" src="<?php echo e(URL::asset('imagen/archivo.png')); ?>">  {{ $bloque->archivo }}
                                                       </a>
                                                   </dd>
                                               @endif



                                               <dd>
                                                   @if ($bloque->imagen > 0)
                                                       <center>
                                                           <img width="50%" src="<?php echo e(URL::asset("imagen/{$bloque->imagen}")); ?>">
                                                       </center>
                                                   @endif
                                               </dd>

                                               <dd>
                                                   @if ($bloque->video > 0)
                                                       @php echo '<center><iframe width="560" height="315" src="' .$bloque['video'] .'" title="YouTube video player" frameborder="0"
                                                             allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                             allowfullscreen></iframe></center>';
                                                       @endphp
                                                   @endif
                                               </dd>

                                                   <!--fin contenedor-->
                                               @endif
                                           @endif
                                            <!----endforo--->
<!-----distinto de comentario--->
@if ($bloque->type->nombre == 'RETROALIMENTACION')
@if ($bloque->bloque->nombre == 'BLOQUE ACADEMICO')
<hr>
<dd>
<h5 class="sectionname">
<img width="35px" src="<?php echo e(URL::asset('imagen/actividad.png')); ?>">{{ $bloque->titulo }}
</h5>
</dd>

@if ($bloque->archivo > 0)
<dd>
<a href="{{ route('estudiante.respuesta.act_download', $bloque->id) }}" target="_blank">
<img width="35px" src="<?php echo e(URL::asset('imagen/archivo.png')); ?>">  {{ $bloque->archivo }}
</a>
</dd>
@endif

<dd wire:model="path" id="ckcontent"> {!! $bloque->descripcion !!} </dd>

<dd>
@if ($bloque->imagen > 0)
<center>
<img width="50%" src="<?php echo e(URL::asset("imagen/{$bloque->imagen}")); ?>">
</center>
@endif
</dd>

<dd>
@if ($bloque->video > 0)
@php echo '<center><iframe width="560" height="315" src="' .$bloque['video'] .'" title="YouTube video player" frameborder="0"
allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
allowfullscreen></iframe></center>';
@endphp
@endif
</dd>

@endif
@endif
<!------fn distinto de comentario---->
@endif


{{-- qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq --}}
@endif

@endif

@endforeach
                            <!--fin inicio foro sin tema-->
                        </dd>

                    </dt>
                 </div>

                 {{-- ---------- --}}
            </div>
        </div>
    </div>
 <!--FIN CQRD-->

 <!--INICIO CQRD-->
        <div class="card">
            <div class="card-body">
                    <h2 align="center">BLOQUE CIERRE</h2>

                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <div class="page-context-header">
                                <div class="page-header-headings">

                                </div>
                            </div>
                        </div>
                        <div class="header-actions-container flex-shrink-0" data-requion="header-actions-container"></div>
                    </div>
            </div>
        </div>

        <div class="row pb-3 d-print-block">
            <div class="col-12">
                <section>
                    <header class="row">
                        <!--seg div-->
                        <div class="col-12 pt-3 pb-3">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <dd class="alert alert-light" role="alert">
                                            <img width="35px" src="<?php echo e(URL::asset('imagen/contenid.png')); ?>">  <b>CONTENIDO BLOQUE CIERRE</b>
                                        </dd>
                                       </center>

                                    <!--seg div-->


                                    {{-- ---------------------------- --}}
                                    <div class="course-content">

                                        <dt class="topics">
                                        <dd class="section main clearfix" aria-labelledby="sectionid-44434-title">


                                        <div class="content">


                                            <dt>
                                                <dd>
                                                    <!--INICIO TEMAS-->



                                                    @foreach ($temas as $tema)
                                                    @if ($tema->estado_tema == 1)
                                                        <!--estado tema-->
                                                        @if ($tema->bloque->nombre == 'BLOQUE CIERRE')

                                                        <a href="">
                                                            <hr>
                                                                <h5 style="text-align: center; font-family:Verdana, Geneva, Tahoma, sans-serif "> <img width="40px" src="<?php echo e(URL::asset('imagen/libro.png')); ?>">    {{ $tema->titulo }}:  {{ $tema->detalle_tema }}</h5>
                                                                <hr>
                                                            </a>



                                                        @if ($tema->recurso > 0)
                                                            <dd>
                                                                <a href="{{ route('estudiante.respuesta.download', $tema->id) }}" target="_blank">
                                                                    <img width="25px" src="<?php echo e(URL::asset('imagen/archivo.png')); ?>">{{ $tema->recurso }}
                                                                </a>
                                                            </dd>
                                                        @endif



                                                        @foreach ($evaluaciones as $evaluacion)
                                                        @if ($evaluacion->estado_eval == 1)
                                                            @if ($evaluacion->tema->id == $tema->id)
                                                                <dd>
                                                                    <h7>
                                                                        <a href="{{ route('profesor.dash.show', $evaluacion->id) }}">
                                                                            <img width="25px" src="<?php echo e(URL::asset('imagen/test.png')); ?>">   {{ $evaluacion->nombre }}
                                                                        </a>
                                                                    </h7>
                                                                    <br>
                                                                </dd>
                                                            @endif
                                                            @endif
                                                        @endforeach


                                                        @foreach ($actividades as $actividad)
                                                         @if ($actividad->estado_acti == 1)
                                                            @if ($actividad->tema->id == $tema->id)
                                                                <h5>{{ $actividad->nombre }}</h5>
                                                                <center>
                                                                    <iframe width="1000px" height="500px" frameborder="2" src="{{ $actividad->enlace }}"></iframe>
                                                                </center>
                                                            @endif
                                                         @endif
                                                        @endforeach
                                                        <!--INICIO BLOQUE-->
                                                        @foreach ($bloques as $bloque)
                                                        @if($bloque->estado == 1)
                                                            @if ($bloque->id_tema !== null)
                                                               <!---foro--->
                                                       @if ($bloque->type->nombre == 'FORO')
                                                       @if ($bloque->bloque->nombre == 'BLOQUE CIERRE')
                                                       @if ($bloque->tema->id == $tema->id)




                                                           <dd><a href="">
                                                                   <h5 class="sectionname">
                                                                       <span>
                                                                           <a href="{{ route('comentario.show', $bloque->id) }}">
                                                                               <img width="25px" src="<?php echo e(URL::asset('imagen/comentario.png')); ?>">  {{ $bloque->titulo }}
                                                                           </a>
                                                                       </span>
                                                                   </h5>
                                                               </a>
                                                               <dd wire:model="path" id="ckcontent">{!! $bloque->descripcion !!}</dd>
                                                           </dd>
                                                           <!--si el comentario contine imagenes y videos-->

                                                           @if ($bloque->archivo > 0)
                                                           <dd>
                                                               <a href="{{ route('estudiante.respuesta.act_download', $bloque->id) }}" target="_blank">
                                                                   <img width="35px" src="<?php echo e(URL::asset('imagen/archivo.png')); ?>">  {{ $bloque->archivo }}
                                                               </a>
                                                           </dd>
                                                       @endif



                                                       <dd>
                                                           @if ($bloque->imagen > 0)
                                                               <center>
                                                                   <img width="50%" src="<?php echo e(URL::asset("imagen/{$bloque->imagen}")); ?>">
                                                               </center>
                                                           @endif
                                                       </dd>

                                                       <dd>
                                                           @if ($bloque->video > 0)
                                                               @php echo '<center><iframe width="560" height="315" src="' .$bloque['video'] .'" title="YouTube video player" frameborder="0"
                                                                     allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                     allowfullscreen></iframe></center>';
                                                               @endphp
                                                           @endif
                                                       </dd>

                                                           <!--fin contenedor-->
                                                           @endif
                                                       @endif
                                                   @endif
                                                    <!----endforo--->
                                                               <!-----distinto de comentario--->
            @if ($bloque->type->nombre == 'RETROALIMENTACION')
            @if ($bloque->bloque->nombre == 'BLOQUE CIERRE')
            @if ($bloque->tema->id == $tema->id)
            <dd>
            <h5 class="sectionname">
            <span>

            <img width="25px" src="<?php echo e(URL::asset('imagen/libro.png')); ?>">  {{ $bloque->tema->titulo }}

            </span>
            </h5>
            </dd>

            <dd>
            <h5 class="sectionname">
            <img width="35px" src="<?php echo e(URL::asset('imagen/actividad.png')); ?>">{{ $bloque->titulo }}
            </h5>
            </dd>

            @if ($bloque->archivo > 0)
            <dd>
            <a href="{{ route('estudiante.respuesta.act_download', $bloque->id) }}" target="_blank">
            <img width="35px" src="<?php echo e(URL::asset('imagen/archivo.png')); ?>">  {{ $bloque->archivo }}
            </a>
            </dd>
            @endif

            <dd wire:model="path" id="ckcontent"> {!! $bloque->descripcion !!} </dd>

            <dd>
            @if ($bloque->imagen > 0)
            <center>
            <img width="50%" src="<?php echo e(URL::asset("imagen/{$bloque->imagen}")); ?>">
            </center>
            @endif
            </dd>

            <dd>
            @if ($bloque->video > 0)
            @php echo '<center><iframe width="560" height="315" src="' .$bloque['video'] .'" title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe></center>';
            @endphp
            @endif
            </dd>
            @endif
            @endif
            @endif
            <!------fn distinto de comentario---->
                                                            @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @endif
                                                @endforeach
                                            </dt>
                                            <!--tema-->
                                        </div>
                                    </dd>
                                    <dd>
                                        <!--inicio foro sin tema--->

                                                   @foreach ($bloques as $bloque)
             @if ($bloque->id_curso == Auth::user()->curso->id )
                                                   @if ($bloque->estado == 1)

            {{-- qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq --}}

                                                   @if ($bloque->id_tema == null)
                                                       <!---foro--->
                                                       @if ($bloque->type->nombre == 'FORO')
                                                           @if ($bloque->bloque->nombre == 'BLOQUE CIERRE')
            <hr>

                                                               <dd><a href="">
                                                                       <h5 class="sectionname">
                                                                           <span>
                                                                               <a href="{{ route('comentario.show', $bloque->id) }}">
                                                                                   <img width="25px" src="<?php echo e(URL::asset('imagen/comentario.png')); ?>">  {{ $bloque->titulo }}
                                                                               </a>
                                                                           </span>
                                                                       </h5>
                                                                   </a>
                                                                   <dd wire:model="path" id="ckcontent">{!! $bloque->descripcion !!}</dd>
                                                               </dd>
                                                               <!--si el comentario contine imagenes y videos-->

                                                               @if ($bloque->archivo > 0)
                                                               <dd>
                                                                   <a href="{{ route('estudiante.respuesta.act_download', $bloque->id) }}" target="_blank">
                                                                       <img width="35px" src="<?php echo e(URL::asset('imagen/archivo.png')); ?>">  {{ $bloque->archivo }}
                                                                   </a>
                                                               </dd>
                                                           @endif



                                                           <dd>
                                                               @if ($bloque->imagen > 0)
                                                                   <center>
                                                                       <img width="50%" src="<?php echo e(URL::asset("imagen/{$bloque->imagen}")); ?>">
                                                                   </center>
                                                               @endif
                                                           </dd>

                                                           <dd>
                                                               @if ($bloque->video > 0)
                                                                   @php echo '<center><iframe width="560" height="315" src="' .$bloque['video'] .'" title="YouTube video player" frameborder="0"
                                                                         allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                         allowfullscreen></iframe></center>';
                                                                   @endphp
                                                               @endif
                                                           </dd>

                                                               <!--fin contenedor-->
                                                           @endif
                                                       @endif
                                                        <!----endforo--->
            <!-----distinto de comentario--->
            @if ($bloque->type->nombre == 'RETROALIMENTACION')
            @if ($bloque->bloque->nombre == 'BLOQUE CIERRE')
            <hr>
            <dd>
            <h5 class="sectionname">
            <img width="35px" src="<?php echo e(URL::asset('imagen/actividad.png')); ?>">{{ $bloque->titulo }}
            </h5>
            </dd>

            @if ($bloque->archivo > 0)
            <dd>
            <a href="{{ route('estudiante.respuesta.act_download', $bloque->id) }}" target="_blank">
            <img width="35px" src="<?php echo e(URL::asset('imagen/archivo.png')); ?>">  {{ $bloque->archivo }}
            </a>
            </dd>
            @endif

            <dd wire:model="path" id="ckcontent"> {!! $bloque->descripcion !!} </dd>

            <dd>
            @if ($bloque->imagen > 0)
            <center>
            <img width="50%" src="<?php echo e(URL::asset("imagen/{$bloque->imagen}")); ?>">
            </center>
            @endif
            </dd>

            <dd>
            @if ($bloque->video > 0)
            @php echo '<center><iframe width="560" height="315" src="' .$bloque['video'] .'" title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe></center>';
            @endphp
            @endif
            </dd>

            @endif
            @endif
            <!------fn distinto de comentario---->
            @endif


            {{-- qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq --}}
            @endif

            @endif

            @endforeach
                                        <!--fin inicio foro sin tema-->
                                    </dd>

                                </dt>
                             </div>

                                    {{-- ----------- --}}
                                </div>
                            </div>
                        </div>
                    </header>
                </section>
    </div>

    </div>
    </div>
{{-- ------------------------- --}}
@stop


@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#descripcion'), {
                simpleUpload: {
                    uploadUrl: "{route['profesor.bloques.index']}",
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.1/classic/ckeditor.js"></script>
    <script>
        window.onload = function() {
            if (document.querySelector("#ckcontent")) {
                ClassicEditor.create(document.querySelector("#ckcontent"), {
                        extraPlugins: [MyCustomUploadAdapterPlugin]
                    })
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            document.querySelector("#content").value = editor.getData()
                        })
                    })
                    .catch(error => {
                        console.error(error.stack);
                    });
            }
        }
    </script>
@endsection
