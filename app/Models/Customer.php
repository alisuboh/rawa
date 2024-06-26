<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property integer $id
 * @property string $name
 * @property string $user_name
 * @property string $mobile_number
 * @property string $email
 * @property string $password
 * @property boolean $has_branches
 * @property integer $default_provider_id
 * @property boolean $can_recive_any_time
 * @property string $on_days
 * @property string $created_at
 * @property string $updated_at
 * @property CustomerAvalability[] $customerAvalabilities
 * @property CustomerOrder[] $customerOrders
 * @property CustomersAddress[] $customersAddresses
 */
class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * @var array
     */
    protected $fillable = ['name', 'user_name', 'mobile_number', 'email', 'password', 'has_branches', 'default_provider_id', 'can_recive_any_time', 'on_days','location_lat', 'location_lng', 'address_description','seq','city_id','area_id', 'created_at', 'updated_at'];

    public $hidden = ['password'];
    // public function __construct($provider_id = null)
    // {
        // return false;
        // if($provider_id){
        //     $this->default_provider_id = $provider_id;
        //     self::where(['default_provider_id' => $provider_id]);
            
        // }
        
    // }
    const ACTIVE = [
        1 => 'Active',
        0 => 'In Active',
    
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customerAvalabilities()
    {
        return $this->hasMany('App\Models\CustomerAvalability');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customerOrders()
    {
        return $this->hasMany('App\Models\CustomerOrder');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customersAddresses()
    {
        return $this->hasMany('App\Models\CustomersAddress');
    }

       /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function provider()
    {
        return $this->hasOne('App\Models\Provider','id','default_provider_id');
    }


     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
        // return $this->belongsTo('App\Models\City');
    }
     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->hasOne(Area::class, 'id', 'area_id');
        // return $this->belongsTo('App\Models\Area');
    }

    public function getLastSeq(){
        $last = SELF::where('default_provider_id',auth()->user()->provider_id)->max('seq')??0;
        return ($last + 1);
    }

    public static function  getLastSeqNumber(){
        $last = SELF::where('default_provider_id',auth()->user()->provider_id)->max('seq')??0;
        return ($last + 1);
    }
}
