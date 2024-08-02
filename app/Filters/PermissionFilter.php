<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PermissionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $userId = $session->get('user_id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        // Verificar permisos
        $userRoleModel = new \App\Models\UserRoleModel();
        $roleModel = new \App\Models\RoleModel();

        // Obtener roles del usuario
        $roles = $userRoleModel->where('user_id', $userId)->findAll();
        $roleIds = array_column($roles, 'role_id');

        // Obtener permisos de los roles
        $db = \Config\Database::connect();
        $builder = $db->table('role_permissions');
        $builder->select('permissions.name');
        $builder->join('permissions', 'role_permissions.permission_id = permissions.id');
        $builder->whereIn('role_permissions.role_id', $roleIds);
        $permissions = $builder->get()->getResultArray();

        $permissionNames = array_column($permissions, 'name');

        // Verificar si el usuario tiene el permiso requerido
        if (!in_array($arguments[0], $permissionNames)) {
            return redirect()->to('/no_permission');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se necesita implementar
    }
}