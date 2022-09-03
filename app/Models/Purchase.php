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
}
