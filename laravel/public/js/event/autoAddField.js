function showField(field) {
	field.css('display', 'block');
}

function hideField(field) {
	field.css('display', 'none');
}

$('#recurrency').on('change', function() {
	if($(this).val() == 'Recurent') {
		showField($('#type').parent());
	} else {
		hideField($('#type').parent());
	}
});

$('#price').on('change', function() {
	if($(this).val() == 'pay') {
		showField($('#cost').parent());
	} else {
		hideField($('#cost').parent());
	}
});
