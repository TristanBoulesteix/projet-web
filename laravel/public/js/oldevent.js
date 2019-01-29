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


function getDatas (token) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  var myJSON = JSON.parse(this.responseText);
	  displayOn(myJSON);
	}
  };
  xmlhttp.open("GET", "http://localhost:3000/events/past?token="+token, true);
  xmlhttp.send();
}

function getToken (myJSON){
var json = myJSON.result;
getDatas(json);
}



function displayOn(myJSON) {
	var json = myJSON.response[0];
	var wrapper = $("#wrapper");
	var currentRow;
	var row = 0;

	for (var i = 0; i < json.length; i++) {
		createOldEvent(currentRow, json, wrapper, row, i);
	}

	if( !$.trim( $('#wrapper').html() ).length ){
    var hello = $(document.createElement("p")).text("Données non disponibles.");
    wrapper.append(hello);
	}

	$(".imgArticle").hover( function(){
    $(this).find($(".buttonReport")).css("display", "inline-block");
    }, function(){
    $(this).find($(".buttonReport")).css("display", "none");
  });
}
