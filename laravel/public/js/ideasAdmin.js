var token = "";
var json;
var selected;

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
 json = myJSON.response[0];
  var wrapper = $("#tbody");
  var col = $("#tr")
  var row = 0;

  var idCol = $(document.createElement("th")).text("ID");
  var nameCol = $(document.createElement("th")).text("Name");
  var descriptionCol = $(document.createElement("th")).text("Description");
  var autheur = $(document.createElement("th")).text("Autheur");
  var select = $(document.createElement("th")).text("Selectionner");
  col.append(idCol);
  col.append(nameCol);
  col.append(descriptionCol);
  col.append(autheur);
  col.append(select);


  for (var i = 0; i < json.length; i++) {
    var id = json[i].id;
    var name = json[i].name
    var description = json[i].description;
    var currentRow = $(document.createElement("tr"))
    wrapper.append(currentRow);
    var data1 = $(document.createElement("td")).text(id).attr("id", "id"+row);
    currentRow.append(data1);
    var data2 = $(document.createElement("td")).text(name).attr("id", "name"+row);
    currentRow.append(data2);
    var data3 = $(document.createElement("td")).text(description).attr("id", "description"+row);
    currentRow.append(data3);
    var data4 = $(document.createElement("td")).text("Auteur").attr("id", "autheur"+row);
    currentRow.append(data4);
    var selection = $(document.createElement("td")).text("Selectionner l'idée").attr("id", "select"+row).attr("id", "select");
    currentRow.append(selection);

    selected = $('#select'+row).DataTable();
    alert($('#select'+row));
    row ++;

}
$('#table_id').DataTable();
/*for(var i = 0; i <= row; i++){
  selected = $('#select'+i).DataTable();
  selected.on(function(){
    alert("hllo");
  });
}*/
}







