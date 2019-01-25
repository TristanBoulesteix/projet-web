
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
  xmlhttp.open("GET", "http://10.169.128.55:3000/ideas?token="+token, true);
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
      var img = $(document.createElement("img")).attr("src", "../img/ideas/"+json[i].image).attr("alt", "image idée").attr("id", "imgcase");
      currentRow.append(img);
      var content = $(document.createElement("div")).addClass("content");
      currentRow.append(content);
      content.append("<p>"+json[i].description +"</p>");
      var hidebuttons = $(document.createElement("div")).attr("id", "buttonCase");
      content.append(hidebuttons);
      var like = $(document.createElement("div")).attr("id", "likeButton");
      wrapper.append(like);
      like.append("<i class="+'"fa fa-thumbs-up"'+"></i>");
      column = 1;
      row ++;
  }
}