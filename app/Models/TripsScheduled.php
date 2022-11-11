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
 'app_source',
 'city_id',
 'area_ids'
    ];

    protected $casts = [

    ];

    /**
     * @return Relation
     */
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id','id');
    }
    //  /**
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    public function getArea()
    {
        $areas = [];
        foreach(json_decode($this->area_ids) as $area_id){
            $areas []= $this->area($area_id)
            ->get();
        }
        return $areas;    
    }

        /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeArea($query,$area_id){
        $query->where('area.id',$area_id)
        ->join('aeras','areas.id','=','trips_scheduled.area_id')
        ->select('aeras.*');
    }
}
