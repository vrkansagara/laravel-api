<?php

namespace App\Entity\Blog;

use Illuminate\Database\Eloquent\Model;


class Blog extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'keywords',
        'slug',
        'content',
        'canonical_link',
        'status',
        'featured_image',
        'publish_at',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [];
}

