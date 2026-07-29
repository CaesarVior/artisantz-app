<?php

namespace App\Http\Controllers;

use App\Helpers\RoleHelper;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    protected $roleHelper;

    public function __construct(RoleHelper $roleHelper)
    {
        $this->roleHelper = $roleHelper;
    }

    public function index()
    {
        $roles = $this->roleHelper->getAllRoles(10);

        return view('admin.pages.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.pages.roles.create');
    }

    public function store(RoleRequest $request)
    {
        $validated = $request->validated();

        $this->roleHelper->storeRole($validated);

        return redirect()->route('admin-roles-index')->with('success', 'Role berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $role = $this->roleHelper->getRoleById($id);

        return view('admin.pages.roles.update', compact('role'));
    }

    public function update(RoleRequest $request, $id)
    {
        $validated = $request->validated();

        $this->roleHelper->updateRole($id, $validated);

        return redirect()->route('admin-roles-index')->with('success', 'Role berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $this->roleHelper->deleteRole($id);

        return redirect()->route('admin-roles-index')->with('success', 'Role berhasil dihapus!');
    }
}
