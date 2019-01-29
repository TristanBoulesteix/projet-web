
var token = "";
var lastId = "";

var eventSelected = window.location.href.replace(/\/$/, '');
var eventSelected = window.location.href.substr(eventSelected.lastIndexOf('/') + 1);

$(function () {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  var myJSON = JSON.parse(this.responseText);
	  getToken(myJSON);
	}
  };
  xmlhttp.open("GET", "http://localhost:3000/api/v1/users?bde=bde&cesi=lyon", true);
  xmlhttp.send();
});


function getDatas (token) {

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		var myJSON = JSON.parse(this.responseText);
		displayOn(myJSON);
		}
	};
	xmlhttp.open("GET", "http://localhost:3000/gallery?event="+eventSelected+"&token="+token, true);
	xmlhttp.send();
}

function getToken (myJSON){
token = myJSON.result;
getDatas(token);
}

function displayOn(myJSON) {
  var json = myJSON.response[0];
  var wrapper = $("#wrapper");
  var currentDiv;
  var div = 0;

  for (var i = 0; i < json.length; i++) {

		currentDiv = $(document.createElement("div")).addClass("content").attr("id", json[i].id).attr("style", "background-image : url(../img/gallery/"+json[i].image+")");
	  wrapper.append(currentDiv);
	  var tool = $(document.createElement("div")).addClass("tools");
	  currentDiv.append(tool);
	  tool.append('<p class="commentary" id="'+json[i].id+'">commenter</p>');
	  var like = $(document.createElement("div")).addClass("like");
		currentDiv.append(like);
		var bouton = $(document.createElement("i")).addClass("fa fa-thumbs-up").attr("id", json[i].id).attr("onclick", "clicked("+json[i].id+")");
		like.append(bouton);
	  div ++;
	}
	
	if( !$.trim( $('#wrapper').html() ).length ){
    var hello = $(document.createElement("p")).text("Données non disponibles.");
    wrapper.append(hello);
  }

  $(".content").hover( function(){
	$(this).find("p").css("display", "inline-block");
  }, function(){
	$(this).find("p").css("display", "none");
  });

  $(".commentary").click(function(){
	const classthing = $(this).attr("id")
	openComp(classthing);
  });

}



function getDatasComm (token, id) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  var myJSON = JSON.parse(this.responseText);
	  displayOnComm(myJSON, id);
	}
  };
  xmlhttp.open("GET", "http://localhost:3000/comment?image="+1/* event id on where we had click*/+"&token="+token, true);
  xmlhttp.send();
}

function getTokenComm (myJSON, id){
  token = myJSON.result;
  getDatasComm(token, id);
  }

function displayOnComm(myJSON, id) {
  var json = myJSON.response[0];
  var section = $("#comSection");
  var currentRow;
  var row = 0;
  if(section.length != 0){
	section.empty();
  }
  for (var i = 0; i < json.length; i++) {
	  currentRow = $(document.createElement("div")).addClass("row").attr("id", "row"+row);
	  section.append(currentRow);
	  currentRow.append("<p>"+json[i].comment +"</p>");
	  row ++;
  }
  if(lastId != id){
	if(section.css("display") == "block"){
	section.css("display", "none");
  }else{
	section.css("display", "block");
  }
  }else{
	if(section.css("display") == "block"){
	  section.css("display", "none");
	}else{
	  section.css("display", "block");
	}
  }
}

function openComp(id) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
		var myJSON = JSON.parse(this.responseText);
		getTokenComm(myJSON, id);
	  }
	};
	xmlhttp.open("GET", "http://localhost:3000/api/v1/users?bde=bde&cesi=lyon", true);
	xmlhttp.send();
}


function postLike (id_image) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    }
  };
  xmlhttp.open("POST", "http://localhost:3000/like/event?token="+token+"&id_image="+id_image, true);
  xmlhttp.send();
}

function clicked(id){
  postLike(id);
  $("#"+id).css("color", "blue");
  $("#"+id).prop("onclick", null).off("click");
}