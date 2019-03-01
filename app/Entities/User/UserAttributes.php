<?php
namespace App\Entities\User;

trait  UserAttributes{

    public function  profileImage(){
        return \Auth::user()->getFirstMedia('avatar')->getFullUrl();

    }
}
