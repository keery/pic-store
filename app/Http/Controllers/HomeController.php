<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Tag;
use Session;
use Auth;


class HomeController extends Controller
{
    public function index(Request $request) {
        //Lors de la validation du formulaire de critères
        if($request->isMethod('post')) {
            $imgs = Image::orderBy('id', 'DESC');

            //Si le champ titre n'est pas vide je cherche un tutre qui contient la valeur
            if(isset($request->titre) && !empty($request->titre)) $imgs->where('titre', 'like', '%' . $request->titre . '%');
            
            //Je cherche les images qui contiennent les tags sélectionnés
            if(isset($request->tags) && !empty($request->tags)) {
                $tags = $request->tags;
                $imgs->whereHas('tags', function ($query) use ($tags) {
                    $query->whereIn('name', $tags);
                });
            }

            $imgs = $imgs->paginate(12);
        }
        //Sinon je récupères toutes les images
        else {
            if(Auth::user()->id) $imgs = Image::orderBy('id', 'DESC')->paginate(12);
            else $imgs = Image::orderBy('id', 'DESC')->paginate(12);
        }

        //Je récupère les tags pour les critères
        $tags = Tag::all()->sortBy("name");

        return view('home', ['imgs' => $imgs, 'tags' => $tags]);
    }

    public function detailImage(Request $request) {
        $data = [];
        if($data['img'] = Image::find($request->id)) 
        {
            $tags = [];
            foreach ($data['img']->tags()->get() as $tag) $tags[] = $tag->name;

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


    public function destroy($id)
    {


        $image = Image::findOrFail($id);

        $image->delete();


        Session::flash('flash_message', "Image supprimée");

        return redirect()->route('home');
    }

}
