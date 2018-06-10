@extends('layout')

@section('contenu')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>{{ $img->titre }}</h1></div>
                <div class="panel-body img-detail-container">
                    @if (!empty($img->tags()->get()))
                        <div>
                            @foreach ($img->tags()->get() as $tag)
                                <span class="label label-primary">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    @endif
                    <p class="text-right">
                        <a href="{{ route('home') }}" class="btn btn-success">Retour à la liste</a>
                    </p> 
                    <img src="{{URL::asset('upload/'.$img->src)}}">
                </div>
            </div>

            @if (!empty($img->description))
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Description</h2></div>
                    <div class="panel-body">
                        {{ $img->description }}
                    </div>
                </div>
            @endif

            @if (isset($similars) && !empty($similars))
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Images similaires</h2></div>
                    <div class="panel-body">
                        @foreach ($similars as $img)
                            <div class="col-xs-6 col-md-3">
                                <a href="{{ route('picdetail', $img->id) }}" class="thumbnail similar" title="{{ $img->titre }}">
                                    <img src="{{URL::asset('upload/'.$img->src)}}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
@stop