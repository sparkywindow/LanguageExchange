<?php

namespace App\Http;
use App\User;
class Helper
{
    /**
     * Retrieves the Profile Picture with the user's unique id
     *
     * @param int $userId
     * @param array $size
     * @return string
     */
    public static function getProfilePictureUrlWithId(int $userId, $size = array("width" => 200, "height" => 200))
    {
        return User::getProfilePictureUrlWithId($userId, $size);
    }

    public static function getUserNameWithId(int $userId)
    {
        return User::getUserNameWithId($userId);
    }

}
