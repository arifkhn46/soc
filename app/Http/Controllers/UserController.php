<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Role;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->get();

        $roles = Role::all();

        return view('users.index', ['users' => $users, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $same_email = $user->email == $request->get('email');

        $validations = [
            'name' => 'bail|required|min:2',
            'email' => 'required|email' . ($same_email ? '': '|unique:users,email'),
            'roles' => 'required|min:1'
        ];

        $this->validate($request, $validations);

        // Update user
        $user->fill($request->except('roles', 'permissions', 'password'));

        // check for password change
        if($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }

        // Handle the user roles
        $this->syncPermissions($request, $user);

        $user->save();

        
        return (new UserResource($user))
                ->additional([
                    'message' => $user->name . ' updated!',
                ]);
    }


    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if( ! $user->hasAllRoles( $roles ) ) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);
        return $user;
    }
}
