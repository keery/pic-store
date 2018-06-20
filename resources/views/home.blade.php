@extends('layout')

@section('contenu')
    <div class="row">
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
        @if (isset($imgs) && count($imgs) > 0)
            <div class="col-xs-9">
                <div class="row">
                    @foreach ($imgs as $img)
                        <div class="col-xs-6 col-md-4">
                            <div class="thumbnail">
                                <img src="{{URL::asset('upload/'.$img->src)}}">
                                <div class="caption">
                                    <h3>{{ $img->titre }}</h3>
                                    <p>{{str_limit($img->description, 40) }}</p>
                                    <div class="row">
                                        <p class="text-right"><a href="{{ route('picdetail', $img->id) }}" class="btn btn-primary" role="button">Voir le détail</a></p>
                                        {{ Form::open(array('url' => 'delete/pic/' . $img->id, 'class' => 'pull-right')) }}
                                        {{ Form::hidden('_method', 'POST') }}
                                        {{ Form::submit('Supprimer', array('class' => 'btn btn-primary')) }}
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-xs-12">{{ $imgs->render() }}</div>
                </div>
            </div>
        @else
            <div class="col-xs-9">        
                <div class="alert alert-warning">Aucun résultat</div>
            </div>
        @endif
    </div>
@stop