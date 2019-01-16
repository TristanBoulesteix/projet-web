@extends ("template")
@section('css')
<link rel="stylesheet" type="text/css" href="../css/form.css">
@endsection

@section('content')

<h3> Connection au site du BDE: </h3>

{!! Form::open(['url'=>'/Login'])!!}

<div>
	{!! Form::label('email', 'email:')!!} {!! Form::email('email', null, ['required'=>'required'])!!}
</div>

<div>
	{!! Form::label('mdp', 'mot de passe :')!!} {!! Form::password('mdp', ['required'=>'required'])!!}
</div>

<div>
	{!! Form::label('centre', 'votre centre:') !!} {!! Form::select('centres', array( 'Lyon' => 'Lyon', 'Paris' => 'Paris', 'Strasbourg'
	=> 'Strasbourg'), ['required'=>'required'])!!}
</div>

{!! Form::submit('connexion', ['class'=>'connexion'])!!}


<a id="link" href="register"> Créer votre compte </a> {!! Form::close()!!}
@endsection
