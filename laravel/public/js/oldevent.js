
var token = "";

$(function () {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var myJSON = JSON.parse(this.responseText);
      getToken(myJSON);
    }
  };
  xmlhttp.open("GET", "http://10.169.128.55:3000/api/v1/users?bde=bde&cesi=lyon", true);
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
  xmlhttp.open("GET", "http://10.169.128.55:3000/events/past?token="+token, true);
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

      currentRow = $(document.createElement("div")).addClass("row").attr("id", "row"+row);
      wrapper.append(currentRow);
      var img = $(document.createElement("div")).attr("style", "background-image : url(../img/events/" + json[i].image + ");").addClass('imgArticle').attr("alt", "image idée").attr("id", "imgcase");
      currentRow.append(img);
      img.append('<a href="/gallery">Voir photo</a>');
      var content = $(document.createElement("div")).addClass("content");
      currentRow.append(content);
      content.append("<p>"+json[i].description +"</p>");
      content.append("<p>"+json[i].date +"</p>");
      row ++;
  }
}