<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $user_id
 * @property integer $permission_id
 * @property string $created_at
 * @property string $updated_at
 */
class AdminUserPermissions extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'permission_id', 'created_at', 'updated_at'];
}
