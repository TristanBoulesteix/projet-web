/**
 * Show the logout button on mouseover when the user is logged
 *
 */


// Previous text
var savedText;

// Save the previous text
savedText = $('#hello').html();

$('#hello').hover(function(){
	$(this).html("Deconnexion");
}, function(){
	$(this).html(savedText);
});
