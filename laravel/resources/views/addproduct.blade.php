@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/form.css">
@endsection

@section ( 'content' )

		
<h3> Ajouter un article: </h3>

{!! Form::open(['route'=>'addproduct']) !!}

	<div class="formDiv">
		{!! Form::label('name', 'nom:')!!}
		{!! Form::text('name', null, ['required'=>'required'])!!}
		{!! $errors->first('name','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
		{!! Form::label('description', 'description:')!!}
		{!! Form::textarea('description', null, ['required'=>'required'])!!}
		{!! $errors->first('description','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
	{!! Form::label('img', "Sélectionner l'image à uploader:")!!}
	{!! Form::file('file', ['id'=>'file',"required"=>"required"])!!}
	</div>

	<div id="mdp" class="formDiv">
		{!! Form::label('price', 'prix :')!!}
		{!! Form::number('price',null, ['required'=>'required'])!!}
		{!! $errors->first('price','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
	{!! Form::label('categorie', 'categorie:') !!}
	{!! Form::select('categorie', array('Nourriture'=>'Nourriture', 'Places'=>'Places'), ['required'=>'required'])!!}
	{!! $errors->first('categorie','<small class="help-block">:message</small>') !!}
	</div>

	{!! Form::submit('Ajouter cet article', ['class'=>'connexion'])!!}

{!! Form::close()!!}

<img id="bde" src="../img/lyon.png">

@endsection