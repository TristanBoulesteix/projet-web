@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/gallery.css">
@endsection

@section ( 'content' )

<h3 id="page"> Galerie </h3>
@if($role == 'BDE')
<a href="{{ url('gallery/add/'.$idEvent)}}" class="button">Ajouter des images</a>
@endif

@if($role == 'CESI')
<a href="{{ url('gallery/download?type=gallery&id='.$idEvent}}" class="button">Télécharger les images</a>
@endif

<div id="comSection">

</div>
<div id="wrapper">

</div>

<script src="../js/gallery.js"></script>
<script >
function createGallery(currentDiv, json, wrapper, i){
currentDiv = $(document.createElement("div")).addClass("content").attr("id", json[i].id).attr("style", "background-image : url(../img/gallery/"+json[i].image+")");
	  wrapper.append(currentDiv);
	  var tool = $(document.createElement("div")).addClass("tools");
    currentDiv.append(tool);
    @if($role == 'CESI')
		var reportbtn = $(document.createElement("a")).addClass('buttonReport').text("report").attr("href", "report?type=image&id=" + json[i].id);
    currentDiv.append(reportbtn);
    @endif
	  tool.append('<p class="commentary" id="'+json[i].id+'">commenter</p>');
	  var like = $(document.createElement("div")).addClass("like");
		currentDiv.append(like);
		var bouton = $(document.createElement("i")).addClass("fa fa-thumbs-up").attr("id", json[i].id).attr("onclick", "clicked("+json[i].id+")");
    like.append(bouton);
}

</script>
@endsection
