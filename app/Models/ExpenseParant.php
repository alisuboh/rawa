<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $name
 * @property string $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property ExpenseCategory $expenseCategory
 */
class ExpenseParant extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'created_by', 'created_at', 'updated_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenseCategory()
    {
        return $this->hasMany('App\Models\ExpenseCategory', 'parant_id','id');
    }
}
