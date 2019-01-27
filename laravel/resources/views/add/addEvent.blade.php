@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/form.css">
<link rel="stylesheet" type="text/css" href="../css/add/addEvent_phone.css">
@endsection

@section ( 'content' )


<h3> Ajouter un article: </h3>

{!! Form::open(['url'=>'addEvent']) !!}

	<div class="formDiv">
		{!! Form::label('name', "Nom de l'évènement:")!!}
		{!! Form::text('name', null, ['required'=>'required'])!!}
		{!! $errors->first('name','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
		{!! Form::label('Description', 'description:')!!}
		{!! Form::textarea('description', null, ['required'=>'required'])!!}
		{!! $errors->first('description','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
		{!! Form::label('file', "Sélectionner l'image à uploader", array('id' => 'inputfile', 'class' => 'connexion'))!!}
		{!! Form::file('file', ['id'=>'file',"required"=>"required", 'style' => 'display:none', 'accept' => 'image/*'])!!}
		{!! $errors->first('file','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
		{!! Form::label('date', "Date de l'évènement :")!!}
		{!! Form::date('date', date('Y-m-d'), null, ['required'=>'required'])!!}
		{!! $errors->first('date','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
	{!! Form::label('recurrency', "Récurrence :") !!}
	{!! Form::select('recurrency', array('Ponctuel'=>'Ponctuel', 'Recurent'=>'Récurent'), ['required'=>'required'])!!}
	{!! $errors->first('recurrency','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv masked">
	{!! Form::label('type', 'Type de récurrence :') !!}
	{!! Form::select('type', array('daily'=>'Tous les Jours', 'weekly'=>'Toutes les semaines', 'monthly'=>'Tous les Mois'))!!}
	{!! $errors->first('type','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
	{!! Form::label('price', 'Coût :') !!}
	{!! Form::select('price', array('free'=>'Gratuit', 'pay'=>'Payant'), ['required'=>'required'])!!}
	{!! $errors->first('price','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv masked">
		{!! Form::label('cost', 'Prix :')!!}
		{!! Form::text('cost')!!}
		{!! $errors->first('cost','<small class="help-block">:message</small>') !!}
	</div>

	{!! Form::submit('Ajouter cet article', ['class'=>'connexion'])!!}

{!! Form::close()!!}

<img id="bde" src="../img/lyon.png">
<script src='../js/event/checkToday.js'></script>
<script src='../js/event/autoAddField.js'></script>

@endsection
