@extends ( 'template' )
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/ideabox/ideabox.css">
<link rel="stylesheet" href="./css/ideabox/ideabox_ipad.css">
<link rel="stylesheet" href="./css/ideabox/ideabox_phone.css">
@endsection

@section ( 'content' )

<h3 id="page"> Boite à idées </h3>

<div id="Adminbtn">
		<div id="addEventCase">
			<a id="addEventBut" href="addidea"> Proposer&nbsp;un&nbsp;évènement </a>
		</div>

<h4 id="pub"> Venez proposer vos idées dévènements! </h4>
@if ($role->role == 'BDE')
<a id="connexion" href="/idea/admin">Administrer</a>
@endif
</div>



<div id="wrapper"></div>
<script>
	function createElement(json, wrapper, currentRow, row, i) {
		currentRow = $(document.createElement("div")).addClass("row").attr("id", "row"+row);
		wrapper.append(currentRow);
		var img = $(document.createElement("img")).attr("src", "storage/idea/"+json[i].image).attr("alt", "image idée").attr("id", "imgcase");
		currentRow.append(img);
		var content = $(document.createElement("div")).addClass("content");
		currentRow.append(content);
		content.append('<h3>'+ json[i].name + '</h3>');
		content.append("<p>"+json[i].description +"</p>");
		var hidebuttons = $(document.createElement("div")).attr("id", "buttonCase");
		content.append(hidebuttons);
		var like = $(document.createElement("div")).addClass("likeButton");
		wrapper.append(like);
		var bouton = $(document.createElement("i")).addClass("fa fa-thumbs-up").attr("id", json[i].id).attr("onclick", "clicked("+json[i].id+")");
		like.append(bouton);
		column = 1;
	}
</script>
<script src="../js/ideas.js"></script>

@endsection
