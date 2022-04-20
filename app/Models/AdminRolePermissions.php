<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $role_id
 * @property integer $permission_id
 * @property string $created_at
 * @property string $updated_at
 */
class AdminRolePermissions extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['role_id', 'permission_id', 'created_at', 'updated_at'];
}
