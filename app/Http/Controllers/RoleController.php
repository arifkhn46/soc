<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Role;

class RoleController extends Controller
{
    /**
     * Store a newly created task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:roles']);

        Role::create($request->only('name'));

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
}
