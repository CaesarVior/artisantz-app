<?php

namespace App\Helpers;

use App\Models\RoleModel;

class RoleHelper
{
    /**
     * Mengambil daftar role dengan pagination.
     */
    public function getAllRoles($perPage = 10)
    {
        return RoleModel::paginate($perPage);
    }

    /**
     * Mengambil data role berdasarkan ID.
     */
    public function getRoleById($id)
    {
        return RoleModel::findOrFail($id);
    }

    /**
     * Menyimpan role baru.
     */
    public function storeRole(array $data)
    {
        return RoleModel::create($data);
    }

    /**
     * Mengupdate data role berdasarkan ID.
     */
    public function updateRole($id, array $data)
    {
        $role = $this->getRoleById($id);
        $role->update($data);

        return $role;
    }

    /**
     * Menghapus role berdasarkan ID.
     */
    public function deleteRole($id)
    {
        $role = $this->getRoleById($id);

        return $role->delete();
    }
}
