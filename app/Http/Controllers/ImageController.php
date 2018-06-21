<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Tag;

use Auth;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function formImage() {
        $tags = Tag::all('name');
        return view('form-add-image', compact('tags'));
    }

    public function addImage(Request $request) {
        $request->validate([
            'titre' => 'required|max:255',
            'image' => 'required',
        ]);

        $file = $request->file('image');
        $src = uniqid().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('upload'), $src);
        // $val = [
        //     'titre' => $request->titre,
        //     'description' => $request->description,
        //     'src' => $src
        // ];
        
        // $img = Image::create($val);
        $img = new Image();
        $img->titre = $request->titre;
        $img->description = $request->description;
        $img->src = $src;
        $img->user()->associate(Auth::user());
        $tags = explode(',',$request->tags);

        if( count($tags) > 0 ) {
            $idsTags = [];
            foreach ($tags as $tag) {
                if(!empty($tag)) {
                    if(!$existingTags = Tag::where('name', $tag)->first()) {
                        $existingTags = new Tag();
                        $existingTags->name = $tag;
                        $existingTags->slug = $tag;
                        $existingTags->save();
                    }
                    $idsTags[] = $existingTags->id;
                }
            }

            $img->tags()->sync($idsTags);
        }

        $img->save();

        return back()->with('success', "Ajout de l'image réussi");
    }
}