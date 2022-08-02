<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $provider_id
 * @property integer $seq
 * @property string $full_name
 * @property string $phone_number
 * @property string $mobile_number
 * @property string $password
 * @property string $status
 * @property integer $type
 * @property string $created_at
 * @property string $updated_at
 */
class ProvidersEmployee extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['provider_id', 'seq', 'full_name', 'phone_number', 'mobile_number', 'status', 'type','password', 'created_at', 'updated_at'];
    const TYPE = [
        0 => '',
        1 => 'Driver',
        2 => 'Sales',
        3 => 'Worker',
   
    ];
    const ACTIVE = [
        1 => 'Active',
        0 => 'In Active',
    
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo('App\Models\Provider');
    }
    
}
