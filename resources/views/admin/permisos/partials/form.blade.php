<div class="form-group">
    {!! Form::label('name','Nombre') !!}
    {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Ingrese el nombre del rol']) !!}

    @error('name')
        <small class="text-danger">
            {{$message}}
        </small>
    @enderror

</div>

<div class="form group">
    {!! Form::label('estado_rol', 'Estado:') !!}
    {!! Form::select('estado_rol',[null => 'SELECCIONE ESTADO','0' => 'NO ACTIVO', '1' => 'ACTIVO'], null, [
        'class' => 'form-control',
    ]) !!}
    @error('estado_rol')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<br>
<h2 class="h3">Listado de permisos</h2>

@foreach ($permissions as $permission)
    <div>
        <label>
            {!! Form::checkbox('permissions[]', $permission->id, null, ['class'=>'mr-1']) !!}
            {{$permission->description}}
        </label>
    </div>
@endforeach
