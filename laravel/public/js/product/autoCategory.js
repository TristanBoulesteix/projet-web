function showField(field) {
	field.css('display', 'block');
}

function hideField(field) {
	field.css('display', 'none');
}

$('#category').on('change', function() {
	if($(this).val() == 'Add') {
		showField($('#add').parent());
	} else {
		hideField($('#add').parent());
	}
});
