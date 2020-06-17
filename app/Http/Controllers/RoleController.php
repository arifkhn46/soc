<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Role;
use App\Model\Permission;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::where('name', '!=', \getSuperAdminRoleName())->with('permissions')->get();
        $permissions = Permission::all();
        return view('role.index', ['roles' => $roles, 'permissions' => $permissions]);
    }

    /**
     * Store a newly created task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roleData = $this->validate($request, ['name' => 'required|unique:roles']);
        $roleData['guard_name'] = 'web';

        $role = Role::create($roleData);

        if ($request->wantsJson()) {
            return (new RoleResource($role))
                    ->response()
                    ->setStatusCode(Response::HTTP_CREATED);
        }

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name', '!=', \getSuperAdminRoleName())->get();
        return view('role.create', ['roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
       $permissions = $request->validate([
           'permissions' => 'required|exists:permissions,name',
       ]);

       $role->syncPermissions($permissions);

       return response()
                ->json(['message' => 'Permissions synced!',]);
    }
    
}
