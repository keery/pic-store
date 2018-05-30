<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function formImage() {

        return view('form-add-image');
    }
    public function addImage(Request $request) {
        $file = $request->file('image');
        $src = uniqid().'.'.$file->getClientOriginalExtension();
        $val = [
            'titre' => $request->titre,
            'description' => $request->description,
            'src' => $src,
        ];

        $file->move(resource_path('assets/upload'), $src);
        $img = Image::create($val);

        return back()->with('success', 'complete');
    }
}
