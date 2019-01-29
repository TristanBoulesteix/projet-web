//token of teh API, json returned by the api, selection of teh HTML select element
var token = "";
var json;
var selected;

/**
 *On load get the API token
 */
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

/**
 * @param {*} token the returned token of the API
 * get the API Datas 
 */
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
/**
 * @param {*} myJSON the returned token  in a json format
 * assign the myJSON's value to var token
 */
function getTokenAdmin (myJSON){
var json = myJSON.result;
getDatasAdmin(json);
}

/**
 * 
 * @param {*} myJSON the API returned data in a json format
 * display the elements.
 */
function displayOnAdmin(myJSON) {
 json = myJSON.response[0];
  var wrapper = $("#tbody");
  var col = $(document.createElement("tr")).attr("id","tr");
  $("#thread").append(col);
  // create head collumns for DataTable.js lib with tr HTML elements.
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

// for each section fo the json, display the datas in rows susing tr HTML elements 
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
      document.location = "/addevent?id="+$(this).attr("id");
    });

}
// initiate datatable.js lib
$('#table_id').DataTable();
}







