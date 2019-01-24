@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/form.css">
@endsection

@section ( 'content' )

		
<h3> Ajouter un article: </h3>

{!! Form::open(['route'=>'addEvent']) !!}

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

	<div class="formDiv">
		{!! Form::label('date', 'date:')!!}
		{!! Form::date('date', date('Y-m-d'), null, ['required'=>'required'])!!}
		{!! $errors->first('date','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
	{!! Form::label('type', 'type:') !!}
	{!! Form::select('type', array('Ponctuel'=>'Ponctuel', 'Récurent'=>'Récurent'), ['required'=>'required'])!!}
	{!! $errors->first('type','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
		{!! Form::label('Ponctuel', 'Date:')!!}
		{!! Form::text('Ponctuel', null, ['required'=>'required'])!!}
		{!! $errors->first('Ponctuel','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
	{!! Form::label('Dates', 'Dates:') !!}
	{!! Form::select('type', array('Jours'=>'Tous les Jours', 'Semaines'=>'Toutes les semaines', 'Mois'=>'Tous les Mois'), ['required'=>'required'])!!}
	{!! $errors->first('type','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
	{!! Form::label('Prix', 'Prix:') !!}
	{!! Form::select('Prix', array('Payant'=>'Payant', 'Gratuit'=>'Gratuit'), ['required'=>'required'])!!}
	{!! $errors->first('Prix','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
		{!! Form::label('Payant', 'Prix:')!!}
		{!! Form::text('Payant', null, ['required'=>'required'])!!}
		{!! $errors->first('Payant','<small class="help-block">:message</small>') !!}
	</div>

	{!! Form::submit('Ajouter cet article', ['class'=>'connexion'])!!}

{!! Form::close()!!}

<img id="bde" src="../img/lyon.png">

@endsection