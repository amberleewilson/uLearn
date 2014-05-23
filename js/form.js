// form.js


error_fields = [];

function validate_form() { //custom function to validate the form
	var is_valid = true;
	
	for (var i = 0; i < error_fields.length; i++) { //if the length of the error field is less than 0 ()
		$(error_fields[i]).removeClass('error');  //the class of error will be removed
	}
	
	error_fields = [];
	 
	
	if (!check_name()) {                   
		is_valid = false; //if the name is not filled out the form will be invalid	
	}
	
	
	if (!check_password()) {
		is_valid = false; 
	}
	
	
	if (!check_email()) {                   
		is_valid = false; //if the name is not filled out the form will be invalid	
	}
	
	
	if (!check_password2()) {                   
		is_valid = false; //if the name is not filled out the form will be invalid	
	}
	
	
		for (var i = 0; i < error_fields.length; i++) {
			$(error_fields[i]).addClass('error');  //will check all fields and give the error class to what is missing 
		}
		
		
	
	return  is_valid;
	
}

function check_name() { //custom function that will see if the field is empty
	if ($('#username').val() === 'username' ||  $('#username').val() === '') { 
		
		error_fields.push($('#username')); // reference the array to add the class to this if empty
		return false;
	} else {
		return true; 
	}
	
}


function check_password() {
    if ($('#password').val() === 'password' ||  $('#password').val() === '') {
                
		error_fields.push($('#password')); // reference the array to add the class to this if empty
		return false;
	} else {
		return true;
	}
	
}

function check_email() { //custom function that will see if the field is empty
	if ($('#email').val() === 'email' ||  $('#email').val() === '') { 
		
		error_fields.push($('#email')); // reference the array to add the class to this if empty
		return false;
	} else {
		return true; 
	}
	
}

function check_password2() { //custom function that will see if the field is empty
	if ($('#password2').val() === 'password2' ||  $('#password2').val() === '') { 
		
		error_fields.push($('#password2')); // reference the array to add the class to this if empty
		return false;
	} else {
		return true; 
	}
	
}



	
	

$(function() { // beginning of function
    
$('#login-validate').submit(function() {	
		return validate_form(); // this will prevent the form from submission if errors 

});

$('#register-validate').submit(function() {	
		return validate_form(); // this will prevent the form from submission if errors 
	
	
	// TAB INTO FIELDS	
}); 

$('#username').focus(function() {
    	$(this).css('color', '#292929');
		if ($(this).val() === 'username') {
			$(this).val('');	//	set the value attribute of the text input to an empty string
		}

    });

$('#username').blur(function() {
    	
		if ($(this).val() === '') {
			$(this).css('color', '#999'); 
			$(this).val('username'); 
                }
	});

$('#password').focus(function() {
    	$(this).css('color', '#292929');
		if ($(this).val() === 'password') {
			$(this).val('');	//	set the value attribute of the text input to an empty string
		}

    });

$('#password').blur(function() {
    	
		if ($(this).val() === '') {
			$(this).css('color', '#999'); 
			$(this).val('password'); 
                }
	});

}); // end of function
