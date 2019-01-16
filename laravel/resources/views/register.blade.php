@extends ("template")

@section('css')
<link rel="stylesheet" type="text/css" href="../css/form.css">
@endsection
@section('content')

<h3> Inscrivez vous! </h3>

{!! Form::open(['url'=>'/Register'])!!}

	<div>
		{!! Form::label('nom', 'nom:')!!}
		{!! Form::text('nom', null, ['required'=>'required'])!!}
	</div>

	<div>
		{!! Form::label('prenom', 'prenom:')!!}
		{!! Form::text('prenom', null, ['required'=>'required'])!!}
	</div>

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

	{!! Form::submit('créer votre compte', ['class'=>'connexion'])!!}

{!! Form::close()!!}

@endsection