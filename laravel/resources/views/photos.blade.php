@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/photos.css">
@endsection

@section ( 'content' )

		<h2>Uploder des photos: </h2>
				<form action="{{ URL::to('upload') }}" method="post" enctype="multipart/form-data">
					<label>Sélectionner l'image a uploder:</label>
				    <input type="file" name="file" id="file">
				    <input type="submit" value="Upload" name="submit" id="uploadBut">
					<input type="hidden" value="{{ csrf_token() }}" name="_token">
				</form>


<img id="bde" src="../img/lyon.png">

@endsection