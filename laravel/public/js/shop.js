

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

function displayOn(myJSON) {
	var json = myJSON.response[0];
	var wrapper = $("#allarticles");
	var column = 0;
	var currentRow;
	var row = 0;

	currentRow = $(document.createElement("div")).addClass("row").attr("id", "row"+row);
	wrapper.append(currentRow);
	for (var i = 0; i < json.length; i++) {
		if (column >= 3) {
			currentRow = $(document.createElement("div")).addClass("row").attr("id", "row"+row);
			wrapper.append(currentRow);
			var columnElement = $(document.createElement("div")).addClass("column").attr("id", "column"+i);
			currentRow.append(columnElement);

			var img = $(document.createElement("div")).attr("style", "background-image : url(../img/produit/" + json[i].image + ");").addClass('imgArticle');
			columnElement.append(img);
			var content = $(document.createElement("div")).addClass("content");
			columnElement.append(content);
			content.append("<h3>"+json[i].name +": "+ json[i].price+"€</h3>");
			content.append("<p>"+json[i].description+"</p>");
			column = 1;
			row ++;
		}
		else{
			var columnElement = $(document.createElement("div")).addClass("column").attr("id", "column"+i);
			currentRow.append(columnElement);
			var img = $(document.createElement("div")).attr("style", "background-image : url(../img/produit/" + json[i].image + ");").addClass('imgArticle');
			columnElement.append(img);
			var content = $(document.createElement("div")).addClass("content");
			columnElement.append(content);
			content.append("<h3>"+json[i].name +": "+ json[i].price+"€</h3>");
			content.append("<p>"+json[i].description+"</p>");
			column ++;
		}
	}
}
