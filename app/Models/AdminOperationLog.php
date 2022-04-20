<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $path
 * @property string $method
 * @property string $ip
 * @property string $input
 * @property string $created_at
 * @property string $updated_at
 */
class AdminOperationLog extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'admin_operation_log';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'path', 'method', 'ip', 'input', 'created_at', 'updated_at'];
}
