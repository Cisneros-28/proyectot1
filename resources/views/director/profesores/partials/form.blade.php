 <!--inicio-->
 <div class="form group">
    {!! Form::label('nombre_user', 'Nombres:') !!}
    {!! Form::text('nombre_user', null, [
        'class' => 'form-control',
        'placeholder' => 'Nombre Completo del Profesor',
    ]) !!}
    @error('nombre_user')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form group">
    {!! Form::label('apellido_user', 'Apellidos:') !!}
    {!! Form::text('apellido_user', null, [
        'class' => 'form-control',
        'placeholder' => 'Apellido Completo del Profesor',
    ]) !!}
    @error('apellido_user')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form group">
    {!! Form::label('genero', 'Genero:') !!}
    {!! Form::select('genero', [null => 'SELECCIONE GENERO','M' => ' MASCULINO', 'F' => 'FEMENINO'], null, [
        'class' => 'form-control',
    ]) !!}
    @error('genero')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form group">
    {!! Form::label('direccion', 'Direccion:') !!}
    {!! Form::text('direccion', null, [ 'class' => 'form-control','placeholder' => 'Direccion del Profesor',]) !!}
    @error('direccion')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('roles', 'Rol:') !!}
    {!! Form::select('roles',$roles,null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('id_curso', 'Curso:') !!}
    {!! Form::select('id_curso',$cursos,null, ['class' => 'form-control']) !!}
    @error('id_curso')
    <small class="text-danger">{{ $message }}</small>
@enderror
</div>
<div class="form group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, [ 'class' => 'form-control','placeholder' => 'Email',]) !!}
    @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="form group">
    {!! Form::label('password', 'Contraseña:') !!}
    {!! Form::password('password',[ 'class' => 'form-control','placeholder' => 'Password',]) !!}
    @error('password')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form group">
    {!! Form::label('estado_user', 'Estado:') !!}
    {!! Form::select('estado_user',[null => 'SELECCIONE ESTADO', '0' => 'NO ACTIVO', '1' => 'ACTIVO'], null, [
        'class' => 'form-control',
    ]) !!}
    @error('estado_user')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<!--fin-->
