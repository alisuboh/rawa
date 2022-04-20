<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $rev_cat_id
 * @property string $description
 * @property boolean $is_active
 * @property string $created_at
 * @property string $updated_at
 * @property RevenueCategory $revenueCategory
 */
class RevenueItem extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['rev_cat_id', 'description', 'is_active', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function revenueCategory()
    {
        return $this->belongsTo('App\Models\RevenueCategory', 'rev_cat_id');
    }
}
