@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/gallery.css">
@endsection

@section ( 'content' )

<h3 id="page"> Galerie </h3>
@if($role == 'BDE')
<a href="" class="button">Ajouter des images</a>
@endif

<div id="comSection">

</div>
<div id="wrapper">

</div>

<script src="../js/gallery.js"></script>
@endsection
