<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $parant_id
 * @property string $description
 * @property boolean $is_active
 * @property string $created_at
 * @property string $updated_at
 * @property RevenueItem[] $revenueItems
 */
class RevenueCategory extends Model
{
    use HasFactory;

    const ACTIVE = [
        1 => 'Active',
        0 => 'In Active',
    
    ];
    /**
     * @var array
     */
    protected $fillable = ['parant_id', 'description', 'is_active', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revenueItems()
    {
        return $this->hasMany('App\Models\RevenueItem', 'rev_cat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function revenueParant()
    {
        return $this->belongsTo('App\Models\RevenueParant', 'parant_id','id');
    }
}
