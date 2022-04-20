<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $role_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class AdminRoleUsers extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['role_id', 'user_id', 'created_at', 'updated_at'];
}
