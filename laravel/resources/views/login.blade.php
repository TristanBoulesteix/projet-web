@extends ("template")

@section('content')

{!! Form::open(['url'=>'/Login'])!!}

	<div>
		{!! Form::label('email', 'email:')!!}
		{!! Form::email('email', null, ['required'=>'required'])!!}
	</div>

	<div>
		{!! Form::label('mdp', 'mot de passe :')!!}
		{!! Form::password('mdp', ['required'=>'required'])!!}
	</div>

	echo Form::select('centres', array(
    'Lyon' => array('ville' => 'Ville'),
    'Paris' => array('ville' => 'Ville'),
    'Strasbourg' => array('ville' => Ville'),
	));

	{!! Form::submit('connexion')!!}

	{!! Form::submit('Créer un compte')!!}

{!! Form::close()!!}

@endsection