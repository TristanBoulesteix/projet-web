var token = "";
var selection = "";

$("#categorie").change(function(){
selection = $("#categorie").find(":selected").text();
if(selection == "Toutes les catégories"){
  selection ="all";
  gotoAPI(selection);
} else{
gotoAPI(selection);
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
	var json = myJSON.response[0];
  var wrapper = $("#allarticles");
  wrapper.empty();

	for (var i = 0; i < json.length; i++) {
		createArticle(json, wrapper, i);
  }
		$(".imgArticle").hover( function(){
			$(this).find($(".buttonShop")).css("display", "inline-block");
			}, function(){
			$(this).find($(".buttonShop")).css("display", "none");
		});

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