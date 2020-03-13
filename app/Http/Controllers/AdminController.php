<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:edit articles']);
    }

    public function index()
    {
        return view('admin.index', [
            'user' => Auth::user(),
            'userCount' => User::count()
        ]);
    }

    public function users()
    {
        $users = User::with('roles')->paginate(25);

        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function editUser(string $loginName)
    {
        $user = User::with('roles')->where('login_name', $loginName)->firstOrFail();
        $roles = Role::all();

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }
}
