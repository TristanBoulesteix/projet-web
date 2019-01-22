/**
 * Show the logout button on mouseover when the user is logged
 *
 */

// Save the previous text
var savedText = $('#hello').html();

// Save the previous size
var savedSize = $('#hello').css('width');

$('#hello').hover(function() {
	$(this).css('width', savedSize);
	$(this).html("Deconnexion");
}, function() {
	$(this).html(savedText);
	$(this).css('width', 'auto');
	savedSize = $(this).css('width');
});
