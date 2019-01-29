@extends ("template")
@section('css')
<link rel="stylesheet" href="../css/form.css">

@endsection

@section('description')
<meta name="description" content="BDE-Lyon-CESI login" />
@endsection

@section('content')

<h3> Connexion au site du BDE: </h3>

{!! Form::open(['route'=>'login'])!!}

<div class="formDiv">
	{!! Form::label('email', 'email:')!!}
	{!! Form::email('email', null, ['required'=>'required', 'value' => old('email')])!!}
	{!! $errors->first('email','<small class="help-block">:message</small>') !!}
</div>

<div class="formDiv">
	{!! Form::label('password', 'mot de passe :')!!}
	{!! Form::password('password', ['required'=>'required'])!!}
	{!! $errors->first('password','<small class="help-block">:message</small>') !!}
</div>

{!! Form::submit('connexion', ['class'=>'connexion'])!!}


	<p id="info">  Vous connecter vous permettra de visiter la boutique, de publier et liker des photos, de partager des idées d'évènements et bien évidemment de vous inscrire à ceux qui vous plaisent!  </p>


<a id="link" href="register"> Créer votre compte </a> {!! Form::close()!!}
@endsection

