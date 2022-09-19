<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class PurchasesDetail extends Model
{
    use HasFactory;

    protected $table = 'purchases_details';
    protected $primaryKey = 'id';

    protected $fillable = [
        'purchas_id',
        'description',
        'unit_price',
        'quantity',
        'tax',
        'discount',
        'total_price',
        'note'
    ];

    protected $casts = [];

    /**
     * @return Relation
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchase()
    {
        return $this->belongsTo('App\Models\Purchase', 'purchas_id');
    }
}
