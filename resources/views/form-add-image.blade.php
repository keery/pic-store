@extends('layout')

@section('contenu')
    {!! Form::open(array('url' => 'add/pic', 'files'=>'true')) !!}
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    {!! Form::label('titre', 'Titre:') !!}
                    {!! Form::text('titre', null, [
                        'class' => 'form-control',
                        'required'
                    ]) !!}
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                
                    {!! Form::label('description', 'Description:') !!}
                    {!! Form::textarea('description', null, [
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    {!! Form::label('Image', 'Image:') !!}
                    {!! Form::file('image') !!}
                </div>
            </div>
            
            <div class="form-group text-right">
                {!! Form::submit('Enregistrer', [
                    'class' => 'btn btn-primary'
                ]) !!}
            </div>
        </div>
    {!! Form::close() !!}
@stop