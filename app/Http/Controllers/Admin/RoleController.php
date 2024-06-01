<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.permisos.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('admin.permisos.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
'name' => 'required|unique:roles,name',
'estado_rol' => 'required',
        ]);

        $role = Role::create(['name' => strtoupper($request->name), 'estado_rol' => $request->estado_rol ]);


        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.permisos.index')->with('mensaje','Rol Creado');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('admin.permisos.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role,$id)
    {


        $permissions = Permission::all();
$role = Role::find($id);
        return view('admin.permisos.edit',compact('role','permissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role, $id)
    {
        $role = Role::find($id);
        $role ->name = strtoupper($request->name);
        $role->estado_rol = $request->estado_rol;
        $role->update($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.permisos.index')->with('mensaje','Rol Actualizado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role,$id)
    {
$role = Role::find($id);
        $role->delete();
        return redirect()->route('admin.permisos.index')->with('mensaje','Rol Eliminado');

    }
}
