//Returned API token
var token = "";
/**
 * On load get APi's token
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
 * 
 * @param {*} token the API's token
 * get teh API's Datas
 */
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
/**
 * @param {*} myJSON the API's returned token as a json
 * assign myJSON value to var token
 */
function getToken (myJSON){
var json = myJSON.result;
getDatas(json);
}
/**
 * @param {*} myJSON the API's returned Datas as a json
 * display HTML elements
 */
function displayOn(myJSON) {
	var json = myJSON.response[0];
	var wrapper = $("#wrapper");
	var currentRow;
	var row = 0;
//for each part or the json, display HTML element
	for (var i = 0; i < json.length; i++) {
		currentRow = $(document.createElement("div")).addClass("row").attr("id", "row"+row);
		wrapper.append(currentRow);
		var img = $(document.createElement("div")).attr("style", "background-image : url(../storage/event/" + json[i].image + ");").addClass('imgArticle').attr("alt", "image idée").attr("id", "imgcase");
		currentRow.append(img);
		img.append('<a class="buttonSee" href="/gallery/' + json[i].id + '">Voir photo</a>');
		var reportbtn = $(document.createElement("a")).addClass('buttonReport').text("report").attr("href", "/home");
		img.append(reportbtn);
		var content = $(document.createElement("div")).addClass("content");
		currentRow.append(content);
		content.append("<h2>"+json[i].name +"</h2>");
		content.append("<p>"+json[i].description +"</p>");
		var res = json[i].date;
    var date = res.split("T", 1);
    content.append("<p>"+ date +"</p>");
		row ++;
	}
	//check emptyness do wrapper and display "no data allowed"
	if( !$.trim( $('#wrapper').html() ).length ){
    var hello = $(document.createElement("p")).text("Données non disponibles.");
    wrapper.append(hello);
	}
	/**
 * event listener on hover to display the buttons report and see
 */
	$(".imgArticle").hover( function(){
    $(this).find($(".buttonReport")).css("display", "inline-block");
    }, function(){
    $(this).find($(".buttonReport")).css("display", "none");
	});
	$(".imgArticle").hover( function(){
    $(this).find($(".buttonSee")).css("display", "inline-block");
    }, function(){
    $(this).find($(".buttonSee")).css("display", "none");
  });
}
