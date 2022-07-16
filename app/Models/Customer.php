<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * @var array
     */
    protected $fillable = ['name', 'user_name', 'mobile_number', 'email', 'password', 'has_branches', 'default_provider_id', 'can_recive_any_time', 'on_days', 'created_at', 'updated_at'];

    public $hidden = ['password'];
    // public function __construct($provider_id = null)
    // {
        // return false;
        // if($provider_id){
        //     $this->default_provider_id = $provider_id;
        //     self::where(['default_provider_id' => $provider_id]);
            
        // }
        
    // }
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
}
