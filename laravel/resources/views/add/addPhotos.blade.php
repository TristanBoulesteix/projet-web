@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ URL::asset('css/photos.css')}}">
<link rel="stylesheet" href="{{ URL::asset('css/add/addPhotos_phone.css')}}">
<link rel="stylesheet" href="{{ URL::asset('css/form.css')}}">
@endsection

@section ( 'content' )

	<h2> Uploader des photos: </h2>
		{!! Form::open(['url'=>'upload', 'files' => true]) !!}
		<div class="formDiv">
			{!! Form::label('file', "Sélectionner l'image à uploader", array('id' => 'inputfile', 'class' => 'connexion'))!!}
			{!! Form::file('file', ['id'=>'file',"required"=>"required", 'style' => 'display:none', 'accept' => 'image/*', 'value' => old('file')])!!}
			{!! $errors->first('file','<small class="help-block">:message</small>') !!}
		</div>

		{!! Form::submit("Ajouter l'image", ['class'=>'connexion'])!!}

		{!! Form::close()!!}

<img id="bde" src="{{ URL::asset('img/lyon.png') }}">
<script src=" {{ URL::asset('js/file.js') }}"></script>

@endsection
