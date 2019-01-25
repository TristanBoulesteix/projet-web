var open = false;



function showBurger (){
	if (open) {
		$("#menuBurger").css("display", "none");
		open=false;

	}else{
		$("#menuBurger").css("display", "block");
		open=true;
	}
}