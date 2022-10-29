<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $customer_id
 * @property integer $seq
 * @property string $day
 * @property string $from_time
 * @property string $to_time
 * @property string $created_at
 * @property string $updated_at
 * @property Customer $customer
 */
class CustomerAvalability extends Model
{
    const DAY = [
        0 => 'All',
        1 => 'Sunday',
        2 => 'Monday',
        3 => 'Tuesday',
        4 => 'Wednesday',
        5 => 'Thursday',
        6 => 'Friday',
        7 => 'Saturday',

    ]; 
          
    const DAY_ARABIC = [
        'يوميا' => 0,
        'الاحد' => 1,
        'الاثنين' => 2,
        'الثلاثاء' => 3,
        'الاربعاء' => 4,
        'الخميس' => 5,
        'الجمعة' => 6,
        'السبت' => 7
    ];
    const DAY_ARABIC_NAME = [
         0 => 'يوميا' ,
         1 => 'الاحد' ,
         2 => 'الاثنين' ,
         3 => 'الثلاثاء' ,
         4 => 'الاربعاء' ,
         5 => 'الخميس' ,
         6 => 'الجمعة' ,
         7 => 'السبت' 
    ];
    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'seq', 'day', 'from_time', 'to_time', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
    public function getDayAttribute($value){
        return SELF::DAY_ARABIC_NAME[$value];
    }
}
