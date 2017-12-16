<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Auth;

class ImageController extends Controller
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
     * 
     * @return \Illuminate\Http\Response
     */
    public function uploadPage()
    {
        return view('uploadPage');
    }

    /**
    * Manage Post Request
    *
    * 
    */
    // get image from upload-image page 
    public function postProfileImage(Request $request)
    {
        $this->validate($request, [
        // check validtion for image or file
            'uplode_image_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $imagePath = "images/" . Auth::user()->id . '.png';

        imagepng(imagecreatefromstring(
                    file_get_contents(
                        $request->uplode_image_file
                    )), 
                    $imagePath
                );
                
        return redirect()
            ->to('/preferenceTab')
            ->with('success','Profile image has been updated successfully.');
    }

}
