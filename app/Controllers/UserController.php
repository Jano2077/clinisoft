<?php
namespace App\Controllers;

use App\Models\UserRoleModel;
use App\Models\RoleModel;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function assignRole($userId, $roleId)
    {
        $userRoleModel = new UserRoleModel();
        $data = [
            'user_id' => $userId,
            'role_id' => $roleId,
        ];
        $userRoleModel->insert($data);
        return redirect()->back()->with('message', 'Role asignado satifactoriamente');
    }

    public function removeRole($userId, $roleId)
    {
        $userRoleModel = new UserRoleModel();
        $userRoleModel->where(['user_id' => $userId, 'role_id' => $roleId])->delete();
        return redirect()->back()->with('message', 'Rol removido Satisfactoriamente');
    }
}