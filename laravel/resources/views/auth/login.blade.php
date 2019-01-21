@extends ("template")
@section('css')
<link rel="stylesheet" type="text/css" href="../css/form.css">
<style>
	main {
		height: 73.2vh;
	}

	@-moz-document url-prefix() {
		main {
			height: 71.5vh;
		}
	}
</style>
@endsection

@section('content')

<h3> Connection au site du BDE: </h3>

{!! Form::open(['route'=>'login'])!!}

<div>
	{!! Form::label('email', 'email:')!!}
	{!! Form::email('email', null, ['required'=>'required'])!!}
	{!! $errors->first('mail','<small class="help-block">:message</small>') !!}
</div>

<div>
	{!! Form::label('password', 'mot de passe :')!!} {!! Form::password('password', ['required'=>'required'])!!}
	{!! $errors->first('password','<small class="help-block">:message</small>') !!}
</div>

{!! Form::submit('connexion', ['class'=>'connexion'])!!}


<a id="link" href="register"> Créer votre compte </a> {!! Form::close()!!}
@endsection
