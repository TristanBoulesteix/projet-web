@extends ("template")

@section('content')

{!! Form::open(['url'=>'/Inscription'])!!}

	<div>
		{!! Form::label('nom', 'nom:')!!}
		{!! Form::text('nom', null, ['required'=>'required'])!!}
	</div>

	<div>
		{!! Form::label('prenom', 'prenom:')!!}
		{!! Form::mail('prenom', null, ['required'=>'required'])!!}
	</div>

	<div>
		{!! Form::label('email', 'email:')!!}
		{!! Form::mail('email', null, ['required'=>'required'])!!}
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

	{!! Form::submit('Créer un compte')!!}

{!! Form::close()!!}

@endsection