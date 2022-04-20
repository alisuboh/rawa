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
 * @property ExpenseItem[] $expenseItems
 */
class ExpenseCategory extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['paerant_id', 'description', 'is_active', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenseItems()
    {
        return $this->hasMany('App\Models\ExpenseItem', 'exp_cat_id');
    }
}
