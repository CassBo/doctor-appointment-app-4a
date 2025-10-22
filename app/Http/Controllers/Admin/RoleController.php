<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupera todos los roles de la base de datos
        $roles = Role::all();
        // Devuelve la vista para mostrar la lista de roles, pasándole los roles recuperados
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Devuelve la vista con el formulario para crear un nuevo rol
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida que el campo 'name' sea requerido y único en la tabla 'roles'
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        // Crea el nuevo rol en la base de datos
        Role::create($request->all());

        // Redirige al listado de roles con un mensaje de éxito
        return redirect()->route('admin.roles.index')->with('info', 'El rol se creó con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        // Devuelve la vista para mostrar los detalles de un rol específico
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        // Devuelve la vista con el formulario para editar un rol
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // Valida que el campo 'name' sea requerido y único (ignorando el rol actual)
        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id
        ]);

        // Actualiza el rol
        $role->update($request->all());

        // Redirige al listado de roles con un mensaje de éxito
        return redirect()->route('admin.roles.index')->with('info', 'El rol se actualizó con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Elimina el rol
        $role->delete();

        // Redirige al listado de roles con un mensaje de éxito
        return redirect()->route('admin.roles.index')->with('info', 'El rol se eliminó con éxito.');
    }
}