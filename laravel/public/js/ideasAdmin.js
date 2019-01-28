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
  xmlhttp.open("GET", "http://localhost:3000/api/v1/users?bde=bde&cesi=lyon", true);
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
  xmlhttp.open("GET", "http://localhost:3000/ideas?token="+token, true);
  xmlhttp.send();
}

function getTokenAdmin (myJSON){
var json = myJSON.result;
getDatasAdmin(json);
}



function displayOnAdmin(myJSON) {
 json = myJSON.response[0];
  var wrapper = $("#tbody");
  var col = $(document.createElement("tr")).attr("id","tr");
  $("#thread").append(col);

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
    var data1 = $(document.createElement("td")).text(id).attr("id", "id"+id);
    currentRow.append(data1);
    var data2 = $(document.createElement("td")).text(name).attr("id", "name"+id);
    currentRow.append(data2);
    var data3 = $(document.createElement("td")).text(description).attr("id", "description"+id);
    currentRow.append(data3);
    var data4 = $(document.createElement("td")).text("Auteur").attr("id", "autheur"+id);
    currentRow.append(data4);
    var selection = $(document.createElement("td")).text("Transformer cette idée en évènement").attr("id", id).addClass("select"+id);
    currentRow.append(selection);
    selected = $('.select'+id);
    selected.click(function(){
      document.location = "/addEvent?"+$(this).attr("id");
    });

}
$('#table_id').DataTable();
}







