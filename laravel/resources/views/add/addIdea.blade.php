@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/form.css">
<link rel="stylesheet" type="text/css" href="../css/add/addIdea_phone.css">
@endsection

@section ( 'content' )


<h3> Ajouter une idée: </h3>

{!! Form::open(['route'=>'addIdea', 'files' => true]) !!}

	<div class="formDiv">
		{!! Form::label('name', 'nom:')!!}
		{!! Form::text('name', null, ['required'=>'required', 'value' => old('name')])!!}
		{!! $errors->first('name','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
		{!! Form::label('description', 'description:')!!}
		{!! Form::textarea('description', null, ['required'=>'required', 'value' => old('description')])!!}
		{!! $errors->first('description','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
		{!! Form::label('file', "Sélectionner l'image à uploader", array('id' => 'inputfile', 'class' => 'connexion'))!!}
		{!! Form::file('file', ['id'=>'file',"required"=>"required", 'style' => 'display:none', 'accept' => 'image/*', 'value' => old('file')])!!}
		{!! $errors->first('file','<small class="help-block">:message</small>') !!}
	</div>

	{!! Form::submit('Ajouter cette idée', ['class'=>'connexion'])!!}

{!! Form::close()!!}

<img id="bde" src="../img/lyon.png">
<script src="../js/file.js"></script>
@endsection
