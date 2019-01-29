@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/form.css">
<link rel="stylesheet" href="../css/add/addproduct_phone.css">
@endsection

@section ( 'content' )


<h3> Ajouter un article: </h3>

{!! Form::open(['url'=>'addarticle', 'files' => true]) !!}

	<div class="formDiv">
		{!! Form::label('name', 'nom:')!!}
		{!! Form::text('name', null, ['required'=>'required', 'value' => old('name')])!!}
		{!! $errors->first('name','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
		{!! Form::label('description', 'description:')!!}
		{!! Form::textarea('description', null, ['required'=>'required', 'value' => old('description')])!!}
		{!! $errors->first('description','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
		{!! Form::label('file', "Sélectionner l'image à uploader", array('id' => 'inputfile', 'class' => 'connexion'))!!}
		{!! Form::file('file', ['id'=>'file',"required"=>"required", 'style' => 'display:none', 'accept' => 'image/*', 'value' => old('file')])!!}
		{!! $errors->first('file','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
		{!! Form::label('price', 'prix :')!!}
		{!! Form::number('price', null, ['required'=>'required', 'value' => old('price')])!!}
		{!! $errors->first('price','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv">
	{!! Form::label('category', 'categorie:') !!}
	{!! Form::select('category', $categories, ['required'=>'required', 'value' => old('category')])!!}
	{!! $errors->first('category','<small class="help-block">:message</small>') !!}
	{!! $errors->first('added','<small class="help-block">:message</small>') !!}
	</div>

	<div class="formDiv masked">
		{!! Form::label('added', 'nom:')!!}
		{!! Form::text('added', null, ['value' => old('name')])!!}
	</div>

	{!! Form::submit('Ajouter cet article', ['class'=>'connexion'])!!}

{!! Form::close()!!}

<img id="bde" src="../img/lyon.png">
<script src="../js/file.js"></script>
<script src='../js/product/autoCategory.js'></script>

@endsection
