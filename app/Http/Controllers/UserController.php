<?php

namespace App\Http\Controllers;

use App\Helpers\UserHelper;
use App\Http\Requests\UserRequest;
use App\Models\RoleModel;

class UserController extends Controller
{
    protected $userHelper;

    public function __construct(UserHelper $userHelper)
    {
        $this->userHelper = $userHelper;
    }

    /**
     * Menampilkan daftar user dengan paginate max 10.
     */
    public function index()
    {
        // Menggunakan method non-static via $this->userHelper
        $users = $this->userHelper->getAllUsers(10);

        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Menampilkan form tambah user dan membawa data roles untuk dropdown.
     */
    public function create()
    {
        $roles = RoleModel::all();

        return view('admin.pages.users.create', compact('roles'));
    }

    /**
     * Menyimpan user baru berdasarkan payload.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        // Encrypt password sebelum disimpan
        $validated['password'] = bcrypt($validated['password']);

        $this->userHelper->storeUser($validated);

        return redirect()->route('admin-users-index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Merubah user baru berdasarkan payload.
     */
    public function update(UserRequest $request, $id)
    {
        $validated = $request->validated();

        if (! empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $this->userHelper->updateUser($id, $validated);

        return redirect()->route('admin-users-index')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Menampilkan form edit user berdasarkan ID.
     */
    public function edit($id)
    {
        $user = $this->userHelper->getUserById($id);

        $roles = RoleModel::all();

        return view('admin.pages.users.update', compact('user', 'roles'));
    }

    /**
     * Menghapus user.
     */
    public function destroy($id)
    {
        // Menggunakan method non-static via $this->userHelper
        $this->userHelper->deleteUser($id);

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil dihapus',
        ]);
    }
}
