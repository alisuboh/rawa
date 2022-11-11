<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Log;

class TripsScheduled extends Model
{
    use HasFactory;

    protected $table = 'trips_scheduled';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'provider_id',
        'orders_ids',
        'customer_ids',
        'driver_id',
        'delivery_date',
        'days',
        'status',
        'note',
        'app_source',
        'city_id',
        'area_ids'
    ];

    protected $casts = [
        'days' => 'array',
        'area_ids' => 'array',
        'orders_ids' => 'array',
        'customer_ids' => 'array'
    ];

    /**
     * @return Relation
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }
    //  /**
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    public function getArea()
    {
        $areas = [];
        foreach ($this->area_ids as $area_id) {
            $areas[] = Area::find($area_id);
        }
        return $areas;
    }

        /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver()
    {
        return $this->belongsTo('App\Models\ProvidersEmployee', 'driver_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    // public function scopeArea($query, $area_id)
    // {
    //     $query->where('areas.id', $area_id);
    //         // ->join('areas', 'areas.id', '=', 'trips_scheduled.area_id')
    //         // ->select('areas.*');
    // }

    protected function customer_ids(): Attribute
    {

        return Attribute::make(

            get: fn ($value) => json_decode($value, true),

            set: fn ($value) => json_encode($value),

        );
    }


    protected function area_ids(): Attribute
    {

        return Attribute::make(

            get: fn ($value) => json_decode($value, true),

            set: fn ($value) => json_encode($value),

        );
    }

    protected function days(): Attribute
    {

        $days = Attribute::make(

            get: fn ($value) => json_decode($value, true),

            set: fn ($value) => json_encode($value),

        );
        return $days;
    }

    protected function orders_ids(): Attribute
    {

        return Attribute::make(

            get: fn ($value) => json_decode($value, true),

            set: fn ($value) => json_encode($value),

        );
    }
}
