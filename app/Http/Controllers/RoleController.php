<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $roles = Role::where('name', '!=', config('permission.consts.super_admin_name'))->get();

        return view('admin.roles.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $permissions = Permission::all();

        return view('admin.roles.create', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return RedirectResponse
     */
    public function store(RoleRequest $request): RedirectResponse
    {
        $role = Role::create([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);

        if ($request->get('permissions')) {
            foreach ($request->get('permissions') as $permissionId) {
                $permission = Permission::findOrFail((int)$permissionId);

                $role->givePermissionTo($permission);
            }
        }

        return redirect()->route('admin.roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $roleName
     * @return View|RedirectResponse
     */
    public function edit(string $roleName)
    {
        if ($roleName === config('permission.consts.super_admin_name')) {
            return redirect()->route('admin.roles');
        }
        $role = Role::with('permissions')->where('name', $roleName)->firstOrFail();
        $permissions = Permission::all();

        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $roleName
     * @param Request $request
     * @return void
     */
    public function update(string $roleName, Request $request)
    {
        $role = Role::where('name', $roleName)->firstOrFail();

        $role->syncPermissions($request->get('permissions'));
    }
}
