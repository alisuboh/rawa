<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $exp_cat_id
 * @property string $description
 * @property boolean $is_active
 * @property double $total_price
 * @property string $bond_no
 * @property string $transaction_date
 * @property string $code
 * @property string $created_at
 * @property string $updated_at
 * @property ExpenseCategory $expenseCategory
 */
class ExpenseItem extends Model
{
    CONST CODE = [
        
    ];
    /**
     * @var array
     */
    protected $fillable = ['exp_cat_id', 'description', 'provider_id','is_active', 'transaction_date','code','total_price','bond_no','created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expenseCategory()
    {
        return $this->belongsTo('App\Models\ExpenseCategory', 'exp_cat_id');
    }
}
