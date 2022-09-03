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

    protected $casts = [];

    /**
     * @return Relation
     */
}
