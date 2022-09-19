<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';
    protected $primaryKey = 'id';

    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'provider_id',
        'supplier_id',
        'price',
        'tax',
        'discount',
        'total_price'
    ];

    protected $casts = [];

    /**
     * @return Relation
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchasesDetail()
    {
        return $this->hasMany('App\Models\PurchasesDetail', 'purchas_id', 'id');
    }

    public function setInvoiceDateAttribute($value)
    {
        $this->attributes['invoice_date'] = date('Y-m-d', strtotime($value));
    }
    // public function getInvoiceDateAttribute($value)
    // {
    //     $this->attributes['invoice_date'] = strtotime($value);
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id');
    }

}
