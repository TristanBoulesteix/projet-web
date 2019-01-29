// Token returned by the API and the last image id selected
var token = "";
var lastId = "";
//get in the url the id of the event
var eventSelected = window.location.href.replace(/\/$/, '');
var eventSelected = window.location.href.substr(eventSelected.lastIndexOf('/') + 1);

/**
 * on load, get the API token and call getToken()
 */
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

/**
 * @param {*} token the returned API token stocked in var token
 * Get the datas about the selectedEvent
 * call DisplayOn()
 */
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

/**
 * 
 * @param {*} myJSON the returned API token in a json
 * assign the API token value int the var token
 */
function getToken (myJSON){
token = myJSON.result;
getDatas(token);
}
/**
 * @param {*} myJSON the returned API json containing the datats
 */
function displayOn(myJSON) {
  var json = myJSON.response[0];
  var wrapper = $("#wrapper");
  var currentDiv;

//for each part of teh json, create HTML elements
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
	}
	// when json is empty, display "no data allowed"
	if( !$.trim( $('#wrapper').html() ).length ){
    var hello = $(document.createElement("p")).text("Données non disponibles.");
    wrapper.append(hello);
  }
/**
 * add event listeners for the comment button and the comment section.
 */
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


/**
 * 
 * @param {*} token the API token stocked in var token
 * @param {*} id the id of the image linked to the disired comments
 */
function getDatasComm (token, id) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  var myJSON = JSON.parse(this.responseText);
	  displayOnComm(myJSON, id);
	}
  };
  xmlhttp.open("GET", "http://localhost:3000/comment?image="+id+"&token="+token, true);
  xmlhttp.send();
}
/**
 * 
 * @param {*} myJSON the API returned json containning the token
 * @param {*} id the id of the image linked to the disired comments
 */
function getTokenComm (myJSON, id){
  token = myJSON.result;
  getDatasComm(token, id);
  }
/**
 * @param {*} myJSON the API retunred json containning the datas
 * @param {*} id the id of the image linked to the disired comments
 */
function displayOnComm(myJSON, id) {
  var json = myJSON.response[0];
  var section = $("#comSection");
  var currentRow;
	var row = 0;
	// if not empty, empty the section.
  if(section.length != 0){
	section.empty();
	}
	// fo each part of teh json, create HTML elements
  for (var i = 0; i < json.length; i++) {
	  currentRow = $(document.createElement("div")).addClass("row").attr("id", "row"+row);
	  section.append(currentRow);
	  currentRow.append("<p>"+json[i].comment +"</p>");
	  row ++;
	}
	// display the right comment section of display none all.
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
/**
 * 
 * @param {*} id the id of the image linked to the disired comments
 */
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

/**
 * @param {*} id_image the id of the image
 */
function postLike (id_image) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    }
  };
  xmlhttp.open("POST", "http://localhost:3000/like/event?token="+token+"&id_image="+id_image, true);
  xmlhttp.send();
}
// when a like is clicked on: change the color in blue and remove the "onclick" html attribute.
function clicked(id){
  postLike(id);
  $("#"+id).css("color", "blue");
  $("#"+id).prop("onclick", null).off("click");
}