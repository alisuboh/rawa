<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $paerant_id
 * @property string $description
 * @property boolean $is_active
 * @property string $created_at
 * @property string $updated_at
 * @property RevenueItem[] $revenueItems
 */
class RevenueCategory extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['paerant_id', 'description', 'is_active', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revenueItems()
    {
        return $this->hasMany('App\Models\RevenueItem', 'rev_cat_id');
    }
}
