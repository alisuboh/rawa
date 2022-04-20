<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $provider_id
 * @property integer $seq
 * @property string $name
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $contact_mobile
 * @property string $address_line_1
 * @property string $address_line_2
 * @property integer $city_id
 * @property string $status
 * @property float $location_lat
 * @property float $location_lng
 * @property string $created_at
 * @property string $updated_at
 */
class ProvidersBranch extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['provider_id', 'seq', 'name', 'contact_name', 'contact_phone', 'contact_mobile', 'address_line_1', 'address_line_2', 'city_id', 'status', 'location_lat', 'location_lng', 'created_at', 'updated_at'];
}
