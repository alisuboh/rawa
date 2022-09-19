<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'phone',
        'address',
        'description',
        'type',
        'provider_id'
    ];
    const TYPE = [
        1 => 'تنك مياه',
        2 => 'مواد خام',
    ];

    protected $casts = [];

    /**
     * @return Relation
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo('App\Models\Provider');
    }

}
