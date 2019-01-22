@extends ("template")

@section('css')
<link rel="stylesheet" type="text/css" href="../css/form.css">
<style>
	main {
		height: 70.4vh;
	}

	@-moz-document url-prefix() {
		main {
			height: 71.2vh;
		}
	}
</style>
@endsection
@section('content')

<h3> Inscrivez vous! </h3>

{!! Form::open(['route'=>'register']) !!}

	<div class="formDiv">
		{!! Form::label('first_name', 'nom:')!!}
		{!! Form::text('first_name', null, ['required'=>'required'])!!}
		{!! $errors->first('first_name','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
		{!! Form::label('last_name', 'prénom:')!!}
		{!! Form::text('last_name', null, ['required'=>'required'])!!}
		{!! $errors->first('last_name','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
		{!! Form::label('email', 'email:')!!}
		{!! Form::email('email', null, ['required'=>'required', 'value' => old('email')])!!}
		{!! $errors->first('email','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
		{!! Form::label('password', 'mot de passe :')!!}
		{!! Form::password('password', ['required'=>'required'])!!}
	</div>

	<div class="formDiv">
		{!! Form::label('password_confirmation', 'confirmation du mot de passe :')!!}
		{!! Form::password('password_confirmation', ['required'=>'required'])!!}
		{!! $errors->first('password','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
	{!! Form::label('campus', 'votre centre:') !!}
	{!! Form::select('campus', $campusList, ['required'=>'required'])!!}
	{!! $errors->first('campus','<small class="help-block">:message</small>') !!}
	</div>

	{!! Form::submit('créer votre compte', ['class'=>'connexion'])!!}

{!! Form::close()!!}

@endsection
