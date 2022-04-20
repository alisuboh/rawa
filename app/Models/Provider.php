<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property string $code
 * @property string $commercial_name
 * @property string $address_line_1
 * @property string $address_line_2
 * @property integer $city_id
 * @property string $status
 * @property string $image_name
 * @property float $location_lat
 * @property float $location_lng
 * @property string $logo_path
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $contact_mobile
 * @property boolean $has_branches
 * @property boolean $is_on_top_search
 * @property float $rate
 * @property string $created_at
 * @property string $updated_at
 * @property CustomerOrder[] $customerOrders
 * @property ProviderProduct[] $providerProducts
 * @property ProvidersSubscription[] $providersSubscriptions
 * @property Trip[] $trips
 */
class Provider extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['email', 'name', 'code', 'commercial_name', 'password', 'address_line_1', 'address_line_2', 'city_id', 'status', 'image_name', 'location_lat', 'location_lng', 'logo_path', 'contact_name', 'contact_phone', 'contact_mobile', 'has_branches', 'is_on_top_search', 'rate', 'created_at', 'updated_at'];

    // public $with = ['trip'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    const STATUS = [
        1 => 'Active',
        0 => 'InActive'

    ];
    public function customerOrders()
    {
        return $this->hasMany('App\Models\CustomerOrder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providerProducts()
    {
        return $this->hasMany('App\Models\ProviderProduct');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providersSubscriptions()
    {
        return $this->hasMany('App\Models\ProvidersSubscription');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trips()
    {
        return $this->hasMany('App\Models\Trip');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        // dd($this->hasOne(City::class,'id' ,'city_id'));
        return $this->hasOne(City::class, 'id', 'city_id');
        // return $this->belongsTo('App\Models\City');
    }

    // public function getCreatedAtAttribute($date)
    // {
    //     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d H:i:s');
    // }

    // public function getUpdatedAtAttribute($date)
    // {
    //     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d H:i:s');
    // }
}
