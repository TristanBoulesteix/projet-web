@extends ("template")

@section('content')

{!! Form::open(['url'=>'/Login'])!!}

	<div>
		{!! Form::label('pseudo', 'pseudonyme :')!!}
		{!! Form::text('pseudo', null, ['required'=>'required'])!!}
	</div>

	<div>
		{!! Form::label('mdp', 'mot de passe :')!!}
		{!! Form::password('mdp', ['required'=>'required'])!!}

	</div>

	{!! Form::submit('connexion')!!}

	{!! Form::submit('Créer un compte')!!}

{!! Form::close()!!}

@endsection