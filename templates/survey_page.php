<script type="text/javascript">
$(document).ready(function() {	
	var totalOne;
	var totalTwo;
	
	$('.total_check.one input').on('keyup', function(){
		limitText(this, 2);
		
		var empty = $('.total_check.one input').filter(function() {
			return this.value === "";
		});
		var total = parseInt($('#repExecTotal').val());
		var men = parseInt($('#repExecMen').val());
		var women = parseInt($('#repExecWomen').val());
		var current = parseInt($(this).val());

		if(empty.length) {
			$(this).parents('.section').find('.error_msg').text('');
		} else {
			if( total != men + women ) {
				$(this).parents('.section').find('.error_msg').text('Total does not add up');
				totalOne = false;
			} else {
				$(this).parents('.section').find('.error_msg').text('');
				totalOne = true;
			}
		}
	});
	
	$('.total_check.two input').on('keyup', function(){
		limitText(this, 3);
		
		var empty = $('.total_check.two input').filter(function() {
			return this.value === "";
		});
		var total = parseInt($('#repDirectTotal').val());
		var men = parseInt($('#repDirectMen').val());
		var women = parseInt($('#repDirectWomen').val());
		var current = parseInt($(this).val());

		if(empty.length) {
			$(this).parents('.section').find('.error_msg').text('');
		} else {
			if( total != men + women ) {
				$(this).parents('.section').find('.error_msg').text('Total does not add up');
				totalTwo = false;
			} else {
				$(this).parents('.section').find('.error_msg').text('');
				totalTwo = true;
			}
		}
	});
	
	$('input').on('keyup', function(){
		var empty = $('input').filter(function() {
			return this.value === "";
		});

		if(empty.length || !totalOne || !totalTwo) {
			$('input.submit').prop('disabled', true);
		} else {
			$('input.submit').prop('disabled', false);
		}
	});
	
	$(window).on('load', function(){
		var totalE = parseInt($('#repExecTotal').val());
		var menE = parseInt($('#repExecMen').val());
		var womenE = parseInt($('#repExecWomen').val());
		
		if( totalE != menE + womenE ) {
			totalOne = false;
		} else {
			totalOne = true;
		}
		
		var totalD = parseInt($('#repExecTotal').val());
		var menD = parseInt($('#repExecMen').val());
		var womenD = parseInt($('#repExecWomen').val());
		
		if( totalD != menD + womenD ) {
			totalTwo = false;
		} else {
			totalTwo = true;
		}
		
		var empty = $('input').filter(function() {
			return this.value === "";
		});

		if(empty.length || !totalOne || !totalTwo) {
			$('input.submit').prop('disabled', true);
		} else {
			$('input.submit').prop('disabled', false);
		}
	});

	function limitText(field, maxChar){
		var ref = $(field),
			val = ref.val();
		if ( val.length >= maxChar ){
			ref.val(function() {
				console.log(val.substr(0, maxChar))
				return val.substr(0, maxChar);       
			});
		}
	}
	
	$('input.save').click(function(){
		$('.popUp').show();
	});
});
</script>

<?php
global $wpdb;
$surveyTable = $wpdb->prefix."survey_data";
$year = date('Y');
$date = date('Ymd');
$deadline = $year . 3109;
$user = wp_get_current_user();

//get meta
$user_id = $user->id;
$meta = get_user_meta( $user_id );
$meta = array_filter( array_map( function( $a ) {
	return $a[0];
}, $meta ) );

$company = $meta['company_name'];

//get current data
//if($date > $deadline) {
//	$locked = '';
//	$wpdb->update( $surveyTable, array('locked' => 1), array('company' => $company, 'year' => $year, 'user_id' => $user_id) );
//} else {
//	$locked = 'AND locked = 1';
//}
//$surveyData = $wpdb->get_results( "SELECT * FROM $surveyTable WHERE company = '$company' AND locked = '1' ORDER BY year ASC" );
$currentData = $wpdb->get_row( "SELECT * FROM $surveyTable WHERE company = '$company' AND year = '$year' AND user_id = '$user_id'" );

