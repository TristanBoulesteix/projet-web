
var token = "";
var lastId = "";

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
  xmlhttp.open("GET", "http://10.169.128.55:3000/gallery?event="+1/* event id on where we had click*/+"&token="+token, true);
  xmlhttp.send();
}

function getToken (myJSON){
var json = myJSON.result;
getDatas(json);
}

function displayOn(myJSON) {
  var json = myJSON.response[0];
  var wrapper = $("#wrapper");
  var currentDiv;
  var div = 0;

  for (var i = 0; i < json.length; i++) {

      currentDiv = $(document.createElement("div")).addClass("content").addClass('"'+div+'"').attr("style", "background-image : url(../img/gallery/"+json[i].image+")");
      wrapper.append(currentDiv);
      var tool = $(document.createElement("div")).addClass("tools");
      currentDiv.append(tool);
      tool.append('<p class="commentary">commenter</p>');
      var like = $(document.createElement("div")).addClass("like");
      like.append('<i class="fa fa-thumbs-up"></i>');
      currentDiv.append(like);
      div ++;
  }

  $(".content").hover( function(){
    $(this).find("p").css("display", "inline-block");
  }, function(){
    $(this).find("p").css("display", "none");
  });

  $(".commentary").click(function(){
    const classthing = $(this).parent().parent().attr("class").split(" ")
    openComp(classthing[1]);
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
  xmlhttp.open("GET", "http://10.169.128.55:3000/comment?image="+1/* event id on where we had click*/+"&token="+token, true);
  xmlhttp.send();
}

function getTokenComm (myJSON, id){
  var json = myJSON.result;
  getDatasComm(json, id);
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
    section.css("display", "block");
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
    xmlhttp.open("GET", "http://10.169.128.55:3000/api/v1/users?bde=bde&cesi=lyon", true);
    xmlhttp.send();
}