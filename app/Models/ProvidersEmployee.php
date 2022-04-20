<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $provider_id
 * @property integer $seq
 * @property string $full_name
 * @property string $phone_number
 * @property string $mobile_number
 * @property string $status
 * @property integer $type
 * @property string $created_at
 * @property string $updated_at
 */
class ProvidersEmployee extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['provider_id', 'seq', 'full_name', 'phone_number', 'mobile_number', 'status', 'type', 'created_at', 'updated_at'];
}
