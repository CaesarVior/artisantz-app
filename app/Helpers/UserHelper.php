<?php

namespace App\Helpers;

use App\Models\UserModel;

class UserHelper
{
    public function getAllUsers($perPage = 10)
    {
        return UserModel::with('role')->paginate($perPage);
    }

    public function getUserById($id)
    {
        return UserModel::findOrFail($id);
    }

    public function storeUser(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        return UserModel::create($data);
    }

    public function updateUser($id, array $data)
    {
        $user = UserModel::findOrFail($id);

        if (! empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return $user;
    }

    public function deleteUser($id)
    {
        $user = UserModel::findOrFail($id);

        return $user->delete();
    }
}
