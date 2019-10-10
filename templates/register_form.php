<?php $options = get_option('rh_settings'); ?>
<div id="register-form" class="page_textbox">
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
			
			<p class="intro">Stage 1 – Register your Company</p>
			<p style="max-width: 550px; margin: 0 auto 30px;">
				<strong>This page is only to be completed by companies registering for the first time.</strong>
				<br/><br/>
				Please complete the details below to register your company and provide appropriate contact details. This will allow you to submit your company’s gender data, ensure we have the correct details to advise when the online tool is open to submit gender data or get in touch with any subsequent queries.
			</p>
			
			<?php if( $attributes['show_title'] ) : ?>
				<h2><?php _e( 'Register', 'ftse-data-capture' ); ?></h2>
			<?php endif; ?>

			<!-- errors if any -->
			<?php if( count( $attributes['errors'] ) > 0 ) : ?>
				<?php foreach( $attributes['errors'] as $error ) : ?>
					<p class="register-error">
						<?php echo 'The following errors were found with your submission:<br>'; ?>
						<?php echo $error; ?>
					</p>
				<?php endforeach; ?>
			<?php endif; ?>
			
			<?php
				//$special_query_results = get_transient( 'special_query_results' );
			?>
			<div class="page_form">
				<form id="signupform" action="<?php echo wp_registration_url(); ?>" method="post" autocomplete="off">
					<p class="form-row">
						<select id="company-name" name="company_name">
						<!-- Dropdown List Option -->
						</select>
						<span class="error_msg"></span>
						<input type="hidden" name="ftseIndex" id="ftseIndex">
						<input type="hidden" name="invTrust" id="invTrust">
					</p>

					<p class="form-row">
						<label for="sector"><?php _e( 'Sector', 'ftse-data-capture' ); ?></label>
						<input type="text" name="sector_dis" id="sector_dis" disabled placeholder="<?php _e( 'Sector', 'ftse-data-capture' ); ?>">
						<input type="hidden" name="sector" id="sector">
					</p>

					<p class="form-row">
						<label for="first_name"><?php _e( 'First Name', 'ftse-data-capture' ); ?></label>
						<input type="text" name="first_name" id="first-name" placeholder="<?php _e( 'First Name', 'ftse-data-capture' ); ?>">
						<span class="error_msg"></span>
					</p>

					<p class="form-row">
						<label for="last_name"><?php _e( 'Surname', 'ftse-data-capture' ); ?></label>
						<input type="text" name="last_name" id="last-name" placeholder="<?php _e( 'Surname', 'ftse-data-capture' ); ?>">
						<span class="error_msg"></span>
					</p>

					<p class="form-row">
						<label for="email"><?php _e( 'Work Email', 'ftse-data-capture' ); ?><strong>*</strong></label>
						<input type="text" name="email" id="email" autocomplete="off" placeholder="<?php _e( 'Work Email', 'ftse-data-capture' ); ?>">
						<span class="error_msg"></span>
					</p>

					<p class="form-row">
						<label for="email2"><?php _e( 'Confirm Work Email', 'ftse-data-capture' ); ?><strong>*</strong></label>
						<input type="text" name="email2" id="email2" autocomplete="off" placeholder="<?php _e( 'Confirm Work Email', 'ftse-data-capture' ); ?>">
						<span class="error_msg"></span>
					</p>

					<p class="form-row">
						<label for="contact_phone"><?php _e( 'Work Landline Number', 'ftse-data-capture' ); ?></label>
						<input type="text" name="contact_phone" id="contact-phone" placeholder="<?php _e( 'Work Landline Number', 'ftse-data-capture' ); ?>">
						<span class="error_msg"></span>
					</p>

					<p class="form-row">
						<label for="mobile_phone"><?php _e( 'Work Mobile Number', 'ftse-data-capture' ); ?></label>
						<input type="text" name="mobile_phone" id="mobile-phone" placeholder="<?php _e( 'Work Mobile Number', 'ftse-data-capture' ); ?>">
						<span class="error_msg"></span>
					</p>

					<p class="form-row">
						<label for="job_title"><?php _e( 'Position/Job Title', 'ftse-data-capture' ); ?></label>
						<input type="text" name="job_title" id="position" placeholder="<?php _e( 'Position/Job Title', 'ftse-data-capture' ); ?>">
						<span class="error_msg"></span>
					</p>

					<p class="form-row">
						<label for="sec_name"><?php _e( 'Secondary Contact Name', 'ftse-data-capture' ); ?></label>
						<input type="text" name="sec_name" id="sec_name" class="optional" placeholder="<?php _e( 'Secondary Contact Name', 'ftse-data-capture' ); ?>">
					</p>

					<p class="form-row">
						<label for="sec_email"><?php _e( 'Secondary Contact Email', 'ftse-data-capture' ); ?></label>
						<input type="text" name="sec_email" id="sec_email" class="optional" placeholder="<?php _e( 'Secondary Contact Email', 'ftse-data-capture' ); ?>">
					</p>
					
					<p class="form-row checkbox">
						<input type="checkbox" id="disclaimer" name="disclaimer" />
    					<label for="disclaimer"><span></span><?php _e( "I agree to the details above being used by the Hampton-Alexander Review team and partners to contact me for the specific purpose of the data collection for the Hampton-Alexander Review.", 'ftse-data-capture' ); ?></label>
    					<span class="error_msg"></span>
					</p>

					<p class="signup-submit">
						<input disabled type="submit" name="submit" id="submit-button" class="register-button" value="<?php _e( 'Register', 'ftse-data-capture' ); ?>" />
						<span class="overlay" id="overlay"></span>
					</p>
					
					<p class="form-row">Clicking above will submit your details. You will receive an email confirming your registration and next steps. You may need to check your junk/spam folder.</p>
					
					<p class="form-row" style="text-align: center;">If you're experiencing any issues registering your company please email us on <a href="mailto:info@ftsewomenleaders.com?subject=Technical Difficulties: New Registration">info@ftsewomenleaders.com</a>.</p>
				</form>
			</div>
		</div>
	</div>
</div>