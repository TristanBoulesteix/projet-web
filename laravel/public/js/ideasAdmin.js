
$(document).ready( function () {
  $('#table_id').DataTable();
} );


var token = "";

$(function () {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var myJSON = JSON.parse(this.responseText);
      getTokenAdmin(myJSON);
    }
  };
  xmlhttp.open("GET", "http://10.169.128.55:3000/api/v1/users?bde=bde&cesi=lyon", true);
  xmlhttp.send();
});


function getDatasAdmin (token) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var myJSON = JSON.parse(this.responseText);
      displayOnAdmin(myJSON);
    }
  };
  xmlhttp.open("GET", "http://10.169.128.55:3000/ideas?token="+token, true);
  xmlhttp.send();
}

function getTokenAdmin (myJSON){
var json = myJSON.result;
getDatasAdmin(json);
}



function displayOnAdmin(myJSON) {
  var json = myJSON.response[0];
  var wrapper = $("#tbody");
  var currentRow;
  var row = 0;


  for (var i = 0; i < json.length; i++) {
    var id = json[i].id;
    var name = json[i].name
    var description = json[i].description;
    currentRow = $(document.createElement("tr"))
    wrapper.append(currentRow);
    var data1 = $(document.createElement("td")).text(id);
    currentRow.append(data1);
    var data2 = $(document.createElement("td")).text(name);
    currentRow.append(data2);
    var data3 = $(document.createElement("td")).text(description);
    currentRow.append(data3);
    var data4 = $(document.createElement("td")).text("Auteur");
    currentRow.append(data4);
    row ++;
    /* TODO:
    find why onclick not working*/
  }
  $(".odd").empty();
}