//post form data
if ( !empty($_POST) ){
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
		$message .= '<b>' . __('Sir Philip Hampton and Dame Helen Alexander') . "</b><br><br>";
		$message .= '<b>' . __('Chair and Deputy Chair of the Hampton-Alexander Review') . "</b><br><br>";
		
		wp_mail($user->user_email, 'FTSE 350 Gender Data Submission portal – Confirmation of data submitted', $message);
	} else {
		$locked = 0;
		
		$pageLocation = $_SERVER['PHP_SELF'].'/gender-equality-data-collection/';
	}
	
	if (isset($_POST["share_info"]) && !empty($_POST["share_info"])) {
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
		'locked'				=> $locked
	);

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
			
			<h2>Stage 2 – Submitting data</h2>
			
				<p>Please submit data on the online form below.
				<br><br>
				We would like data on the number of men and women on both the Executive Committee and Direct Reports to the Executive Committee populations as at 30th June 2017 and the turnover (total number of men and women who have left and joined during the 2016 calendar year/or from 1 July 2016 to 20 June 2017).
				<br><br>
				This form will be open for companies to submit their data from <strong>Friday 30th June until to Friday 28 July 2017.</strong>
				<br><br>
				If you have any questions please refer to the <a href="/faqs/">FAQ page</a> or contact the team at <a href="mailto:info@ftsewomenleaders.com">info@ftsewomenleaders.com</a>.
				</p>

				<div class="data-columns">
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"].'/gender-equality-data-collection/'); ?>" method="post">
						<p><strong>Note: Please use whole numbers.</strong></p>
						<br>
						<h5><b>Representation as at 30 June 2017</b></h5>

						<div class="section one total_check">
							<p><strong>Executive Committee Representation:</strong></p>
							<p><span>- Total number of Executive Committee members </span><input type="number" min="0" max="300" name="repExecTotal" id="repExecTotal" value="<?php echo $currentData->repExecTotal; ?>" /></p>
							<p><span>- Total number of Executive Committee members - Men </span><input type="number" min="0" max="300" name="repExecMen" id="repExecMen" value="<?php echo $currentData->repExecMen; ?>" /></p>
							<p><span>- Total number of Executive Committee members - Women </span><input type="number" min="0" max="300" name="repExecWomen" id="repExecWomen" value="<?php echo $currentData->repExecWomen; ?>" /></p>
							<span class="error_msg"></span>
						</div>

						<div class="section two total_check">
							<p><strong>Direct Reports to the Executive Committee (excluding administrative staff):</strong></p>
							<p><span>- Total number of Direct Reports </span><input type="number" min="0" max="300" name="repDirectTotal" id="repDirectTotal" value="<?php echo $currentData->repDirectTotal; ?>" /></p>
							<p><span>- Total number of Direct Reports - Men </span><input type="number" min="0" max="300" name="repDirectMen" id="repDirectMen" value="<?php echo $currentData->repDirectMen; ?>" /></p>
							<p><span>- Total number of Direct Reports - Women </span><input type="number" min="0" max="300" name="repDirectWomen" id="repDirectWomen" value="<?php echo $currentData->repDirectWomen; ?>" /></p>
							<span class="error_msg"></span>
						</div>

						<h5 style="margin-top: 30px;"><b>Turnover during 2016</b></h5>

						<div class="section">
							<p><strong><span>Executive Committee Turnover:</span><font>Men</font><font>Women</font></strong></p>

							<p><span>- Average number of Executive Committee members in the year: </span> <input type="number" min="0" max="300" name="turnExecAvgMen" value="<?php echo $currentData->turnExecAvgMen; ?>" /> <input type="number" min="0" max="300"name="turnExecAvgWomen" value="<?php echo $currentData->turnExecAvgWomen; ?>" /></p>

							<p><span>- Total number of Executive Committee members that joined during 2016 </span> <input type="number" min="0" max="300" name="turnExecJoinedMen" value="<?php echo $currentData->turnExecJoinedMen; ?>" /> <input type="number" min="0" max="300"name="turnExecJoinedWomen" value="<?php echo $currentData->turnExecJoinedWomen; ?>" /></p>

							<p><span>- Total number of Executive Committee members that left during 2016</span> <input type="number" min="0" max="300" name="turnExecLeftMen" value="<?php echo $currentData->turnExecLeftMen; ?>" /> <input type="number" min="0" max="300"name="turnExecLeftWomen" value="<?php echo $currentData->turnExecLeftWomen; ?>" /></p>
						</div>

						<div class="section">
							<p><strong>Direct Reports to the Executive Committee (excluding administrative staff):</strong></p>

							<p><span>- Average number of Direct Reports:</span> <input type="number" min="0" max="300" name="turnDirectAvgMen" value="<?php echo $currentData->turnDirectAvgMen; ?>" />  <input type="number" min="0" max="300"name="turnDirectAvgWomen" value="<?php echo $currentData->turnDirectAvgWomen; ?>" /></p>

							<p><span>- Total number of Direct Reports that joined during 2016:</span> <input type="number" min="0" max="300" name="turnDirectJoinedMen" value="<?php echo $currentData->turnDirectJoinedMen; ?>" /> <input type="number" min="0" max="300"name="turnDirectJoinedWomen" value="<?php echo $currentData->turnDirectJoinedWomen; ?>" /></p>

							<p><span>- Total number of Direct Reports that left during 2016:</span> <input type="number" min="0" max="300" name="turnDirectLeftMen" value="<?php echo $currentData->turnDirectLeftMen; ?>" /> <input type="number" min="0" max="300"name="turnDirectLeftWomen" value="<?php echo $currentData->turnDirectLeftWomen; ?>" /></p>
						</div>

						<input type="checkbox" value="Yes" id="share-info" name="share_info"> Your company may have provided the same data for 2016. If you're happy to share this data for future HA reports please tick this box.
						<br>
						<br>

						<input type="submit" name="submitBtn1" value="Save" class="green-button save" />
						<input type="submit" name="submitBtn2" value="Submit" disabled class="red-button submit" />
						<p class="note">Note: once submitted you cannot change data.</p>
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
							<p><strong>Direct Reports to the Executive Committee (excluding administrative staff):</strong></p>
							<p><span>- Total number of Direct Reports </span><font><?php echo $currentData->repDirectTotal; ?></font></p>
							<p><span>- Total number of Direct Reports - Men </span><font><?php echo $currentData->repDirectMen; ?></font></p>
							<p><span>- Total number of Direct Reports - Women </span><font><?php echo $currentData->repDirectWomen; ?></font></p>
						</div>

						<h5 style="margin-top: 30px;"><b>Turnover during 2016</b></h5>

						<div class="section">
							<p><strong><span>Executive Committee Turnover:</span><font>Men</font><font>Women</font></strong></p>

							<p><span>- Average number of Executive Committee members in the year: </span> <font><?php echo $currentData->turnExecAvgMen; ?></font> <font><?php echo $currentData->turnExecAvgWomen; ?></font></p>

							<p><span>- Total number of Executive Committee members that joined during 2016 </span> <font><?php echo $currentData->turnExecJoinedMen; ?></font> <font><?php echo $currentData->turnExecJoinedWomen; ?></font></p>

							<p><span>- Total number of Executive Committee members that left during 2016</span> <font><?php echo $currentData->turnExecLeftMen; ?></font> <font><?php echo $currentData->turnExecLeftWomen; ?></font></p>
						</div>

						<div class="section">
							<p><strong>Direct Reports to the Executive Committee (excluding administrative staff):</strong></p>

							<p><span>- Average number of Direct Reports:</span> <font><?php echo $currentData->turnDirectAvgMen; ?></font> <font><?php echo $currentData->turnDirectAvgWomen; ?></font></p>

							<p><span>- Total number of Direct Reports that joined during 2016:</span> <font><?php echo $currentData->turnDirectJoinedMen; ?></font> <font><?php echo $currentData->turnDirectJoinedWomen; ?></font></p>

							<p><span>- Total number of Direct Reports that left during 2016:</span> <font><?php echo $currentData->turnDirectLeftMen; ?></font> <font><?php echo $currentData->turnDirectLeftWomen; ?></font></p>
						</div>
					</section>
				</div>
			<?php endif; ?>
			
			<a href="<?php echo wp_logout_url( '/member-login/?logged_out=true' ); ?>" class="logout-link button">Logout</a>
		</div>
	</div>
</div>