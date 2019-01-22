$(function () {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var myJSON = JSON.parse(this.responseText);
			displayOn(myJSON);
		}
	};
	xmlhttp.open("GET", "http://localhost:3000/articles", true);
	xmlhttp.send();
});

function createArticle(json, wrapper, i) {
	var columnElement = $(document.createElement("div")).addClass("column").attr("id", "column"+i);
	wrapper.append(columnElement);
	var img = $(document.createElement("div")).attr("style", "background-image : url(../img/produit/" + json[i].image + ");").addClass('imgArticle');
	columnElement.append(img);
	var content = $(document.createElement("div")).addClass("content");
	columnElement.append(content);
	content.append("<h3>"+json[i].name +": "+ json[i].price+"€</h3>");
	content.append("<p>"+json[i].description+"</p>");
}

function displayOn(myJSON) {
	var json = myJSON.response[0];
	var wrapper = $("#allarticles");
	var column = 0;

	for (var i = 0; i < json.length; i++) {
		createArticle(json, wrapper, i);
	}
}
