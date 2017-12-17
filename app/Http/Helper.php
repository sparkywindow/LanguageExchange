<?php

namespace App\Http;
use App\User;
class Helper
{
    public static function getProfilePictureUrlWithId(string $userId, $size = array("width" => 200, "height" => 200))
    {
        return User::getProfilePictureUrlWithId($userId, $size);
    }

    public static function getUserNameWithId(string $userId)
    {
        return User::getUserNameWithId($userId);
    }

}
