<?php

namespace App;

class Guest extends User
{
    const GUEST_ID = 0;

    function __construct() {
        $this->id = Guest::GUEST_ID;
        $this->name = 'Guest';
        $this->nativeLanguage = 'English';
        $this->learningLanguage = 'Korean';
        $this->city = 'Seoul';
    }

    public function isGuest() {

        return true;
    }
}
