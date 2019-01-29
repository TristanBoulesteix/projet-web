@extends ( 'template' )
@section('description')
<meta name="description" content="évènements" />
@endsection
@section ( 'css' )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/events/event.css">
<link rel="stylesheet" href="../css/events/event_phone.css">
<link rel="stylesheet" href="../css/events/event_laptop.css">
@endsection

@section ( 'content' )

<h3 id="page"> {{ $h3 }} </h3>

<div id="rowButton">
<a href="{{url($uriSwitch)}}" class="buttons">{{ $buttonText }}</a>
@if($role == 'BDE')
<a href="{{ url('addevent') }}" class="buttons">Ajouter des évènements</a>
@endif
</div>

<div id="wrapper">
</div>

<script src="{{ $uriScript }}"></script>
<script>
function createElement(currentRow, json, wrapper, row, i) {
	currentRow = $(document.createElement("div")).addClass("row").attr("id", "row"+row);
	wrapper.append(currentRow);
	var img = $(document.createElement("div")).attr("style", "background-image : url(../storage/event/" + json[i].image + ");").addClass('imgArticle').attr("alt", "image idée").attr("id", "imgcase");
	currentRow.append(img);
	@if($role == 'CESI')
	var reportbtn = $(document.createElement("a")).addClass('buttonReport').text("report").attr("href", "report?type=event&id=" + json[i].id);
	img.append(reportbtn);
	@endif
	var participatebtn = $(document.createElement("a")).addClass('buttonParticipate').text("S'inscrire à l'évènement!").attr("href", "event/participate?id="+json[i].id);
	img.append(participatebtn);
	var content = $(document.createElement("div")).addClass("content");
	currentRow.append(content);
	content.append("<h2>"+json[i].name +"</h2>");
	content.append("<p>"+json[i].description +"</p>");
	var res = json[i].date;
	var date = res.split("T", 1);
	content.append("<p>"+ date +"</p>");
	var price  = json[i].cost;
	if(price != 0){
		content.append("<p> Prix : "+ price +" €</p>");
	}else{
		content.append("<p> Évenement gratuit! </p>");
	}
	var type = json[i].type;
	if(type != "none"){
		content.append("<p> Évenement "+ type +"</p>");
	}
	@if($role == 'BDE')
	content.append("<a href='download/?type=event&id="+json[i].id+"' class='button'>Télécharger les inscrits</a>");
	@endif
	row ++;
}

	function createOldEvent(currentRow, json, wrapper, row, i) {
		currentRow = $(document.createElement("div")).addClass("row").attr("id", "row"+row);
		wrapper.append(currentRow);
		var img = $(document.createElement("div")).attr("style", "background-image : url(../storage/event/" + json[i].image + ");").addClass('imgArticle').attr("alt", "image idée").attr("id", "imgcase");
		currentRow.append(img);
		img.append('<a href="/gallery/' + json[i].id + '">Voir photo</a>');
		@if($role == 'CESI')
		var reportbtn = $(document.createElement("a")).addClass('buttonReport').text("report").attr("href", "report?type=event&id=" + json[i].id);
		img.append(reportbtn);
		@endif
		var content = $(document.createElement("div")).addClass("content");
		currentRow.append(content);
		content.append("<h2>"+json[i].name +"</h2>");
		content.append("<p>"+json[i].description +"</p>");
		var res = json[i].date;
		var date = res.split("T", 1);
		content.append("<p>"+ date +"</p>");
		row ++;
	}
</script>

@endsection
