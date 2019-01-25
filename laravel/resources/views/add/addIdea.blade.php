@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/form.css">
@endsection

@section ( 'content' )

		
<h3> Ajouter une idée: </h3>

{!! Form::open(['route'=>'addIdea']) !!}

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

	{!! Form::submit('Ajouter cette idée', ['class'=>'connexion'])!!}

{!! Form::close()!!}

<img id="bde" src="../img/lyon.png">

@endsection