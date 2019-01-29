/**
 * script tho upload something and display it's name instead of an image/other
 */
$(document).ready(function(){
	$('input[type="file"]').change(function(e){
		var fileName = e.target.files[0].name;
		$('#inputfile').html(fileName);
	});
});
