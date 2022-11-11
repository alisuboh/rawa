<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property boolean $active
 * @property integer $order
 * @property string $code
 * @property string $created_at
 * @property string $updated_at
 */
class City extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'city';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'active', 'order', 'code', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function area()
    {
        return $this->hasMany(Area::class,'city_id','id');
    }
}
