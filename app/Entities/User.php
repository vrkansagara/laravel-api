<?php

namespace App\Entities;

use App\Traits\ModelTraits;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Authenticatable implements Transformable, HasMedia
{
    use TransformableTrait;

    use Notifiable;

    use HasApiTokens;

    use ModelTraits;

    use HasRoles;

    use HasMediaTrait;

    protected $guard_name = 'api'; // or whatever guard you want to use

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['id', 'name', 'email','active','verify','created_at'];


    public function errors()
    {
        return $this->hasMany(Error::class);
    }


    // in your model

    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')
            ->singleFile();


    }

}
