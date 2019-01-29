function showField(field) {
	field.css('display', 'block');
}

function hideField(field) {
	field.css('display', 'none');
}

if($('#category').val() == 'Add') {
	showField($('#added').parent());
} else {
	hideField($('#added').parent());
}

$('#category').on('change', function() {
	if($(this).val() == 'Add') {
		showField($('#added').parent());
	} else {
		hideField($('#added').parent());
	}
});
