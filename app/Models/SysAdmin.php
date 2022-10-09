<?php

namespace App\Models;

use Encore\Admin\Auth\Database\HasPermissions;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
// use Spatie\Permission\Traits\HasRoles;

/**
 * @property integer $id
 * @property string $user_name
 * @property string $email
 * @property string $password
 * @property boolean $active
 * @property string $full_name
 * @property integer $provider_id
 * @property string $auth_key
 * @property string $phone_number
 * @property string $created_at
 * @property string $updated_at
 */
/**
 * Class Administrator.
 *
 * @property Role[] $roles
 */
class SysAdmin extends Model implements AuthenticatableContract,AuthorizableContract
{
    use Authenticatable;
    use HasPermissions;
    use DefaultDatetimeFormat;
    use HasApiTokens;
    // use HasRoles;

    /**
     * @var array
     */
    protected $fillable = [ 'username', 'email', 'password', 'active', 'name', 'provider_id', 'auth_key', 'phone_number', 'avatar', 'remember_token','api_token', 'created_at', 'updated_at'];
    public $hidden = ['password','api_token'];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable(config('admin.database.users_table'));

        parent::__construct($attributes);
    }

    /**
     * Get avatar attribute.
     *
     * @param string $avatar
     *
     * @return string
     */
    public function getAvatarAttribute($avatar)
    {
        
        if (url()->isValidUrl(App::make('url')->to(Storage::url($avatar)))) {
            return $avatar;
        }

        $disk = config('admin.upload.disk');

        if ($avatar && array_key_exists($disk, config('filesystems.disks'))) {
            return Storage::disk(config('admin.upload.disk'))->url($avatar);
        }

        $default = config('admin.default_avatar') ?: '/vendor/laravel-admin/AdminLTE/dist/img/user2-160x160.jpg';

        return admin_asset($default);
    }

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

    /**
     * A User has and belongs to many permissions.
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        $pivotTable = config('admin.database.user_permissions_table');

        $relatedModel = config('admin.database.permissions_model');

        return $this->belongsToMany($relatedModel, $pivotTable, 'user_id', 'permission_id');
    }
}
