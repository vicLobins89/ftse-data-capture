<?php
global $wpdb;
$surveyTable = $wpdb->prefix."survey_data";
$year = date('Y');
$date = date('Ymdhis');
$deadline = $year . 3109;
$user = wp_get_current_user();

//get meta
$user_id = $user->ID;
$meta = get_user_meta( $user_id );
$meta = array_filter( array_map( function( $a ) {
	return $a[0];
}, $meta ) );

$company = $user->user_login;
$ftse = $meta['ftseIndex'];

$currentData = $wpdb->get_row($wpdb->prepare("SELECT * FROM $surveyTable WHERE company = %s AND year = %d AND user_id = %d", $company, $year, $user_id));
$pastData = $wpdb->get_results($wpdb->prepare("SELECT * FROM $surveyTable WHERE year <> %d AND company = %s ORDER BY year DESC", $year, $company));

//post form data
if ( !empty($_POST) ){
	
	if ( !isset($_POST['_wpnonce']) ) die( "<br><br>Hmm .. looks like you didn't send any credentials.. No CSRF for you! " );
	if ( !wp_verify_nonce($_POST['_wpnonce'], 'submit_gender_data') ) die( "<br><br>Hmm .. looks like you didn't send any credentials.. No CSRF for you! " );
	
	global $wpdb;
	
	if( isset($_POST['submitBtn2']) ){
		$locked = 1;
		
		$pageLocation = $_SERVER['PHP_SELF'].'/thank-you/';
		
		$message  = sprintf(__('Dear %s,'), $user->first_name) . "<br><br>";
		$message .= __('Thank you for submitting your company’s gender data. This email confirms your company’s data has been successfully entered on the FTSE 350 Gender Data Submission Portal.') . "<br><br>";
		$message .= __('If you wish to see the gender data you submitted you can do this at any time by using this link:') . "<br>";
		
		$message .= __('<a href="http://ftsewomenleaders.com/member-login">Login</a>') . "<br><br>";
		
		$message .= __('or visit the Hampton-Alexander Review website at  <a href="http://ftsewomenleaders.com/">www.ftsewomenleaders.com</a> by selecting the "FTSE 2019 Data" tab and logging into your account.') . "<br><br>";
		$message .= __('In line with the recommendations of the Hampton-Alexander Review we also encourage companies to publish details of the number of women on the Executive Committee and the Direct Reports to the Executive Committee in their Annual Report and Accounts and/or on their websites.') . "<br><br>";
		$message .= __('If you have any questions please refer to the <a href="http://ftsewomenleaders.com/faqs">FAQ’s</a> or contact the team at <a href="mailto:info@ftsewomenleaders.com">info@ftsewomenleaders.com</a>.') . "<br><br>";
		$message .= __('Thank you for your continued support.') . "<br><br>";
		$message .= __('We look forward to sharing best practice and reporting on progress in our annual report which will be published on the 13<sup>th</sup> November 2019') . "<br><br><br>";
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
		'contact_name'			=> $user->nickname,
		'contact_email'			=> $user->user_email,
		'ftse'					=> $ftse,
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
		'leadingExec'			=> $_POST["leadingExec"],
		'leadingExecName'		=> $_POST["leadingExecName"],
		'gcSecCombined'			=> $_POST["gcSecCombined"],
		'gcSecCombinedName'		=> $_POST["gcSecCombinedName"],
		'headOfLegal'			=> $_POST["headOfLegal"],
		'headOfLegalName'		=> $_POST["headOfLegalName"],
		'companySec'			=> $_POST["companySec"],
		'companySecName'		=> $_POST["companySecName"],
		'seniorInfoTech'		=> $_POST["seniorInfoTech"],
		'seniorInfoTechName'	=> $_POST["seniorInfoTechName"],
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

$options = get_option('rh_settings');
?>

<div class="popUp">
	You have successfully saved
</div>

<div id="account-info" class="page_textbox">
	<div class="panel-grid-cell">
		<div class="textwidget">
			<div class="logo">
				<?php
				if($options['logo']){
					echo '<img src="'. $options['logo'] .'" alt="'. get_bloginfo('name') .'" />';
				} else {
					echo '<img src="/wp-content/uploads/2017/04/ftse-women-leaders-logo.png" alt="Hampton Alexander Review" />';
				}
				?>
			</div>
			
			<h1 class="survey-title">FTSE 350 Gender Data Submission Portal</h1>
			
			<?php if( $attributes['show_title'] ) : ?>
				<h2><?php _e( 'Your Account', 'ftse-data-capture' ); ?></h2>
			<?php endif; ?>
			
			<h2 class="welcome">Hello, <?php echo $user->first_name .' '. $user->last_name; ?>.</h2>
			
			<h2>User Details <a href="mailto:info@ftsewomenleaders.com?subject=[Hampton-Alexander Review] Account Details Change Request">Details incorrect? Contact us at info@ftsewomenleaders.com</a></h2>
			
			<div class="account-info left">
				<p><strong>Company Name:</strong> <?php echo $meta['company_name']; ?></p>
				<p><strong>Sector:</strong> <?php echo $meta['sector']; ?></p>
				<p><strong>Contact Name:</strong> <?php echo $user->nickname; ?></p>
				<p><strong>Position/Job Title:</strong> <?php echo $meta['job_title']; ?></p>
			</div>
			<div class="account-info right">
				<p><strong>Work Email:</strong> <?php echo $user->user_email; ?></p>
				<p><strong>Work Landline Number:</strong> <?php echo $meta['contact_phone']; ?></p>
				<p><strong>Work Mobile Number:</strong> <?php echo $meta['mobile_phone']; ?></p>
			</div>
			
			<div class="clearfix"></div>
			
			<h2>Submitting your Data</h2>
			
			<p>Please read the guidance provided in the <a href="http://ftsewomenleaders.com/faqs" target="_blank">FAQ’s</a> before completing and if you have further questions please contact the team at <a href="mailto:info@ftsewomenleaders.com.">info@ftsewomenleaders.com.</a></p>
			
			<p>This online form will be open for companies to submit their gender data from Monday 1 July until Wednesday 31 July 2019.</p>
			
			<p><strong>Sections 1 and 2:</strong> We would like data on the number of men and women on both the Executive Committee and Direct Reports to the Executive Committee as at 30 June 2019 and the turnover (total number of men and women who have left and/or joined between 1 July 2018 and 30 June 2019).</p>
			
			<p><strong>Section 3:</strong> We would like data on the gender and name of the holders of key functional roles as set out below. The purpose of this data is to provide better understanding of the gender balance in key functional roles.</p>
			
			<div class="tab">
				<button class="tablinks" onclick="openTab(event, 'tab<?php echo $year ;?>')" id="defaultOpen"><?php echo $year ;?></button>
				<?php foreach($pastData as $allData) { ?>
				<button
						class="tablinks" 
						onclick="openTab(event, 'tab<?php echo $allData->year ;?>')"><?php echo $allData->year ;?></button>
				<?php } ?>
			</div>
			
			<div class="tabbed-content">
				<div id="tab<?php echo $year; ?>" class="tabcontent data-columns <?php echo $year; ?>">
					<?php if($currentData->locked == 0) : ?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"].'/gender-equality-data-collection/'); ?>" method="post">
					<?php else : ?>
					<form class="locked" style="padding-top: 0; padding-bottom: 0;"><fieldset disabled>
					<?php endif; ?>
						<div class="confirmBox">
							<p>These calculations will be used in the publications from the Hampton-Alexander Review. I agree that to the best of my knowledge the submitted data is accurate and correct.</p>
							<button type="submit" name="submitBtn2" class="green-button submit with-consent">Accept and Submit</button>
							<button class="green-button submit close">Cancel</button>
						</div>
						
						<?php if($currentData->locked == 0) : ?>
						<p style="font-style: italic;">
							<strong>You will not be able to amend previous years data.</strong>
							<br>
							<strong>Use whole numbers and use 0 (zero) where applicable.</strong>
							<br>
							<strong>You will not be able to submit the data until all fields are complete.</strong>
						</p>
						<br>
						<?php endif; ?>
						
						<div class="section-wrapper top locked">
							<!-- SECTION 1 -->
							
							<h4><strong>Section 1</strong></h4>
							
							<div class="section one">
								<div class="cf row row-1">
									<div class="col col-info">
										<h5>
											<b>Executive Committee</b>
										</h5>
									</div>
									<div class="col col-num" style="text-align: left;">Men</div>
									<div class="col col-num">Women</div>
									<div class="col col-num">Total</div>
								</div>
								
								<div class="cf row row-2">
									<div class="col col-info">
										Executive Committee members* at the start of the year 1 July <?php echo $year-1; ?><br>
										<em>*Excludes administrative and support staff</em>
									</div>
									
									<div class="col col-num">
										<label for="turnExecAvgMen">Men</label>
										<input type="number" min="0" max="300" name="turnExecAvgMen" id="turnExecAvgMen" value="<?php echo $currentData->turnExecAvgMen; ?>"  />
									</div>
									
									<div class="col col-num">
										<label for="turnExecAvgWomen">Women</label>
										<input type="number" min="0" max="300" name="turnExecAvgWomen" id="turnExecAvgWomen" value="<?php echo $currentData->turnExecAvgWomen; ?>" />
									</div>
									
									<div class="col col-num total">
										<label for="turnExecAvgTotal">Total</label>
										<input type="number" min="0" max="300" name="turnExecAvgTotal" id="turnExecAvgTotal" value="" />
									</div>
								</div>
								
								<div class="cf row row-3">
									<div class="col col-info">
										Executive Committee members that left in the year to 30 June <?php echo $year; ?> <span class="tooltip">i<span class="tooltiptext"><strong>Note:</strong> When calculating leavers, include all internal moves due to promotion/sideways move/demotions and all external moves due to resignations/retirement/redundancies.</span></span>
									</div>
									
									<div class="col col-num">
										<label for="turnExecLeftMen">Men</label>
										<input type="number" min="0" max="300" name="turnExecLeftMen" id="turnExecLeftMen" value="<?php echo $currentData->turnExecLeftMen; ?>" />
									</div>
									
									<div class="col col-num">
										<label for="turnExecLeftWomen">Women</label>
										<input type="number" min="0" max="300" name="turnExecLeftWomen" id="turnExecLeftWomen" value="<?php echo $currentData->turnExecLeftWomen; ?>" />
									</div>
									
									<div class="col col-num">
									</div>
								</div>
								
								<div class="cf row row-4">
									<div class="col col-info">
										Executive Committee members that joined in the year to 30 June <?php echo $year; ?> <span class="tooltip">i<span class="tooltiptext"><strong>Note:</strong> When calculating joiners, include all internal moves due to promotion/sideways move/demotions and all external recruitment hires.</span></span>
									</div>
									
									<div class="col col-num">
										<label for="turnExecJoinedMen">Men</label>
										<input type="number" min="0" max="300" name="turnExecJoinedMen" id="turnExecJoinedMen" value="<?php echo $currentData->turnExecJoinedMen; ?>" />
									</div>
									
									<div class="col col-num">
										<label for="turnExecJoinedWomen">Women</label>
										<input type="number" min="0" max="300" name="turnExecJoinedWomen" id="turnExecJoinedWomen" value="<?php echo $currentData->turnExecJoinedWomen; ?>" />
									</div>
									
									<div class="col col-num">
									</div>
								</div>
								
								<div class="cf row row-5">
									<div class="col col-info">
										<strong>Total number of Executive Committee members as at 30 June <?php echo $year; ?></strong>
									</div>
									
									<div class="col col-num">
										<label for="repExecMen">Men</label>
										<input type="number" min="0" max="300" name="repExecMen" id="repExecMen" readonly="readonly" value="<?php echo $currentData->repExecMen; ?>" />
									</div>
									
									<div class="col col-num">
										<label for="repExecWomen">Women</label>
										<input type="number" min="0" max="300" name="repExecWomen" id="repExecWomen" readonly="readonly" value="<?php echo $currentData->repExecWomen; ?>" />
									</div>
									
									<div class="col col-num total">
										<label for="repExecTotal">Total</label>
										<input type="number" min="0" max="300" name="repExecTotal" id="repExecTotal" readonly="readonly" value="<?php echo $currentData->repExecTotal; ?>" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="section-wrapper locked">
							<!-- SECTION 2 -->
							
							<h4><strong>Section 2</strong></h4>
							
							<div class="section one">
								<div class="cf row row-1">
									<div class="col col-info">
										<h5>
											<b>Direct Reports to the Executive Committee</b>
										</h5>
									</div>
									<div class="col col-num" style="text-align: left;">Men</div>
									<div class="col col-num">Women</div>
									<div class="col col-num">Total</div>
								</div>
								
								<div class="cf row row-2">
									<div class="col col-info">
										Direct Reports* at the start of the year 1 July <?php echo $year-1; ?><br>
										<em>*Excludes administrative and support staff</em>
									</div>
									
									<div class="col col-num">
										<label for="turnDirectAvgMen">Men</label>
										<input type="number" min="0" max="300" name="turnDirectAvgMen" id="turnDirectAvgMen" value="<?php echo $currentData->turnDirectAvgMen; ?>" />
									</div>
									
									<div class="col col-num">
										<label for="turnDirectAvgWomen">Women</label>
										<input type="number" min="0" max="300" name="turnDirectAvgWomen" id="turnDirectAvgWomen" value="<?php echo $currentData->turnDirectAvgWomen; ?>" />
									</div>
									
									<div class="col col-num total">
										<label for="turnDirectAvgTotal">Total</label>
										<input type="number" min="0" max="300" name="turnDirectAvgTotal" id="turnDirectAvgTotal" value="" />
									</div>
								</div>
								
								<div class="cf row row-3">
									<div class="col col-info">
										Direct Reports that left in the year to 30 June <?php echo $year; ?> <span class="tooltip">i<span class="tooltiptext"><strong>Note:</strong> When calculating leavers, include all internal moves due to promotion/sideways move/demotions and all external moves due to resignations/retirement/redundancies.</span></span>
									</div>
									
									<div class="col col-num">
										<label for="turnDirectLeftMen">Men</label>
										<input type="number" min="0" max="300" name="turnDirectLeftMen" id="turnDirectLeftMen" value="<?php echo $currentData->turnDirectLeftMen; ?>" />
									</div>
									
									<div class="col col-num">
										<label for="turnDirectLeftWomen">Women</label>
										<input type="number" min="0" max="300" name="turnDirectLeftWomen" id="turnDirectLeftWomen" value="<?php echo $currentData->turnDirectLeftWomen; ?>" />
									</div>
									
									<div class="col col-num">
									</div>
								</div>
								
								<div class="cf row row-4">
									<div class="col col-info">
										Direct Reports that joined in the year to 30 June <?php echo $year; ?> <span class="tooltip">i<span class="tooltiptext"><strong>Note:</strong> When calculating joiners, include all internal moves due to promotion/sideways move/demotions and all external recruitment hires.</span></span>
									</div>
									
									<div class="col col-num">
										<label for="turnDirectJoinedMen">Men</label>
										<input type="number" min="0" max="300" name="turnDirectJoinedMen" id="turnDirectJoinedMen" value="<?php echo $currentData->turnDirectJoinedMen; ?>" />
									</div>
									
									<div class="col col-num">
										<label for="turnDirectJoinedWomen">Women</label>
										<input type="number" min="0" max="300" name="turnDirectJoinedWomen" id="turnDirectJoinedWomen" value="<?php echo $currentData->turnDirectJoinedWomen; ?>" />
									</div>
									
									<div class="col col-num">
									</div>
								</div>
								
								<div class="cf row row-5">
									<div class="col col-info">
										<strong>Total number of Direct Reports as at 30 June <?php echo $year; ?></strong>
									</div>
									
									<div class="col col-num">
										<label for="repDirectMen">Men</label>
										<input type="number" min="0" max="300" name="repDirectMen" id="repDirectMen" readonly="readonly" value="<?php echo $currentData->repDirectMen; ?>" />
									</div>
									
									<div class="col col-num">
										<label for="repDirectWomen">Women</label>
										<input type="number" min="0" max="300" name="repDirectWomen" id="repDirectWomen" readonly="readonly" value="<?php echo $currentData->repDirectWomen; ?>" />
									</div>
									
									<div class="col col-num total">
										<label for="repDirectTotal">Total</label>
										<input type="number" min="0" max="300" name="repDirectTotal" id="repDirectTotal" readonly="readonly" value="<?php echo $currentData->repDirectTotal; ?>" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="section-wrapper locked">
							<!-- SECTION 3 -->
							
							<h4><strong>Section 3</strong></h4>
							
							<div class="section three">
								<div class="cf row row-1">
									<div class="col">
										<h5>
											<b>Functional Roles</b>
										</h5>
									</div>
								</div>
								
								<div class="cf row">
									<div class="col col-info" style="width: 100%;">
										Please provide the gender and name of holders of key functional roles below:
									</div>
								</div>
								
								<div class="cf row">
									<div class="col col-info">
										<strong>1.</strong> Human Resources Director (HRD) or most senior executive responsible for people and talent management
									</div>
									
									<div class="col">
										<p>Gender: </p>
										<select name="leadingExec" id="leadingExec">
											<option value="">Please Select</option>
											<option <?php if ($currentData->leadingExec == 'Man') echo 'selected' ; ?> value="Man">Man</option>
											<option  <?php if ($currentData->leadingExec == 'Woman') echo 'selected' ; ?> value="Woman">Woman</option>
										</select>
										<br>
										<p>Name: </p>
										<input class="names" type="text" name="leadingExecName" id="leadingExecName" value="<?php echo $currentData->leadingExecName; ?>" />
									</div>
								</div>
								
								<div class="cf row">
									<div class="col col-info">
										<strong>2.</strong> Chief Information Officer (CIO) or most senior executive responsible for systems and technology
									</div>
									
									<div class="col">
										<p>Gender: </p>
										<select name="seniorInfoTech" id="seniorInfoTech">
											<option value="">Please Select</option>
											<option <?php if ($currentData->seniorInfoTech == 'Man') echo 'selected' ; ?> value="Man">Man</option>
											<option  <?php if ($currentData->seniorInfoTech == 'Woman') echo 'selected' ; ?> value="Woman">Woman</option>
										</select>
										<br>
										<p>Name: </p>
										<input class="names" type="text" name="seniorInfoTechName" id="seniorInfoTechName" value="<?php echo $currentData->seniorInfoTechName; ?>" />
									</div>
								</div>
								
								<div class="cf row">
									<div class="col col-info">
										<strong>3.</strong> Please answer only (a) where this a combined role or (b) where these are separate roles
									</div>
								</div>
								
								<div class="cf row sub-section a">
									<div class="col col-info">
										<strong>(a)</strong> Group Counsel and Company Secretary
									</div>
									
									<div class="col">
										<p>Gender: </p>
										<select name="gcSecCombined" id="gcSecCombined">
											<option value="">Please Select</option>
											<option <?php if ($currentData->gcSecCombined == 'Man') echo 'selected' ; ?> value="Man">Man</option>
											<option <?php if ($currentData->gcSecCombined == 'Woman') echo 'selected' ; ?> value="Woman">Woman</option>
										</select>
										<br>
										<p>Name: </p>
										<input class="names" type="text" name="gcSecCombinedName" id="gcSecCombinedName" value="<?php echo $currentData->gcSecCombinedName; ?>" />
									</div>
								</div>
								
								<div class="cf row sub-section b">
									<div class="col col-info">
										<strong>(b)</strong> Group Counsel
									</div>
									
									<div class="col">
										<p>Gender: </p>
										<select name="headOfLegal" id="headOfLegal">
											<option value="">Please Select</option>
											<option <?php if ($currentData->headOfLegal == 'Man') echo 'selected' ; ?> value="Man">Man</option>
											<option <?php if ($currentData->headOfLegal == 'Woman') echo 'selected' ; ?> value="Woman">Woman</option>
										</select>
										<br>
										<p>Name: </p>
										<input class="names" type="text" name="headOfLegalName" id="headOfLegalName" value="<?php echo $currentData->headOfLegalName; ?>" />
									</div>
									
									<div class="col col-info" style="padding: 0 0 0 2.1rem;">
										<strong>and</strong>
									</div>
								</div>
								
								<div class="cf row sub-section c">
									<div class="col col-info" style="padding: 0 0 0 2.1rem;">
										Company Secretary
									</div>
									
									<div class="col">
										<p>Gender: </p>
										<select name="companySec" id="companySec">
											<option value="">Please Select</option>
											<option <?php if ($currentData->companySec == 'Man') echo 'selected' ; ?> value="Man">Man</option>
											<option <?php if ($currentData->companySec == 'Woman') echo 'selected' ; ?> value="Woman">Woman</option>
										</select>
										<br>
										<p>Name: </p>
										<input class="names" type="text" name="companySecName" id="companySecName" value="<?php echo $currentData->companySecName; ?>" />
									</div>
								</div>
							</div>
						</div>

						<?php if($currentData->locked == 0) : ?>
						<br>
						
						<p class="error_msg neg">Total number of Executive Committee members cannot be less than zero</p>
						<p class="error_msg zero">Please make sure you complete all required fields in Section 1 and 2</p>
						<p class="error_msg sec3">Please make sure you complete all required fields in Section 3</p>
						<p class="error_msg 2ab">Please complete <strong>either</strong> 2(a) or 2(b)</p>
						<div class="save-wrap"><input type="submit" name="submitBtn1" value="Save only" class="green-button save" /></div>
						<div class="submit-wrap">
							<div class="overlay-two"></div>
							<div class="trigger"></div>
							<input type="submit" name="submitBtn2" value="Save & Submit" disabled class="green-button submit" />
						</div>
						<div class="clearfix"></div>

						<p class="note">Note: By pressing submit you agree to the data being used in Hampton-Alexander Reports. Please note once data has been submitted you will need to contact us to make changes.</p>
						<div class="clearfix"></div>

						<?php wp_nonce_field( 'submit_gender_data' ); ?>
						<?php endif; ?>
						
						<?php if($currentData->locked == 1) : ?>
						</fieldset>
						<?php endif; ?>
					</form>
				</div>
				
			<?php foreach($pastData as $allData) { ?>
				<div id="tab<?php echo $allData->year; ?>" class="tabcontent data-columns <?php echo (($year-1 == $allData->year) ? 'last-year' : 'past-years'); ?>">
					<?php if( $allData->locked == 0 ) : ?>
						
					<?php else : ?>
						<section class="locked section-wrapper top">
							<!-- SECTION 1 -->
							
							<h4><strong>Section 1</strong></h4>
							
							<div class="section one">
								<div class="cf row row-1">
									<div class="col col-info">
										<h5>
											<b>Executive Committee Representation</b>
										</h5>
									</div>
									<div class="col col-num">Men</div>
									<div class="col col-num">Women</div>
									<div class="col col-num">Total</div>
								</div>
								
								<div class="cf row row-2">
									<div class="col col-info">
										Executive Committee members at the start of the year 1 July <?php echo $allData->year-1; ?>
									</div>
									
									<div class="col col-num">
										<p><?php echo $allData->turnExecAvgMen; ?></p>
									</div>
									
									<div class="col col-num">
										<p><?php echo $allData->turnExecAvgWomen; ?></p>
									</div>
									
									<div class="col col-num">
										<p><?php echo $allData->turnExecAvgMen + $allData->turnExecAvgWomen; ?></p>
									</div>
								</div>
								
								<div class="cf row row-3">
									<div class="col col-info">
										Executive Committee members that left in the year to 30 June <?php echo $allData->year; ?>
									</div>
									
									<div class="col col-num">
										<p><?php echo $allData->turnExecLeftMen; ?></p>
									</div>
									
									<div class="col col-num">
										<p><?php echo $allData->turnExecLeftWomen; ?></p>
									</div>
									
									<div class="col col-num">
									</div>
								</div>
								
								<div class="cf row row-4">
									<div class="col col-info">
										Executive Committee members that joined in the year to 30 June <?php echo $allData->year; ?>
									</div>
									
									<div class="col col-num">
										<p><?php echo $allData->turnExecJoinedMen; ?></p>
									</div>
									
									<div class="col col-num">
										<p><?php echo $allData->turnExecJoinedWomen; ?></p>
									</div>
									
									<div class="col col-num">
									</div>
								</div>
								
								<div class="cf row row-5">
									<div class="col col-info">
										<strong>Total number of Executive Committee members as at 30 June <?php echo $allData->year; ?></strong>
									</div>
									
									<div class="col col-num">
										<p id="prevRepExecMen"><?php echo $allData->repExecMen; ?></p>
									</div>
									
									<div class="col col-num">
										<p id="prevRepExecWomen"><?php echo $allData->repExecWomen; ?></p>
									</div>
									
									<div class="col col-num">
										<p id="prevRepExecTotal"><?php echo $allData->repExecTotal; ?></p>
									</div>
								</div>
							</div>
						</section>
					
					<section class="locked section-wrapper">
							<!-- SECTION 2 -->
							
							<h4><strong>Section 2</strong></h4>
							
							<div class="section one">
								<div class="cf row row-1">
									<div class="col col-info">
										<h5>
											<b>Direct Reports to the Executive Committee<br>(excluding administrative support staff)</b>
<!--
											<span class="tooltip">i
												<span class="tooltiptext">
													Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
												</span>
											</span>
-->
										</h5>
									</div>
									<div class="col col-num">Men</div>
									<div class="col col-num">Women</div>
									<div class="col col-num">Total</div>
								</div>
								
								<div class="cf row row-2">
									<div class="col col-info">
										Direct Reports at the start of the year 1 July <?php echo $allData->year-1; ?>
									</div>
									
									<div class="col col-num">
										<p><?php echo $allData->turnDirectAvgMen; ?></p>
									</div>
									
									<div class="col col-num">
										<p><?php echo $allData->turnDirectAvgWomen; ?></p>
									</div>
									
									<div class="col col-num">
										<p><?php echo $allData->turnDirectAvgMen + $allData->turnDirectAvgWomen; ?></p>
									</div>
								</div>
								
								<div class="cf row row-3">
									<div class="col col-info">
										Direct Reports that left in the year to 30 June <?php echo $allData->year; ?>
									</div>
									
									<div class="col col-num">
										<p><?php echo $allData->turnDirectLeftMen; ?></p>
									</div>
									
									<div class="col col-num">
										<p><?php echo $allData->turnDirectLeftWomen; ?></p>
									</div>
									
									<div class="col col-num">
									</div>
								</div>
								
								<div class="cf row row-4">
									<div class="col col-info">
										Direct Reports that joined in the year to 30 June <?php echo $allData->year; ?>
									</div>
									
									<div class="col col-num">
										<p><?php echo $allData->turnDirectJoinedMen; ?></p>
									</div>
									
									<div class="col col-num">
										<p><?php echo $allData->turnDirectJoinedWomen; ?></p>
									</div>
									
									<div class="col col-num">
									</div>
								</div>
								
								<div class="cf row row-5">
									<div class="col col-info">
										<strong>Total number of Direct Reports as at  30 June <?php echo $allData->year; ?></strong>
									</div>
									
									<div class="col col-num">
										<p id="prevRepDirectMen"><?php echo $allData->repDirectMen; ?></p>
									</div>
									
									<div class="col col-num">
										<p id="prevRepDirectWomen"><?php echo $allData->repDirectWomen; ?></p>
									</div>
									
									<div class="col col-num">
										<p id="prevRepDirectTotal"><?php echo $allData->repDirectTotal; ?></p>
									</div>
								</div>
							</div>
						</section>
					
						<section class="locked section-wrapper">
							<!-- SECTION 3 -->
							
							<h4><strong>Section 3</strong></h4>
							
							<div class="section three">
								<div class="cf row row-1">
									<div class="col">
										<h5>
											<b>Functional Roles</b>
										</h5>
									</div>
								</div>
								
								<div class="cf row">
									<div class="col col-info" style="width: 100%;">
										Please provide the gender and name of holders of key functional roles below:
									</div>
								</div>
								
								<div class="cf row">
									<div class="col col-info">
										<strong>1.</strong> Human Resources Director (HRD) or most senior executive responsible for people and talent management
									</div>
									
									<div class="col">
										<p style="display: inline; margin-right: 10px;">Gender: <?php echo $allData->leadingExec; ?></p>
										<br>
										<p style="display: inline; margin-right: 10px; margin-left: 10px;">Name: <?php echo $allData->leadingExecName; ?></p>
									</div>
								</div>
								
								<div class="cf row">
									<div class="col col-info">
										<strong>2.</strong> Chief Information Officer (CIO) or most senior executive responsible for systems and technology
									</div>
									
									<div class="col">
										<p style="display: inline; margin-right: 10px;">Gender: <?php echo $allData->seniorInfoTech; ?></p>
										<br>
										<p style="display: inline; margin-right: 10px; margin-left: 10px;">Name: <?php echo $allData->seniorInfoTechName; ?></p>
									</div>
								</div>
								
								<div class="cf row">
									<div class="col col-info">
										<strong>3.</strong> Please answer only (a) where this a combined role or (b) where these are separate roles
									</div>
								</div>
								
								<div class="cf row sub-section a">
									<div class="col col-info">
										<strong>(a)</strong> Group Counsel and Company Secretary
									</div>
									
									<div class="col">
										<p style="display: inline; margin-right: 10px;">Gender: <?php echo $allData->gcSecCombined; ?></p>
										<br>
										<p style="display: inline; margin-right: 10px; margin-left: 10px;">Name: <?php echo $allData->gcSecCombinedName; ?></p>
									</div>
								</div>
								
								<div class="cf row sub-section b">
									<div class="col col-info">
										<strong>(b)</strong> Group Counsel
									</div>
									
									<div class="col">
										<p style="display: inline; margin-right: 10px;">Gender: <?php echo $allData->headOfLegal; ?></p>
										<br>
										<p style="display: inline; margin-right: 10px; margin-left: 10px;">Name: <?php echo $allData->headOfLegalName; ?></p>
									</div>
									
									<div class="col col-info" style="padding: 0 0 0 2.1rem;">
										<strong>and</strong>
									</div>
								</div>
								
								<div class="cf row sub-section c">
									<div class="col col-info" style="padding: 0 0 0 2.1rem;">
										Company Secretary
									</div>
									
									<div class="col">
										<p style="display: inline; margin-right: 10px;">Gender: <?php echo $allData->companySec; ?></p>
										<br>
										<p style="display: inline; margin-right: 10px; margin-left: 10px;">Name: <?php echo $allData->companySecName; ?></p>
									</div>
								</div>
							</div>
						</section>
					<?php endif; ?>
				</div>
			<?php } ?>
			</div>
			
			<a href="<?php echo wp_logout_url( '/member-login/?logged_out=true' ); ?>" class="logout-link button">Logout</a>
		</div>
	</div>
</div>