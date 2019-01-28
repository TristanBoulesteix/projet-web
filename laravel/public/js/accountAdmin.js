var token = "";

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
       var statusstd = json[i].role_name;
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

       var data5 = $(document.createElement("td")).text(statusstd).attr("id", "role"+id).addClass("dropup"+id);
       var div = $(document.createElement("div").attr("class", "dropup-content");
       div.append("<p id='student'> Student </p>");
       div.append("<p id='CESI'> CESI </p>");
       div.append("<p id='BDE'> BDE </p>");
       date5.append(div);
       currentRow.append(data5);

       var data6 = $(document.createElement("td")).text(campusstd).attr("id", "campus"+id)
       currentRow.append(data6);
       selected = $('.select'+id);
       selected.click(function(){
         //Envoyer à l'api le changement de rôle via l'id ou changer via php (puisque local)
       });
   
   }
   $('#table_id').DataTable();
   }