var token = "";

$(function () {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var myJSON = JSON.parse(this.responseText);
			getToken(myJSON);
		}
	};
	xmlhttp.open("GET", "http://localhost:3000/api/v1/users?bde=bde&cesi=lyon", true);
	xmlhttp.send();
});

var buy = function buyArticle(id) {
	alert(id);
}

function createArticle(json, wrapper, i) {
	var columnElement = $(document.createElement("div")).addClass("column").attr("id", i);
	wrapper.append(columnElement);
	var img = $(document.createElement("div")).attr("style", "background-image : url(../img/produit/" + json[i].image + ");").addClass('imgArticle');
	img.append("<div class='buttonShop'>Ajouter au panier</div>");
	columnElement.append(img);
	var content = $(document.createElement("div")).addClass("content");
	columnElement.append(content);
	content.append("<h3>"+json[i].name +": "+ json[i].price+"€</h3>");
	content.append("<p>"+json[i].description+"</p>");
}


function getDatas (token) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var myJSON = JSON.parse(this.responseText);
			displayOn(myJSON);
		}
	};
	xmlhttp.open("GET", "http://localhost:3000/articles?token="+token, true);
	xmlhttp.send();
}

function getToken (myJSON){
	var json = myJSON.result;
	getDatas(json);
}

function displayOn(myJSON) {
	var json = myJSON.response[0];
	var wrapper = $("#allarticles");

	for (var i = 0; i < json.length; i++) {
		createArticle(json, wrapper, i);
	}

	$('.buttonShop').on('click', function() {
		buy($(this).parent().parent().attr('id'));
	});
}
