/** the status of the burger menu,
 * @default: false
*/
var open = false;


/**
 * On smarphones: show the burger menu when cliked on.
 */
function showBurger (){
	if (open) {
		$("#menuBurger").css("display", "none");
		open=false;

	}else{
		$("#menuBurger").css("display", "block");
		open=true;
	}
}