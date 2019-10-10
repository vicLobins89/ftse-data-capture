/*
* Front End Scripts for the Survey Page (data collection page)
*/


// Data tabs for previous years
function openTab(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

if( document.getElementById("defaultOpen") !== null ){
	document.getElementById("defaultOpen").click();
}

jQuery(document).ready(function($){
    
    // Disallow Enter button press
    $('html body.page-id-764').bind('keypress', function(e) {
       if(e.keyCode == 13) {
          return false;
       }
    });
    
    
    // Setup vars for section 1 and 2 validation
	var totalOne,
		totalTwo,
		errorEmpty;
    
	function validate() {
        /*
        * This function checks that all fields in section 1 and 2 are not empty and are not negative
        * as well as calculate the totals for input data
        */
        
        var empty;
		
		var negative = $('input[readonly]').filter(function() {
			return this.value < 0;
		});
        
        var genderData = {
            repExecTotal : parseInt($('#repExecTotal').val()),
			repExecMen : parseInt($('#repExecMen').val()),
			repExecWomen : parseInt($('#repExecWomen').val()),
			turnExecAvgMen : parseInt($('#turnExecAvgMen').val()),
			turnExecJoinedMen : parseInt($('#turnExecJoinedMen').val()),
			turnExecLeftMen : parseInt($('#turnExecLeftMen').val()),
			turnExecAvgWomen : parseInt($('#turnExecAvgWomen').val()),
			turnExecJoinedWomen : parseInt($('#turnExecJoinedWomen').val()),
			turnExecLeftWomen : parseInt($('#turnExecLeftWomen').val()),
            
            repDirectTotal : parseInt($('#repDirectTotal').val()),
			repDirectMen : parseInt($('#repDirectMen').val()),
			repDirectWomen : parseInt($('#repDirectWomen').val()),
			turnDirectAvgMen : parseInt($('#turnDirectAvgMen').val()),
			turnDirectJoinedMen : parseInt($('#turnDirectJoinedMen').val()),
			turnDirectLeftMen : parseInt($('#turnDirectLeftMen').val()),
			turnDirectAvgWomen : parseInt($('#turnDirectAvgWomen').val()),
			turnDirectJoinedWomen : parseInt($('#turnDirectJoinedWomen').val()),
			turnDirectLeftWomen : parseInt($('#turnDirectLeftWomen').val())
        }
        
        // Calculations
		$('#turnExecAvgTotal').val(genderData.turnExecAvgMen + genderData.turnExecAvgWomen);
		$('#repExecMen').val( (genderData.turnExecAvgMen - genderData.turnExecLeftMen) + genderData.turnExecJoinedMen );
		$('#repExecWomen').val( (genderData.turnExecAvgWomen - genderData.turnExecLeftWomen) + genderData.turnExecJoinedWomen );
		$('#repExecTotal').val( ((genderData.turnExecAvgMen - genderData.turnExecLeftMen) + genderData.turnExecJoinedMen) + ((genderData.turnExecAvgWomen - genderData.turnExecLeftWomen) + genderData.turnExecJoinedWomen) );
		
		$('#turnDirectAvgTotal').val(genderData.turnDirectAvgMen + genderData.turnDirectAvgWomen);
		$('#repDirectMen').val( (genderData.turnDirectAvgMen - genderData.turnDirectLeftMen) + genderData.turnDirectJoinedMen );
		$('#repDirectWomen').val( (genderData.turnDirectAvgWomen - genderData.turnDirectLeftWomen) + genderData.turnDirectJoinedWomen );
		$('#repDirectTotal').val( ((genderData.turnDirectAvgMen - genderData.turnDirectLeftMen) + genderData.turnDirectJoinedMen) + ((genderData.turnDirectAvgWomen - genderData.turnDirectLeftWomen) + genderData.turnDirectJoinedWomen) );
        
        // Validations
        for(var key in genderData) {
            if( isNaN(genderData[key]) ) {
                empty = true;
            } else {
                empty = false;
            }
        }
		
		if( negative.length ) {
			$('.error_msg.neg').show();
		} else {
			$('.error_msg.neg').hide();
		}

		if(empty || negative.length) {
			$('.trigger').addClass('zero');
			errorEmpty = true
		} else {
			$('.trigger').removeClass('zero');
			$('.error_msg.zero').hide();
			errorEmpty = false;
		}
	}
    
    
    // Set up vars for section 3 validation
    var error_1,
        error_2,
        error_3,
        error_3a,
        error_3b;
	
	function checkSec3() {
        /*
        * This function checks that all fields in section 3 are completed properly
        */
		
        //check Q1
		if(
			$('#leadingExec').val() === '' ||
			$('#leadingExecName').val() === ''
		) {
            $('.trigger').addClass('error_1');
			error_1 = true;
		} else {
            $('.trigger').removeClass('error_1');
            $('.error_msg.error_1').hide();
            error_1 = false;
        }
            
        //check Q2 
        if(
            $('#seniorInfoTech').val() === '' ||
            ( $('#seniorInfoTechName').val() === '' && ( $('#seniorInfoTech').val() === 'Man' || $('#seniorInfoTech').val() === 'Woman' ) )
        ) {
            $('.trigger').addClass('error_2');
            error_2 = true;
        } else {
            $('.trigger').removeClass('error_2');
            $('.error_msg.error_2').hide();
			error_2 = false;
		}
        
        // check Q3
		if( // check if 3a is filled then disable 3b
            $('#gcSecCombined').val() !== '' || 
            $('#gcSecCombinedName').val() !== '' 
        ) {
            error_3a = true;
            $('#headOfLegal, #companySec').prop('disabled', true).closest('.row').css('opacity', 0.3);
            
            if( // if Man or Woman selected check if Name is entered
                $('#gcSecCombined').val() === '' ||
                ( $('#gcSecCombinedName').val() === '' && ( $('#gcSecCombined').val() === 'Man' || $('#gcSecCombined').val() === 'Woman' ) )
            ) {
                $('.trigger').addClass('error_3a');
                error_3a = true;
            } else {
                $('.trigger').removeClass('error_3a');
                $('.error_msg.error_3a').hide();
                error_3a = false;
            }
		} else {
            $('.trigger').removeClass('error_3a');
            $('.error_msg.error_3a').hide();
			error_3a = false;
            $('#headOfLegal, #companySec').prop('disabled', false).closest('.row').css('opacity', 1);
		}
		
		if( // check if 3b is filled then disable 3a
            $('#headOfLegal').val() !== '' || 
            $('#headOfLegalName').val() !== '' || 
            $('#companySec').val() !== '' || 
            $('#companySecName').val() !== '' 
        ) {
			error_3b = true;
            $('#gcSecCombined').prop('disabled', true).closest('.row').css('opacity', 0.3);
            
            if( // if Man or Woman selected check if Name is entered
                $('#headOfLegal').val() === '' || 
                ( $('#headOfLegalName').val() === '' && ( $('#headOfLegal').val() === 'Man' || $('#headOfLegal').val() === 'Woman' ) ) ||
                $('#companySec').val() === '' || 
                ( $('#companySecName').val() === '' && ( $('#companySec').val() === 'Man' || $('#companySec').val() === 'Woman' ) )
            ) {
                $('.trigger').addClass('error_3b');
                error_3b = true;
            } else {
                $('.trigger').removeClass('error_3b');
                $('.error_msg.error_3b').hide();
                error_3b = false;
            }
		} else {
            $('.trigger').removeClass('error_3b');
            $('.error_msg.error_3b').hide();
			error_3b = false;
            $('#gcSecCombined').prop('disabled', false).closest('.row').css('opacity', 1);
		}
        
        if( // if neither 3a or 3b is chosen throw error
            $('#gcSecCombined').val() === '' &&
            $('#gcSecCombinedName').val() === '' && 
            $('#headOfLegal').val() === '' &&
            $('#headOfLegalName').val() === '' && 
            $('#companySec').val() === '' &&
            $('#companySecName').val() === '' 
        ) {
            error_3 = true;
            $('.trigger').addClass('error_3');
        } else {
            error_3 = false;
            $('.error_msg.error_3').hide();
            $('.trigger').removeClass('error_3');
        }
	}
	
	function trigger() {
		if( errorEmpty || error_1 || error_2 || error_3 || error_3a || error_3b ) {
			$('.trigger').show();
			$('input.submit').prop('disabled', true);
		} else {
			$('.trigger').hide();
			$('input.submit').prop('disabled', false);
		}
	}
    
    validate();
    checkSec3();
    trigger();
	
	$('.page-gender-equality-data-collection input').on('keyup click blur', function(){
		validate();
	});
	
	$('.page-gender-equality-data-collection select, .page-gender-equality-data-collection input[type="text"]').on('click keyup blur change', function(){
		checkSec3();
	});
	
	$('.page-gender-equality-data-collection input, .page-gender-equality-data-collection select').on('click keyup blur change', function(){
		trigger();
	});
	
	$('.trigger').on('click', function(){
		if( $(this).hasClass('zero') ) {
			$('.error_msg.zero').show();
		}
		
		if( $(this).hasClass('error_1') ) {
			$('.error_msg.error_1').show();
		}
		
		if( $(this).hasClass('error_2') ) {
			$('.error_msg.error_2').show();
		}
		
		if( $(this).hasClass('error_3a') ) {
			$('.error_msg.error_3a').show();
		}
		
		if( $(this).hasClass('error_3b') ) {
			$('.error_msg.error_3b').show();
		}
		
		if( $(this).hasClass('error_3') ) {
			$('.error_msg.error_3').show();
		}
	});
	
	$('input.save').click(function(){
		$('.popUp').show();
	});
	
	$('.overlay-two').click(function(){
		$('.confirmBox').show();
	});
	
	$('.submit.close').click(function(){
		$('.confirmBox').hide();
	});
	
	$('#share-info').on('click', function(){
		if ($('#share-info').is(':checked')) {
			$('.overlay-two').hide();
		} else {
			$('.overlay-two').show();
		}
	});
	
	$('button.with-consent').on('click', function(){
		$('#share-info').prop('checked', true);
	});
    
});