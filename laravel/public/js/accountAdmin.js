var token = "";
var json;

$(function () {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var myJSON = JSON.parse(this.responseText);
      getTokenAccount(myJSON);
    }
  };
  xmlhttp.open("GET", "http://localhost:3000/api/v1/users?bde=bde&cesi=lyon", true);
  xmlhttp.send();
});

function getTokenAccount (myJSON){
  token = myJSON.result;
  getDatasAccount();
  }

  function getDatasAccount () {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var myJSON = JSON.parse(this.responseText);
        displayAccounts(myJSON);
      }
    };
    xmlhttp.open("GET", "http://localhost:3000/users?token="+token, true);
    xmlhttp.send();
  }

  
    function sendDatasAccount (selection, iduser) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var myJSON = JSON.parse(this.responseText);
          location.reload();
        }
      };
      xmlhttp.open("POST", "http://localhost:3000/userschange?id_user="+iduser+"&selection="+selection+"&token="+token, true);
      xmlhttp.send();
    }

  function displayAccounts(myJSON) {
     json = myJSON.response[0];
     var wrapper = $("#tbody");
     var col = $(document.createElement("tr")).attr("id","tr");
     $("#thread").append(col);
   
     var idcol = $(document.createElement("th")).text("ID");
     var name = $(document.createElement("th")).text("Nom");
     var secname = $(document.createElement("th")).text("Prénom");
     var email = $(document.createElement("th")).text("email");
     var status = $(document.createElement("th")).text("Status");
     var campus = $(document.createElement("th")).text("Campus");
     col.append(idcol);
     col.append(name);
     col.append(secname);
     col.append(email);
     col.append(status);
     col.append(campus);
   
   
     for (var i = 0; i < json.length; i++) {
       var id = json[i].id;
       var first_name = json[i].first_name;
       var last_name = json[i].last_name;
       var emailstd = json[i].email;
       var statusstd = json[i].role;
       var campusstd = json[i].name;
       var currentRow = $(document.createElement("tr"))
       wrapper.append(currentRow);
       var data1 = $(document.createElement("td")).text(id).attr("id", "id"+id);
       currentRow.append(data1);
       var data2 = $(document.createElement("td")).text(first_name).attr("id", "first_name"+id);
       currentRow.append(data2);
       var data3 = $(document.createElement("td")).text(last_name).attr("id", "last_name"+id);
       currentRow.append(data3);
       var data4 = $(document.createElement("td")).text(emailstd).attr("id", "email"+id);
       currentRow.append(data4);

       var data5 = $(document.createElement("td")).attr("id", "role"+id);
       var div = $(document.createElement("div")).attr("class", "select");
       var select = $(document.createElement("select")).addClass("selection").attr("id", "select"+id)
       select.append("<option id='what' value='0'> Status actuel : "+statusstd+"</option>");
       select.append("<option id='student' value='1'> Student </option>");
       select.append("<option id='CESI' value='2'> CESI </option>");
       select.append("<option id='BDE' value='3'> BDE </option>");
       div.append(select);
       data5.append(div);
       currentRow.append(data5);

       var data6 = $(document.createElement("td")).text(campusstd).attr("id", "campus"+id)
       currentRow.append(data6);

       selected = $("#select"+id);
       selected.change(function(){
       var thisid = $(this).attr("id").split("t", 2);
       var selection = $("#select"+thisid[1]+" option:selected").text();
       var actuel = "Status actuel : "+json[(thisid[1])-1].role;
       if(selection != actuel){
         selection = $("#select"+thisid[1]+" option:selected").attr("value");
         alert(selection);
        sendDatasAccount(selection, thisid[1]);
       }

       });
   
   }
   $('#table_id').DataTable();
   }