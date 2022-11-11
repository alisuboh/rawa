<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Area extends Model
{
    use HasFactory;

    protected $table = 'areas';
    protected $primaryKey = 'id';

    protected $fillable = [
'name',
 'active',
 'code',
 'order',
 'city_id'
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

}
