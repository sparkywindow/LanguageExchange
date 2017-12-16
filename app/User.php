<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const GUEST_PROFILE_PICTURE_URL = "/images/Guest.png";
    const userWithNoFacebookAccount = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'nickName',
        'profileImage',
        'nativeLanguage',
        'learningLanguage',
        'city',
        'numberOfActions',
        'numberOfBestAnswers',
        'numberOfFavorites',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function facebookPageUrl() {

        return "http://facebook.com/" . $this->getFacebookId();
    }

    public function isGuest() {

        return false;
    }

    public function languageList() {
        
        return array(
            'Spanish' => 'Spanish', 
            'English' => 'English', 
            'Korean' => 'Korean'
        );
    }

    public function cityList() {
        
        return array(
            'Seoul' => 'Seoul', 
            'New York' => 'New York', 
            'Manila' => 'Manila'
        );
    }

    public function getProfilePictureUrl() {

        if($this->getFacebookId() === User::userWithNoFacebookAccount)
            return User::GUEST_PROFILE_PICTURE_URL;

        return "http://graph.facebook.com/" . $this->getFacebookId() . "/picture";
    }

    private function getFacebookId() {

        $facebookAccount = DB::table('social_facebook_accounts')->where('user_id', $this->id)->first();

        if(isset($facebookAccount))
            return $facebookAccount->provider_user_id;
        else
            return User::userWithNoFacebookAccount;
    }
}