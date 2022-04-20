<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $role_id
 * @property integer $menu_id
 * @property string $created_at
 * @property string $updated_at
 */
class AdminRoleMenu extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'admin_role_menu';

    /**
     * @var array
     */
    protected $fillable = ['role_id', 'menu_id', 'created_at', 'updated_at'];
}
