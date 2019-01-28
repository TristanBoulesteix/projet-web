
var token = "";

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


function postLike (id_idea) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var myJSON = JSON.parse(this.responseText);
    }
  };
  xmlhttp.open("POST", "http://localhost:3000/like/idea?token="+token+"&id_idea="+id_idea, true);
  xmlhttp.send();
}

function getDatas () {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var myJSON = JSON.parse(this.responseText);
      displayOn(myJSON);
    }
  };
  xmlhttp.open("GET", "http://localhost:3000/ideas?token="+token, true);
  xmlhttp.send();
}

function getToken (myJSON) {
token = myJSON.result;
getDatas();
}


function displayOn(myJSON) {
	var json = myJSON.response[0];
	var wrapper = $("#wrapper");
	var currentRow;
	var row = 0;

	for (var i = 0; i < json.length; i++) {

		currentRow = $(document.createElement("div")).addClass("row").attr("id", "row"+row);
		wrapper.append(currentRow);
		var img = $(document.createElement("div")).attr("style", "background-image: url('storage/idea/"+json[i].image+"')").attr("alt", "image idée").attr("class", "imgcase");
    currentRow.append(img);
    var reportbtn = $(document.createElement("a")).addClass('buttonReport').text("report").attr("href", "/home");
    img.append(reportbtn);
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
		row ++;
  }
  $(".imgcase").hover( function(){
    $(this).find($(".buttonReport")).css("display", "inline-block");
    }, function(){
    $(this).find($(".buttonReport")).css("display", "none");
  });
}

function clicked(id) {
	postLike(id);
	$("#"+id).css("color", "blue");
	$("#"+id).prop("onclick", null).off("click");
}
