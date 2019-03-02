<?php

namespace App\Entities\User;

trait  UserAttributes
{

    public function profileImage()
    {
        $profileImage = \Auth::user()->getFirstMedia('avatar');
        if (null !== $profileImage)  {
            return $profileImage->getFullUrl();
        }else{
            $profileImage = asset('assets/img/profile.jpg');
        }
        return $profileImage;
    }
}
