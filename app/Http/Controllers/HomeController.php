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
    public function index() {
        $imgs = Image::orderBy('id', 'DESC')->paginate(12);
        return view('home', compact('imgs'));
    }

    public function detailImage(Request $request) {
        $data = [];
        if($data['img'] = Image::find($request->id)) 
        {
            $tags = [];
            foreach ($data['img']->tags()->get() as $tag) {
                $tags[] = $tag->name;
            }

            if(count($tags) > 0) {
                $data['tags'] = $tags;
                $data['similars'] = Image::where('id', '!=', $request->id)->whereHas('tags', function ($query) use ($tags) {
                    $query->whereIn('name', $tags);
                })
                ->limit(4)
                ->get();
            }
            
            return view('detail-image', $data);
        }
        return redirect()->route('home');
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

        return back()->with('success', "Ajout de l'image réussi");
    }
}
