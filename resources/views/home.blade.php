@extends('layout')

@section('contenu')
    <div class="row">
        <div class="col-xs-12">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-warning">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        @if($col = Request::route()->getName() !== 'my-pics')
            <div class="col-xs-3">
                <div class="criteria-bar thumbnail">
                    {!! Form::open(array('url' => '/')) !!}
                        <div class="form-group">
                            {!! Form::text('titre', null, [
                                'class' => 'form-control',
                                'placeholder' => "Rechercher par titre"
                            ]) !!}
                        </div>
                        @if (isset($tags) && !empty($tags))
                            <div>Filtrer par tag</div>
                            @foreach ($tags as $tag)
                                <div class="checkbox">
                                    <label>{!! Form::checkbox('tags[]', $tag->name ); !!}{{ $tag->name }}</label>
                                </div>
                            @endforeach
                        @endif
                        <div class="form-group text-right">
                            {!! Form::submit('Rechercher', [
                                'class' => 'btn btn-primary'
                            ]) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        @endif

        @if (isset($imgs) && count($imgs) > 0)
            <div class="{{ !$col ? 'col-xs-12' : 'col-xs-9' }}">
                <div class="row">
                    @foreach ($imgs as $img)
                        <div class="col-xs-6 col-md-4">
                            <div class="thumbnail">
                                <img src="{{URL::asset('upload/'.$img->src)}}">
                                <div class="caption">
                                    <h3>{{ $img->titre }}</h3>
                                    <p>{{str_limit($img->description, 40) }}</p>
                                    <div class='row'>
                                        <div class="col-xs-6">   
                                            @if (Auth::check() && $img->user_id === Auth::user()->id) 
                                                <a href='{{ route('deletepic', ['id' => $img->id]) }}' class="btn btn-danger">Supprimer</a> 
                                            @endif
                                        </div>
                                        <div class="col-xs-6">
                                            <p class="text-right"><a href="{{ route('picdetail', $img->id) }}" class="btn btn-primary" role="button">Voir le détail</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-xs-12">{{ $imgs->render() }}</div>
                </div>
            </div>
        @else
            <div class="{{ !$col ? 'col-xs-12' : 'col-xs-9' }}">        
                <div class="alert alert-warning">Aucun résultat</div>
            </div>
        @endif
    </div>
@stop