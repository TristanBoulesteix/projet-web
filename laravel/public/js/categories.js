/* API token returned as json and the name of the categorie selected*/
var token = "";
var selection = "";

/**
 * event listner on change for the select section.
 * call gotoAPI() with the name of the selected option in HTML select element
 */
$("#categorie").change(function(){
selection = $("#categorie").find(":selected").text();
if(selection == "Toutes les catégories"){
  selection ="all";
  gotoAPI(selection);
} else{
gotoAPI(selection);
}
});

/**
 * gotoAPI()
 * send request to get the API token
 * call getTokenCat()
 */
function gotoAPI() {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var myJSON = JSON.parse(this.responseText);
			getTokenCat(myJSON);
		}
	};
	xmlhttp.open("GET", "http://localhost:3000/api/v1/users?bde=bde&cesi=lyon", true);
	xmlhttp.send();
};

/**
 * 
 * @param {*} token the API token give by the gotoAPI
 * get the data corresponding to the selected option in the HTML element select
 */
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
/**
 * 
 * @param {*} myJSON the token returned by the API in a json format
 * assign the token's value
 * call getDatasCat()
 */
function getTokenCat (myJSON){
	var json = myJSON.result;
	getDatasCat(json);
}

/**
 * @param {*} myJSON the datas returned by the API in a json format
 */
function displayOnCategory(myJSON) {
	var json = myJSON.response[0];
  var wrapper = $("#allarticles");
  wrapper.empty();

	/* for each element of the json, create the article*/
	for (var i = 0; i < json.length; i++) {
		createArticle(json, wrapper, i);
	}
	/* Display "no datas" if the API json is null*/
	if( !$.trim( $('#allarticles').html() ).length ){
    var hello = $(document.createElement("p")).text("Données non disponibles.");
    wrapper.append(hello);
	}
	/**
	 * event listener hover to display the shops buttons and the report button if your are a CESI employe.
	 */
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