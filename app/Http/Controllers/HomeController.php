<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Tag;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function formImage() {
        $tags = Tag::all('name');
        return view('form-add-image', compact('tags'));
    }
    public function addImage(Request $request) {

        $file = $request->file('image');
        $src = uniqid().'.'.$file->getClientOriginalExtension();
        $file->move(resource_path('assets/upload'), $src);
        $val = [
            'titre' => $request->titre,
            'description' => $request->description,
            'src' => $src
        ];
        
        $img = Image::create($val);
        
        $tags = explode(',',$request->tags);

        if( count($tags) > 0 ) {
            $idsTags = [];
            foreach ($tags as $tag) {
                if(!$existingTags = Tag::where('name', $tag)->first()) {
                    $existingTags = new Tag();
                    $existingTags->name = $tag;
                    $existingTags->slug = $tag;
                    $existingTags->save();
                }
                $idsTags[] = $existingTags->id;
            }

            $img->tags()->sync($idsTags);
        }

        return back()->with('success', 'complete');
    }
}
