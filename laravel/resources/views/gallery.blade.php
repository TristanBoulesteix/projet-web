@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/gallery.css">
@endsection

@section ( 'content' )

<h3 id="page"> Gallerie </h3>

<div id="rowButton">
<a href="/event" class="buttons">Evènements</a>
<a href="" class="buttons">Si BDE, ajouter des évènements</a>
</div>

<div id="wrapper">

</div>

<script src="./js/gallery.js"></script>
@endsection