<?php

namespace App\Http\Controllers;

// use App\Models\Role;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('name')->get();

        return view('roles.index', compact([
            'roles'
        ]));
    }

    public function create()
    {
        $permissions = Permission::orderBy('name')->get();

        return view('roles.create', compact([
            'permissions'
        ]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'permissions.*'=>'required|integer|exists:permissions,id',
        ]);

        $newRole = Role::create([
            // создаем роль с названием переданным в $request
            'name'=>$request->name
        ]);
        //присваиваем все права доступа переменной permissions
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $newRole->syncPermissions($permissions);

        return redirect()->back()->with('status', 'Role added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
