<?php
namespace App\Models;

use CodeIgniter\Model;

class UserRoleModel extends Model
{
    protected $table = 'user_roles';
    protected $primaryKey = ['user_id', 'role_id'];
    protected $allowedFields = ['user_id', 'role_id'];
}