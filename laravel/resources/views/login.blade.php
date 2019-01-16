@extends ("template")

@section('content')

<h2> Connection au site du BDE: </h2>

{!! Form::open(['url'=>'/Login'])!!}

	<div>
		{!! Form::label('email', 'email:')!!}
		{!! Form::email('email', null, ['required'=>'required'])!!}
	</div>

	<div>
		{!! Form::label('mdp', 'mot de passe :')!!}
		{!! Form::password('mdp', ['required'=>'required'])!!}
	</div>

	<div>
	{!! Form::label('centre', 'votre centre:') !!}
	{!! Form::select('centres', array(
    'Lyon' => 'Lyon',
    'Paris' => 'Paris',
    'Strasbourg' => 'Strasbourg'), ['required'=>'required'])!!}
	</div>

	{!! Form::submit('connexion')!!}

{!! Form::close()!!}

<a href="register"> Créer votre compte </a>

@endsection