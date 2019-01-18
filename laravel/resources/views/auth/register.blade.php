@extends ("template")

@section('css')
<link rel="stylesheet" type="text/css" href="../css/form.css">
<style>
	main {
		height: 65%;
	}
</style>
@endsection
@section('content')

<h3> Inscrivez vous! </h3>

{!! Form::open(['route'=>'register']) !!}

	<div>
		{!! Form::label('first_name', 'nom:')!!}
		{!! Form::text('first_name', null, ['required'=>'required'])!!}
		{!! $errors->first('first_name','<small class="help-block">:message</small>') !!}
	</div>

	<div>
		{!! Form::label('last_name', 'prénom:')!!}
		{!! Form::text('last_name', null, ['required'=>'required'])!!}
		{!! $errors->first('last_name','<small class="help-block">:message</small>') !!}
	</div>

	<div>
		{!! Form::label('email', 'email:')!!}
		{!! Form::email('email', null, ['required'=>'required', 'value' => old('email')])!!}
		{!! $errors->first('email','<small class="help-block">:message</small>') !!}
	</div>

	<div>
		{!! Form::label('password', 'mot de passe :')!!}
		{!! Form::password('password', ['required'=>'required'])!!}
	</div>

	<div>
		{!! Form::label('password_confirmation', 'mot de passe :')!!}
		{!! Form::password('password_confirmation', ['required'=>'required'])!!}
		{!! $errors->first('password','<small class="help-block">:message</small>') !!}
	</div>

	<div>
	{!! Form::label('campus', 'votre centre:') !!}
	{!! Form::select('campus', array(
	'Lyon',
	'Paris',
	'Strasbourg'), ['required'=>'required'])!!}
	{!! $errors->first('campus','<small class="help-block">:message</small>') !!}
	</div>

	{!! Form::submit('créer votre compte', ['class'=>'connexion'])!!}

{!! Form::close()!!}

@endsection
