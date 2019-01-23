var token = "";
var selection = "";

$("#categorie").change(function(){
selection = $("#categorie").find(":selected").text();
switch(selection){
  case "sucré": selection = "sucré";
  gotoAPI();
  break;
  case "salé": selection = "salé";
  gotoAPI();
  break;
  case "neutre": selection = "neutre";
  gotoAPI();
  break;
  default: selection = "all";
  gotoAPI();
  break;
}
});


function gotoAPI() {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var myJSON = JSON.parse(this.responseText);
			getTokenCat(myJSON, selection);
		}
	};
	xmlhttp.open("GET", "http://localhost:3000/api/v1/users?bde=bde&cesi=lyon", true);
	xmlhttp.send();
};

function getDatasCat (token) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var myJSON = JSON.parse(this.responseText);
			displayOnCategory(myJSON);
		}
	};
	xmlhttp.open("GET", "http://localhost:3000/category?category_name="+selection+"&token="+token, true);
	xmlhttp.send();
}

function getTokenCat (myJSON){
	var json = myJSON.result;
	getDatasCat(json);
}

function displayOnCategory(myJSON) {
	var json = myJSON.reponse[0];
  var wrapper = $("#allarticles");
  wrapper.empty();

	for (var i = 0; i < json.length; i++) {
		createArticleCat(json, wrapper, i);
  }
}

function createArticleCat(json, wrapper, i) {
    var columnElement = $(document.createElement("div")).addClass("column").attr("id", i);
    wrapper.append(columnElement);
    var img = $(document.createElement("div")).attr("style", "background-image : url(../img/produit/" + json[i].image + ");").addClass('imgArticle');
    img.append("<div class='buttonShop addToCart'>Ajouter au panier</div>");
    columnElement.append(img);
    var content = $(document.createElement("div")).addClass("content");
    columnElement.append(content);
    content.append("<h3>"+json[i].name +": "+ json[i].price+"€</h3>");
    content.append("<p>"+json[i].description+"</p>");
  }