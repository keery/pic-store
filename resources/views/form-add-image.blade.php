@extends('layout')

@section('contenu')
    {!! Form::open(array('url' => 'add/pic', 'files'=>'true')) !!}
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


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

            <div class="col-xs-12">
                <div class="form-group">
                    <label>Ajouter des tags à votre image</label>
                    <input type="text" class="tags form-control" name="tags" />
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group text-right">
                    {!! Form::submit('Enregistrer', [
                        'class' => 'btn btn-primary'
                    ]) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@stop

<script>
    var tags = [
        @foreach ($tags as $tag)
        {tag: "{{$tag->name}}" },
        @endforeach
    ];
</script>
<script type="text/javascript" src="{!! asset('js/app.js') !!}"></script>