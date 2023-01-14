<?php

namespace App\Models;

use Encore\Admin\Form\Field\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class WebPermission extends Model
{
    use HasFactory;

    protected $table = 'web_permission';
    protected $primaryKey = 'id';

    protected $fillable = [
'slug',
 'name',
 'route',
 'role_id'
    ];

    protected $casts = [
        'role_id' => 'array'
    ];

    /**
     * @return Relation
     */

      /**
     * A user has and belongs to many roles.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        $pivotTable = config('admin.database.role_users_table');

        $relatedModel = config('admin.database.roles_model');

        return $this->belongsToMany($relatedModel, $pivotTable, 'user_id', 'role_id');
    }
}
