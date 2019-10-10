/*
* Front End Scripts for the Reste Password Page
*/

jQuery(document).ready(function($){
    
    var emptyFields = true;
	var passCheck = false;
	var passStr = false;
    
    var errorMessages = {
		company: "Please select company",
		empty: "Please complete all fields",
		emailFormat: "Please make sure you use a valid email address",
		emailMatch: "Your email addresses do not match",
		passwordFormat: "Please make sure your password meets the minimum requirements",
		passwordMatch: "Your passwords do not match",
		disclaimer: "Please tick the box to proceed",
		lettersOnly: "Please use only letters when typing your name",
		numbersOnly: "Please use only numbers when typing your phone number"
	};

	$('input').on('keyup blur', function(){
		var inputVal = $(this).val();

		if( inputVal.length == 0 ) {
			$(this).addClass('fail');
		} else {
			$(this).removeClass('fail');
			$(this).next('.error_msg').text('');
		}

		if( $(this).is('#pass1') ) {
			function hasNumber(myString) {
			  return /\d/.test(myString);
			}
			
			if( $('#pass2').val() == inputVal ) {
				$(this).next('.error_msg').text('');
				passCheck = true;
			} else {
				$(this).next('.error_msg').text("Passwords don't match");
				passCheck = false;
			}
			
			if( inputVal.length >= 7 && /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]+)$/.test(inputVal) ) {
				$(this).next('.error_msg').text('');
				passStr = true;
			} else {
				$(this).next('.error_msg').text('Make sure your password meets the minimum requirements');
				passStr = false;
			}
		}

		if( $(this).is('#pass2') ) {
			if( $('#pass1').val() == inputVal ) {
				$(this).next('.error_msg').text('');
				passCheck = true;
			} else {
				$(this).next('.error_msg').text("Passwords don't match");
				passCheck = false;
			}
		}

		var empty = $('input').filter(function() {
			return this.value === "";
		});

		if(empty.length) {
			emptyFields = true;
		} else {
			emptyFields = false;
		}
	});

	$('input').on('keyup blur', function(){
		if( !emptyFields && passCheck && passStr ) {
			$('#resetpass-button').prop('disabled', false);
		} else {
			$('#resetpass-button').prop('disabled', true);
		}
	});
	
	$('input').addClass('fail');
	
	$('.overlay').click(function(){
		$('.fail:not(#disclaimer, #company-name)').siblings('.error_msg').text(errorMessages.empty);
		if( !$('input#disclaimer').is(':checked') ) $('#disclaimer').siblings('.error_msg').text(errorMessages.disclaimer);
		if( $("#company-name").val() == 'Company Name' || $("#company-name").val() == '' ) $('#company-name').siblings('.error_msg').text(errorMessages.company);
	});
    
});