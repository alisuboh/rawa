<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class TripsScheduled extends Model
{
    use HasFactory;

    protected $table = 'trips_scheduled';
    protected $primaryKey = 'id';

    protected $fillable = [
'name',
 'provider_id',
 'orders_ids',
 'customer_id',
 'driver_id',
 'delivery_date',
 'days',
 'status',
 'note',
 'app_source'
    ];

    protected $casts = [

    ];

    /**
     * @return Relation
     */
}
