@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/photos.css">
<link rel="stylesheet" type="text/css" href="../css/add/addPhotos_phone.css">
@endsection

@section ( 'content' )

		<h2>Uploder des photos: </h2>
				{!! Form::open(['url'=>'upload']) !!}
					{!! Form::label('img', "Sélectionner l'image à uploader:")!!}
				    {!! Form::file('file', ['id'=>'file',"required"=>"required"])!!}
				    {!! Form::submit('Upload', ['id'=>'uploadBut'])!!}
				{!! Form::close()!!}


<img id="bde" src="../img/lyon.png">

@endsection