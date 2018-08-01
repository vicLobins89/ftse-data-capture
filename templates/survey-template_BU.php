<?php
get_header();
if( !is_user_logged_in() ) {
	wp_redirect('member-login');
}
?>
<script type="text/javascript">
$(document).ready(function() {
	var totalOne;
	var totalTwo;
	
	
	
	$('input').on('keyup', function(){
		var empty = $('input').filter(function() {
			return this.value === "";
		});
		
		var repExecTotal = parseInt($('#repExecTotal').val());
		var repExecMen = parseInt($('#repExecMen').val());
		var repExecWomen = parseInt($('#repExecWomen').val());
		
		var repDirectTotal = parseInt($('#repDirectTotal').val());
		var repDirectMen = parseInt($('#repDirectMen').val());
		var repDirectWomen = parseInt($('#repDirectWomen').val());
		
		var turnExecAvgMen = parseInt($('#turnExecAvgMen').val());
		var turnExecJoinedMen = parseInt($('#turnExecJoinedMen').val());
		var turnExecLeftMen = parseInt($('#turnExecLeftMen').val());
		var turnExecAvgWomen = parseInt($('#turnExecAvgWomen').val());
		var turnExecJoinedWomen = parseInt($('#turnExecJoinedWomen').val());
		var turnExecLeftWomen = parseInt($('#turnExecLeftWomen').val());
		
		var turnDirectAvgMen = parseInt($('#turnDirectAvgMen').val());
		var turnDirectJoinedMen = parseInt($('#turnDirectJoinedMen').val());
		var turnDirectLeftMen = parseInt($('#turnDirectLeftMen').val());
		var turnDirectAvgWomen = parseInt($('#turnDirectAvgWomen').val());
		var turnDirectJoinedWomen = parseInt($('#turnDirectJoinedWomen').val());
		var turnDirectLeftWomen = parseInt($('#turnDirectLeftWomen').val());

		if(empty.length) {
			$('input.submit').prop('disabled', true);
		} else {
			repExecTotal != repExecMen + repExecWomen ? $('.execCalc').addClass('show') : $('.execCalc').removeClass('show');
			repDirectTotal != repDirectMen + repDirectWomen ? $('.dirCalc').addClass('show') : $('.dirCalc').removeClass('show');
			repExecMen != (turnExecAvgMen + turnExecJoinedMen) - turnExecLeftMen ? $('.menExecCalc').addClass('show') : $('.menExecCalc').removeClass('show');
			repExecWomen != (turnExecAvgWomen + turnExecJoinedWomen) - turnExecLeftWomen ? $('.womenExecCalc').addClass('show') : $('.womenExecCalc').removeClass('show');
			repDirectMen != (turnDirectAvgMen + turnDirectJoinedMen) - turnDirectLeftMen ? $('.menDirCalc').addClass('show') : $('.menDirCalc').removeClass('show');
			repDirectWomen != (turnDirectAvgWomen + turnDirectJoinedWomen) - turnDirectLeftWomen ? $('.womenDirCalc').addClass('show') : $('.womenDirCalc').removeClass('show');
			
			if( $('.error_msg.show').length) {
				$('input.submit').prop('disabled', true);
			} else {
				$('input.submit').prop('disabled', false);
			}
		}
	});
	
	$('#share-info').on('click', function(){
		if ( $(this).is(':checked') ) {
			$('.submit-wrap .overlay').hide();
		} else {
			$('.submit-wrap .overlay').show();
		}
	});
	
	$(window).on('load', function(){
		var empty = $('input').filter(function() {
			return this.value === "";
		});

		var repExecTotal = parseInt($('#repExecTotal').val());
		var repExecMen = parseInt($('#repExecMen').val());
		var repExecWomen = parseInt($('#repExecWomen').val());
		
		var repDirectTotal = parseInt($('#repDirectTotal').val());
		var repDirectMen = parseInt($('#repDirectMen').val());
		var repDirectWomen = parseInt($('#repDirectWomen').val());
		
		var turnExecAvgMen = parseInt($('#turnExecAvgMen').val());
		var turnExecJoinedMen = parseInt($('#turnExecJoinedMen').val());
		var turnExecLeftMen = parseInt($('#turnExecLeftMen').val());
		var turnExecAvgWomen = parseInt($('#turnExecAvgWomen').val());
		var turnExecJoinedWomen = parseInt($('#turnExecJoinedWomen').val());
		var turnExecLeftWomen = parseInt($('#turnExecLeftWomen').val());
		
		var turnDirectAvgMen = parseInt($('#turnDirectAvgMen').val());
		var turnDirectJoinedMen = parseInt($('#turnDirectJoinedMen').val());
		var turnDirectLeftMen = parseInt($('#turnDirectLeftMen').val());
		var turnDirectAvgWomen = parseInt($('#turnDirectAvgWomen').val());
		var turnDirectJoinedWomen = parseInt($('#turnDirectJoinedWomen').val());
		var turnDirectLeftWomen = parseInt($('#turnDirectLeftWomen').val());

		if(empty.length) {
			$('input.submit').prop('disabled', true);
		} else {
			repExecTotal != repExecMen + repExecWomen ? $('.execCalc').addClass('show') : $('.execCalc').removeClass('show');
			repDirectTotal != repDirectMen + repDirectWomen ? $('.dirCalc').addClass('show') : $('.dirCalc').removeClass('show');
			repExecMen != (turnExecAvgMen + turnExecJoinedMen) - turnExecLeftMen ? $('.menExecCalc').addClass('show') : $('.menExecCalc').removeClass('show');
			repExecWomen != (turnExecAvgWomen + turnExecJoinedWomen) - turnExecLeftWomen ? $('.womenExecCalc').addClass('show') : $('.womenExecCalc').removeClass('show');
			repDirectMen != (turnDirectAvgMen + turnDirectJoinedMen) - turnDirectLeftMen ? $('.menDirCalc').addClass('show') : $('.menDirCalc').removeClass('show');
			repDirectWomen != (turnDirectAvgWomen + turnDirectJoinedWomen) - turnDirectLeftWomen ? $('.womenDirCalc').addClass('show') : $('.womenDirCalc').removeClass('show');
			
			if( $('.error_msg.show').length) {
				$('input.submit').prop('disabled', true);
			} else {
				$('input.submit').prop('disabled', false);
			}
		}
		
		if ( $('#share-info').is(':checked') ) {
			$('.submit-wrap .overlay').hide();
		} else {
			$('.submit-wrap .overlay').show();
		}
	});

	function limitText(field, maxChar){
		var ref = $(field),
			val = ref.val();
		if ( val.length >= maxChar ){
			ref.val(function() {
				return val.substr(0, maxChar);       
			});
		}
	}
	
	$('input.save').click(function(){
		$('.popUp').show();
	});
	
	$('.overlay-two').click(function(){
		$('.confirmBox').show();
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
</script>

<?php
global $wpdb;
$surveyTable = $wpdb->prefix."survey_data";
$year = date('Y');
$years = $wpdb->get_results( "SELECT DISTINCT year FROM $surveyTable ORDER BY year ASC" );
$date = date('Ymdhis');
$deadline = $year . 3109;
$user = wp_get_current_user();

//get meta
$user_id = $user->id;
$meta = get_user_meta( $user_id );
$meta = array_filter( array_map( function( $a ) {
	return $a[0];
}, $meta ) );

$company = $meta['company_name'];

$currentData = $wpdb->get_row($wpdb->prepare("SELECT * FROM $surveyTable WHERE company = %s AND year = %d AND user_id = %d", $company, $year, $user_id));

//post form data
if ( !empty($_POST) ){
	
	if ( !isset($_POST['_wpnonce']) ) die( "<br><br>Hmm .. looks like you didn't send any credentials.. No CSRF for you! " );
	if ( !wp_verify_nonce($_POST['_wpnonce'], 'submit_gender_data') ) die( "<br><br>Hmm .. looks like you didn't send any credentials.. No CSRF for you! " );
	
	global $wpdb;
	
	if( isset($_POST['submitBtn2']) ){
		$locked = 1;
		
		$pageLocation = $_SERVER['PHP_SELF'].'/thank-you/';
		
		$message  = sprintf(__('Dear %s,'), $user->first_name) . "<br><br>";
		$message .= __('Thank you for completing your company’s gender data. This email confirms your company’s data has been successfully entered on the FTSE 350 Gender Data 2017 submission portal.') . "<br><br>";
		$message .= __('If you wish to see the data you submitted you can do this at any time by using this link:') . "<br>";
		
		$message .= __('<a href="http://ftsewomenleaders.com/member-login">Login</a>') . "<br><br>";
		
		$message .= __('or the Hampton-Alexander Review website at  <a href="http://ftsewomenleaders.com/">www.ftsewomenleaders.com</a> by selecting the "FTSE 2017 Data" tab and logging into your account.') . "<br><br>";
		$message .= __('We also encourage companies to publish details of the number of women on the Executive Committee and Direct Reports to, in their Annual Report and Accounts and\or on company websites.') . "<br><br>";
		$message .= __('If you have any questions please refer to the <a href="http://ftsewomenleaders.com/faqs">FAQ’s</a> or contact the team at <a href="mailto:info@ftsewomenleaders.com">info@ftsewomenleaders.com</a>.') . "<br><br>";
		$message .= __('Thank you for your continued support.') . "<br><br>";
		$message .= __('We look forward to sharing best practice and reporting on progress in November.') . "<br><br><br>";
		$message .= '<b>' . __('The Hampton-Alexander Review team') . "</b>";
		
		wp_mail($user->user_email, 'FTSE 350 Gender Data Submission portal – Confirmation of data submitted', $message);
	} else {
		$locked = 0;
		
		$pageLocation = $_SERVER['PHP_SELF'].'/gender-equality-data-collection/';
	}
	
	if (isset($_POST["share_info"]) && $_POST["share_info"] == 'Yes' ) {
		$shared = 'Yes';
	}else{  
		$shared = 'No';
	}
	
	$formData = array(
		'year'					=> $year,
		'user_id'				=> $user_id,
		'company'				=> $company,
		'repExecTotal'			=> $_POST["repExecTotal"],
		'repExecMen'			=> $_POST["repExecMen"],
		'repExecWomen'			=> $_POST["repExecWomen"],
		'repDirectTotal'		=> $_POST["repDirectTotal"],
		'repDirectMen'			=> $_POST["repDirectMen"],
		'repDirectWomen'		=> $_POST["repDirectWomen"],
		'turnExecAvgMen'		=> $_POST["turnExecAvgMen"],
		'turnExecAvgWomen'		=> $_POST["turnExecAvgWomen"],
		'turnExecJoinedMen'		=> $_POST["turnExecJoinedMen"],
		'turnExecJoinedWomen'	=> $_POST["turnExecJoinedWomen"],
		'turnExecLeftMen'		=> $_POST["turnExecLeftMen"],
		'turnExecLeftWomen'		=> $_POST["turnExecLeftWomen"],
		'turnDirectAvgMen'		=> $_POST["turnDirectAvgMen"],
		'turnDirectAvgWomen'	=> $_POST["turnDirectAvgWomen"],
		'turnDirectJoinedMen'	=> $_POST["turnDirectJoinedMen"],
		'turnDirectJoinedWomen'	=> $_POST["turnDirectJoinedWomen"],
		'turnDirectLeftMen'		=> $_POST["turnDirectLeftMen"],
		'turnDirectLeftWomen'	=> $_POST["turnDirectLeftWomen"],
		'share_info'			=> $shared,
		'locked'				=> $locked,
		'dateSubmitted'			=> $date
	);
	
	$formData = array_map( 'sanitize_text_field', $formData );

	$location = array(
		'user_id'	=> $user_id,
		'company'	=> $company,
		'year'		=> $year
	);

	$exists = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $surveyTable WHERE year = %d AND company = %s AND user_id = %d", $year, $company, $user_id));
	if ( $exists ) {
		unset($formData[0], $formData[1], $formData[2]);
		$wpdb->update( $surveyTable, $formData, $location );
	} else {
		$wpdb->insert( $surveyTable, $formData );
	}

	header('Location: ' . $pageLocation);
}
?>

<div class="popUp">
	You have successfully saved
</div>

<div id="account-info" class="page_textbox">
	<div class="panel-grid-cell">
		<div class="textwidget">
			<div class="logo"><img src="/wp-content/uploads/2017/04/ftse-women-leaders-logo.png" alt="Hampton Alexander Review" /></div>
			
			<h1 class="survey-title">FTSE 350 Gender Data Submission Portal</h1>
			
			<?php if( $attributes['show_title'] ) : ?>
				<h2><?php _e( 'Your Account', 'ftse-data-capture' ); ?></h2>
			<?php endif; ?>
			
			<h2 class="welcome">Hello, <?php echo $user->first_name .' '. $user->last_name; ?>.</h2>
			
			<h2>Your Account <a href="mailto:info@ftsewomenleaders.com?subject=[Hampton-Alexander Review] Account Details Change Request">Details incorrect? Contact us at info@ftsewomenleaders.com</a></h2>
			
			<div class="account-info left">
				<p><strong>Company Name:</strong> <?php echo $company; ?></p>
				<p><strong>Contact Name:</strong> <?php echo $user->nickname; ?></p>
				<p><strong>Contact Email:</strong> <?php echo $user->user_email; ?></p>
			</div>
			<div class="account-info right">
				<p><strong>Contact Phone:</strong> <?php echo $meta['contact_phone']; ?></p>
				<p><strong>Position/Job Title:</strong> <?php echo $meta['job_title']; ?></p>
				<p><strong>Sector:</strong> <?php echo $meta['sector']; ?></p>
			</div>
			
			<div class="clearfix"></div>
			
			<?php if( $currentData->locked == 0 ) : ?>
			
			<h2>Stage 2 – Submitting your Data</h2>
			
				<p>Please submit data on the online form below.
				<br><br>
				We would like data on the number of men and women on both the Executive Committee and Direct Reports to the Executive Committee as at 30 June 2017 and the turnover (total number of men and women who have left and/or joined between 1 July 2016 and 30 June 2017). 
				<br><br>
				This online form will be open for companies to submit their data from <strong>Friday 30 June until Friday 28 July 2017.</strong>
				<br><br>
				If you have any questions please refer to the <a href="/faqs/" target="_blank">FAQs</a> or contact the team at <a href="mailto:info@ftsewomenleaders.com">info@ftsewomenleaders.com</a>.
				</p>

				<div class="data-columns">
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"].'/gender-equality-data-collection/'); ?>" method="post">
						<div class="confirmBox">
							<p>We notice you have not given permission to use data your company submitted last year (2016).<br>Would you like to reconsider?</p>
							<button type="submit" name="submitBtn2" class="red-button submit with-consent">Yes, data submitted in 2016 can be used in future Hampton-Alexander reports.</button>
							<button type="submit" name="submitBtn2" class="red-button submit">No, I do not want data submitted in 2016 used in future Hampton-Alexander reports.</button>
						</div>
						
						<p><strong>Note: Please use whole numbers and use 0 (zero) to confirm that no men or no women were represented, or joined or left during the period.</strong></p>
						<br>
						<h5><b>Representation as at 30 June 2017</b></h5>

						<div class="section one total_check">
							<p><strong>Executive Committee Representation:</strong></p>
							<p><span>- Total number of Executive Committee members </span><input type="number" min="0" max="300" name="repExecTotal" id="repExecTotal" value="<?php echo $currentData->repExecTotal; ?>" /></p>
							<p><span>- Total number of Executive Committee members - Men </span><input type="number" min="0" max="300" name="repExecMen" id="repExecMen" value="<?php echo $currentData->repExecMen; ?>" /></p>
							<p><span>- Total number of Executive Committee members - Women </span><input type="number" min="0" max="300" name="repExecWomen" id="repExecWomen" value="<?php echo $currentData->repExecWomen; ?>" /></p>
							<div class="error_msg execCalc">Please make sure the total number of Executive Committee members add up.</div>
							<div class="error_msg menExecCalc">Please make sure Executive Committee Turnover (Men) adds up.</div>
							<div class="error_msg womenExecCalc">Please make sure Executive Committee Turnover (Women) adds up.</div>
						</div>

						<div class="section two total_check">
							<p><strong>Direct Reports to the Executive Committee (excluding administrative support staff):</strong></p>
							<p><span>- Total number of Direct Reports </span><input type="number" min="0" max="300" name="repDirectTotal" id="repDirectTotal" value="<?php echo $currentData->repDirectTotal; ?>" /></p>
							<p><span>- Total number of Direct Reports - Men </span><input type="number" min="0" max="300" name="repDirectMen" id="repDirectMen" value="<?php echo $currentData->repDirectMen; ?>" /></p>
							<p><span>- Total number of Direct Reports - Women </span><input type="number" min="0" max="300" name="repDirectWomen" id="repDirectWomen" value="<?php echo $currentData->repDirectWomen; ?>" /></p>
							<div class="error_msg dirCalc">Please make sure the total number of Direct Reports add up.</div>
							<div class="error_msg menDirCalc">Please make sure Direct Reports Turnover (Men) adds up.</div>
							<div class="error_msg womenDirCalc">Please make sure Direct Reports Turnover (Women) adds up.</div>
						</div>

						<h5 style="margin-top: 30px;"><b>Turnover from 1 July 2016 to 30 June 2017</b></h5>

						<div class="section three total_check">
							<p><strong><span>Executive Committee Turnover:</span><font>Men</font><font>Women</font></strong></p>

							<p><span>- Total number of Executive Committee members at the start of the year 1 July 2016:</span> <input type="number" min="0" max="300" name="turnExecAvgMen" id="turnExecAvgMen" value="<?php echo $currentData->turnExecAvgMen; ?>" /> <input type="number" min="0" max="300" name="turnExecAvgWomen" id="turnExecAvgWomen" value="<?php echo $currentData->turnExecAvgWomen; ?>" /></p>

							<p><span>- Total number of Executive Committee members that joined in the year to 30 June 2017:</span> <input type="number" min="0" max="300" name="turnExecJoinedMen" id="turnExecJoinedMen" value="<?php echo $currentData->turnExecJoinedMen; ?>" /> <input type="number" min="0" max="300" name="turnExecJoinedWomen" id="turnExecJoinedWomen" value="<?php echo $currentData->turnExecJoinedWomen; ?>" /></p>

							<p><span>- Total number of Executive Committee members that left in the year to 30 June 2017:</span> <input type="number" min="0" max="300" name="turnExecLeftMen" id="turnExecLeftMen" value="<?php echo $currentData->turnExecLeftMen; ?>" /> <input type="number" min="0" max="300" name="turnExecLeftWomen" id="turnExecLeftWomen" value="<?php echo $currentData->turnExecLeftWomen; ?>" /></p>
							
							<div class="error_msg menExecCalc">Please make sure Executive Committee Turnover (Men) adds up.</div>
							<div class="error_msg womenExecCalc">Please make sure Executive Committee Turnover (Women) adds up.</div>
						</div>

						<div class="section four total_check">
							<p><strong>Direct Reports to the Executive Committee (excluding administrative support staff):</strong></p>

							<p><span>- Total number of Direct Reports at the start of the year 1 July 2016:</span> <input type="number" min="0" max="300" name="turnDirectAvgMen" id="turnDirectAvgMen" value="<?php echo $currentData->turnDirectAvgMen; ?>" />  <input type="number" min="0" max="300" name="turnDirectAvgWomen" id="turnDirectAvgWomen" value="<?php echo $currentData->turnDirectAvgWomen; ?>" /></p>

							<p><span>- Total number of Direct Reports that joined in the year to 30 June 2017:</span> <input type="number" min="0" max="300" name="turnDirectJoinedMen" id="turnDirectJoinedMen" value="<?php echo $currentData->turnDirectJoinedMen; ?>" /> <input type="number" min="0" max="300" name="turnDirectJoinedWomen" id="turnDirectJoinedWomen" value="<?php echo $currentData->turnDirectJoinedWomen; ?>" /></p>

							<p><span>- Total number of Direct Reports that left in the year to 30 June 2017:</span> <input type="number" min="0" max="300" name="turnDirectLeftMen" id="turnDirectLeftMen" value="<?php echo $currentData->turnDirectLeftMen; ?>" /> <input type="number" min="0" max="300" name="turnDirectLeftWomen" id="turnDirectLeftWomen" value="<?php echo $currentData->turnDirectLeftWomen; ?>" /></p>
							
							<div class="error_msg menDirCalc">Please make sure Direct Reports Turnover (Men) adds up.</div>
							<div class="error_msg womenDirCalc">Please make sure Direct Reports Turnover (Women) adds up.</div>
						</div>

						<input type="checkbox" value="Yes" id="share-info" name="share_info"> Last year we collected gender data from FTSE 350 companies to use in the 2016 Hampton-Alexander report.<br>Please tick this box to confirm any data submitted in 2016 can be used in future Hampton-Alexander reports. 
						<br>
						<br>

						<div class="save-wrap"><input type="submit" name="submitBtn1" value="Save progress" class="green-button save" /></div>
						<div class="submit-wrap">
							<div class="overlay-two"></div>
							<input type="submit" name="submitBtn2" value="Submit" disabled class="red-button submit" />
						</div>
						<div class="clearfix"></div>
						
						<p class="note">Note: By pressing submit you agree to the data being used in Hampton-Alexander Reports. Please note once data has been submitted you will need to contact us to make changes.</p>
						<div class="clearfix"></div>
						
						<?php wp_nonce_field( 'submit_gender_data' ); ?>
					</form>
				</div>
			<?php else : ?>
			<h2>Your Data</h2>
				<div class="data-columns">
					<section class="locked">
						<h5><b>Representation as at 30 June 2017</b></h5>

						<div class="section">
							<p><strong>Executive Committee Representation:</strong></p>
							<p><span>- Total number of Executive Committee members </span><font><?php echo $currentData->repExecTotal; ?></font></p>
							<p><span>- Total number of Executive Committee members - Men </span><font><?php echo $currentData->repExecMen; ?></font></p>
							<p><span>- Total number of Executive Committee members - Women </span><font><?php echo $currentData->repExecWomen; ?></font></p>
						</div>

						<div class="section">
							<p><strong>Direct Reports to the Executive Committee (excluding administrative support staff):</strong></p>
							<p><span>- Total number of Direct Reports </span><font><?php echo $currentData->repDirectTotal; ?></font></p>
							<p><span>- Total number of Direct Reports - Men </span><font><?php echo $currentData->repDirectMen; ?></font></p>
							<p><span>- Total number of Direct Reports - Women </span><font><?php echo $currentData->repDirectWomen; ?></font></p>
						</div>

						<h5 style="margin-top: 30px;"><b>Turnover from 1 July 2016 to 30 June 2017</b></h5>

						<div class="section">
							<p><strong><span>Executive Committee Turnover:</span><font>Men</font><font>Women</font></strong></p>

							<p><span>- Total number of Executive Committee members at the start of the year 1 July 2016: </span> <font><?php echo $currentData->turnExecAvgMen; ?></font> <font><?php echo $currentData->turnExecAvgWomen; ?></font></p>

							<p><span>- Total number of Executive Committee members that joined in the year to 30 June 2017: </span> <font><?php echo $currentData->turnExecJoinedMen; ?></font> <font><?php echo $currentData->turnExecJoinedWomen; ?></font></p>

							<p><span>- Total number of Executive Committee members that left in the year to 30 June 2017: </span> <font><?php echo $currentData->turnExecLeftMen; ?></font> <font><?php echo $currentData->turnExecLeftWomen; ?></font></p>
						</div>

						<div class="section">
							<p><strong>Direct Reports to the Executive Committee (excluding administrative support staff):</strong></p>

							<p><span>- Total number of Direct Reports at the start of the year 1 July 2016:</span> <font><?php echo $currentData->turnDirectAvgMen; ?></font> <font><?php echo $currentData->turnDirectAvgWomen; ?></font></p>

							<p><span>- Total number of Direct Reports that joined in the year to 30 June 2017:</span> <font><?php echo $currentData->turnDirectJoinedMen; ?></font> <font><?php echo $currentData->turnDirectJoinedWomen; ?></font></p>

							<p><span>- Total number of Direct Reports that left in the year to 30 June 2017:</span> <font><?php echo $currentData->turnDirectLeftMen; ?></font> <font><?php echo $currentData->turnDirectLeftWomen; ?></font></p>
						</div>
					</section>
				</div>
			<?php endif; ?>
			
			<a href="<?php echo wp_logout_url( '/member-login/?logged_out=true' ); ?>" class="logout-link button">Logout</a>
		</div>
	</div>
</div>
	
<?php get_footer(); ?>