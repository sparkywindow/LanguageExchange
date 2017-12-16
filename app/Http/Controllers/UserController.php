<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Manage Post Request
    *
    * 
    */
    // get image from upload-image page 
    public function updateUser(Request $request)
    {
        $this->validate($request, [
            'nativeLanguage' => 'required|max:100',
            'learningLanguage' => 'required|max:100',
            'city' => 'required|max:100',
        ]);

        $user = array(
            'nativeLanguage' => $request->nativeLanguage,
            'learningLanguage' => $request->learningLanguage,
            'city' => $request->city,
        );

        User::find(Auth::user()->id)->update($user);

        return redirect()
            ->to('/users/profile/me')
            ->with('success', 'Profile has been successfully updated');

    }

}