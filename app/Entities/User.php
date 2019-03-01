<?php

namespace App\Entities;

use App\Entities\User\UserAttributes;
use App\Traits\ModelTraits;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\File;
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

    use UserAttributes;

    protected $guard_name = 'web'; // or whatever guard you want to use

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
    protected $visible = ['id', 'name', 'email', 'active', 'verify', 'created_at'];


    public function errors()
    {
        return $this->hasMany(Error::class);
    }


    // in your model

    public function registerMediaCollections(Media $media = null)
    {
        $this->addMediaCollection('avatar')
            ->acceptsFile(function (File $file) {
                return $file->mimeType === 'image/jpeg';
            })
            ->singleFile();

        $this->addMediaConversion('thumb')->width(40)->height(40)->sharpen(10);
        $this->addMediaConversion('email')->width(100)->height(100)->performOnCollections('logo');
        $this->addMediaConversion('base')->width(225)->height(225)->performOnCollections('logo');


    }

}
