<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $casts = ['days','area_ids','orders_ids',
    'customer_ids'];

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
        foreach (json_decode($this->area_ids) as $area_id) {
            $areas[] = $this->area($area_id)
                ->get();
        }
        return $areas;
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeArea($query, $area_id)
    {
        $query->where('area.id', $area_id)
            ->join('aeras', 'areas.id', '=', 'trips_scheduled.area_id')
            ->select('aeras.*');
    }

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

        return Attribute::make(

            get: fn ($value) => json_decode($value, true),

            set: fn ($value) => json_encode($value),

        );
    }

    protected function orders_ids(): Attribute
    {

        return Attribute::make(

            get: fn ($value) => json_decode($value, true),

            set: fn ($value) => json_encode($value),

        );
    }
}
