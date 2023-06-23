<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Roles/Index', [
            'roles' => Role::with('permissions')->get(),
            'permissions' => $request->user()->getPermissionsViaRoles()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return Inertia::render('Roles/Create', [
            'roles' => Role::with('permissions')->get(),
            'permissions' => $request->user()->getPermissionsViaRoles(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {

        // retrieve the safely validated request payload
        $validated = $request->safe()->only(['name', 'permissions']);
        // fetch the permissions based off ids
        $permissions = Permission::find($validated['permissions'])->pluck('name');
        // create role
        $role = Role::create(['name' =>  $validated['name']]);
        // tie up all permissions to the newly created role
        $role->syncPermissions($permissions);

        // go back the the roles.index route
        return Redirect::route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {

            // Retrieve the validated input data...
            $validated = $request->validated();


            $role->name = $validated['name'];


            $role->save();

            // fetch the permissions based off ids
            $permissions = Permission::find($validated['permissions'])->pluck('name');

            $role->syncPermissions($permissions);

             // go back the the roles.index route
            return Redirect::route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if($role) {
            // Remove the role from all users
            User::role($role)->each(function($user) use ($role){
                $user->removeRole($role);
            });

            // Remove the permissions associated with the role
            $role->permissions()->detach();

            // delete the role
            $role->delete();
        }

        // go back the the roles.index route
        return Redirect::route('roles.index');
    }
}
