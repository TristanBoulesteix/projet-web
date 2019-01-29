// the returned API token
var token = "";
/**
 * on load get the API token
 */
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
//get the view shop and link the id in the url
var buy = function buyArticle(id) {
	document.location = './shop/' + id;
}
//get the view shop/delete and link the id in the url
var deleteArticle = function deleteArticle(id) {
	document.location = './shop/delete/' + id;
}
/**
 * @param {*} token the API token
 * get the datas
 */
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
/**
 * 
 * @param {*} myJSON the API returned json
 * assign teh myJSON's value to var token
 */
function getToken (myJSON){
	var json = myJSON.result;
	getDatas(json);
}
/**
 * 
 * @param {*} myJSON teh API returned datas in a json format
 * creat HTML elements
 */
function displayOn(myJSON) {
	var json = myJSON.response[0];
	var wrapper = $("#allarticles");
//for each jsone elements, creates HTML elements
	for (var i = 0; i < json.length; i++) {
		createArticle(json, wrapper, i);
// verifiy if the section isn't empty and display "no datas allowed"
		if( !$.trim( $('#allarticles').html() ).length ){
			var hello = $(document.createElement("p")).text("Données non disponibles.");
			wrapper.append(hello);
		}
/**
 * add events listeners on hover to diplays buttons buy, delete or report
 */
		$(".imgArticle").hover( function(){
				$(this).find($(".buttonShop")).css("display", "inline-block");
				}, function(){
				$(this).find($(".buttonShop")).css("display", "none");
			});
	}
	$(".imgArticle").hover( function(){
    $(this).find($(".buttonReport")).css("display", "inline-block");
    }, function(){
    $(this).find($(".buttonReport")).css("display", "none");
  });
/**
 * add event listeners on click to add to card or delete elements.
 */
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
