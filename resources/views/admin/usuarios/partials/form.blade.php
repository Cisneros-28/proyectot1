          <!--inicio-->
          <div class="form group">
            {!! Form::label('nombre_user', 'Nombres:') !!}
            {!! Form::text('nombre_user', null, [
                'class' => 'form-control',
                'placeholder' => 'Nombre Completo del Usuario',
            ]) !!}
            @error('nombre_user')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form group">
            {!! Form::label('apellido_user', 'Apellidos:') !!}
            {!! Form::text('apellido_user', null, [
                'class' => 'form-control',
                'placeholder' => 'Apellido Completo del Usuario',
            ]) !!}
            @error('apellido_user')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form group">
            {!! Form::label('genero', 'Genero:') !!}
            {!! Form::select('genero', [null =>'SELECCIONE GENERO','M' => ' MASCULINO', 'F' => 'FEMENINO'], null, [
                'class' => 'form-control'
            ]) !!}
            @error('genero')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form group">
            {!! Form::label('direccion', 'Direccion:') !!}
            {!! Form::text('direccion', null, [ 'class' => 'form-control','placeholder' => 'Direccion del Usuario',]) !!}
            @error('direccion')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        {{-- <h2 class="h5">Listafo de roles</h2> --}}

<div class="form-group">
    {!! Form::label('roles', 'Rol:') !!}
    {!! Form::select('roles',$roles,null, ['class' => 'form-control']) !!}
</div>
{{-- ññññññññññññññññññññññññññ --}}
        {{-- <div class="form-group">
            {!! Form::hidden('id_rol', 'Rol:') !!}
            {!! Form::hidden('id_rol',$position,null, ['class' => 'form-control']) !!}
            @error('id_rol')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div> --}}

        <div class="form-group">
            @foreach ($cursos as $curso )
            {!! Form::hidden('id_curso',$curso,null, ['class' => 'form-control']) !!}
            @endforeach
        </div>

        <div class="form group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, [ 'class' => 'form-control','placeholder' => 'Email',]) !!}
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form group">
            {!! Form::label('password', 'Contraseña: ') !!}
            {!! Form::password('password',[ 'class' => 'form-control','placeholder' => 'Password']) !!}
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form group">
            {!! Form::label('estado_user', 'Estado:') !!}
            {!! Form::select('estado_user',[null => 'SELECCIONE ESTADO','0' => 'NO ACTIVO', '1' => 'ACTIVO'], null, [
                'class' => 'form-control',
            ]) !!}
            @error('estado_user')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <!--fin-->





{{-- @foreach ($roles as $role)
<div>
    <label>
        {!!Form::checkbox('roles[]', $role->id,null,  ['class' => 'mr-1']) !!}
        {{$role->name}}
    </label>
</div>
@endforeach --}}
