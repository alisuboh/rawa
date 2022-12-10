<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class RejectReason extends Model
{
    use HasFactory;

    protected $table = 'reject_reason';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'reason',
        'active'
    ];

    protected $casts = [

    ];

    /**
     * @return Relation
     */
}
