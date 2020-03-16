<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:edit articles']);
    }

    public function index(): View
    {
        return view('admin.index', [
            'user' => Auth::user(),
            'userCount' => User::count()
        ]);
    }

    public function users(): View
    {
        $users = User::with('roles')->paginate(25);

        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function roles(): View
    {
        $roles = Role::all();

        return view('admin.roles.index', [
            'roles' => $roles
        ]);
    }

    public function editRole(string $roleName)
    {
        $role = Role::with('permissions')->where('name', $roleName)->firstOrFail();
        $permissions = Permission::all();

        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    /**
     * @param string $loginName
     * @return View
     */
    public function editUser(string $loginName): View
    {
        $user = User::with('roles')->where('login_name', $loginName)->firstOrFail();
        $roles = Role::all();

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * @param string $loginName
     * @param Request $request
     */
    public function editUserRoles(string $loginName, Request $request): void
    {
        $user = User::where('login_name', $loginName)->firstOrFail();

        $user->syncRoles($request->get('roles'));
        $user->save();
    }
}
