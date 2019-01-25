var token = "";

$(function () {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var myJSON = JSON.parse(this.responseText);
			getToken(myJSON);
		}
	};
	xmlhttp.open("GET", "http://10.169.128.55:3000/api/v1/users?bde=bde&cesi=lyon", true);
	xmlhttp.send();
});

var buy = function buyArticle(id) {
	document.location = './shop/' + id;
}

var deleteArticle = function deleteArticle(id) {
	document.location = './shop/delete/' + id;
}

function getDatas (token) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var myJSON = JSON.parse(this.responseText);
			displayOn(myJSON);
		}
	};
	xmlhttp.open("GET", "http://10.169.128.55:3000/articles?token="+token, true);
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

	$('.addToCart').on('click', function() {
		if($(this).attr('class').split(' ')[2] == 'top3') {
			buy($(this).parent().parent().attr('class').split(' ')[1]);
		} else {
			buy($(this).parent().parent().attr('id'));
		}
	});

	$('.delete').on('click', function() {
		if($(this).attr('class').split(' ')[2] == 'top3') {
			deleteArticle($(this).parent().parent().attr('class').split(' ')[1]);
		} else {
			deleteArticle($(this).parent().parent().attr('id'));
		}
	});
}
