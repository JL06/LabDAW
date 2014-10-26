function validate_form(req_values){

	var valid=true;

	for (var i = req_values.length - 1; i >= 0; i--) {
		if( document.getElementsByName(req_values[i]).value == "")
			valid=false;
	}
	return valid;
}