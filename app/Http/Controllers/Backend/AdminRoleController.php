<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminRoleController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('backend.admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('backend.admin.users.role', compact('user', 'roles', 'permissions'));
    }

    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('warning', 'Role exists.');
        }

        $user->assignRole($request->role);
        return back()->with('success', 'Role assigned.');
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('success', 'Role removed.');
        }

        return back()->with('warning', 'Role not exists.');
    }

    public function givePermission(Request $request, User $user)
    {
        if ($user->hasPermissionTo($request->permission)) {
            return back()->with('warning', 'Permission exists.');
        }
        $user->givePermissionTo($request->permission);
        return back()->with('success', 'Permission added.');
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->with('success', 'Permission revoked.');
        }
        return back()->with('warning', 'Permission does not exists.');
    }

    public function destroy(User $user)
    {
        if ($user->hasRole('super_admin')) {
            return back()->with('error', 'you are admin.');
        }
        $user->delete();

        return back()->with('success', 'User deleted.');
    }

}
