<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $exp_cat_id
 * @property string $description
 * @property boolean $is_active
 * @property string $created_at
 * @property string $updated_at
 * @property ExpenseCategory $expenseCategory
 */
class ExpenseItem extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['exp_cat_id', 'description', 'provider_id','is_active', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expenseCategory()
    {
        return $this->belongsTo('App\Models\ExpenseCategory', 'exp_cat_id');
    }
}
