@extends('layout')

@section('contenu')
    <div class="row">
        @foreach ($imgs as $img)
            <div class="col-xs-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{URL::asset('upload/'.$img->src)}}">
                    <div class="caption">
                        <h3>{{ $img->titre }}</h3>
                        <p>{{str_limit($img->description, 40) }}</p>
                        <p class="text-right"><a href="{{ route('picdetail', $img->id) }}" class="btn btn-primary" role="button">Voir le détail</a></p>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-xs-12">{{ $imgs->render() }}</div>
    </div>
@stop