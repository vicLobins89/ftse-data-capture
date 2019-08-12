<?php $options = get_option('rh_settings'); ?>
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
			
			<p class="warning">The annual data submission process was open to receive company specific data from Monday 1 July, however closed for submissions on Wednesday 31 July 2019. If you need to get in touch regarding your recent submission or a late entry, please do so at <a href="mailto:info@ftsewomenleaders.com">info@ftsewomenleaders.com</a>.</p>
			
			<p class="warning">The next report will be published on 13th November 2019.</p>
			
			<h2 class="welcome">Welcome</h2>
			
			<p style="text-align: center; width: 70%; margin:auto; ">
				Please select one of the options below. For guidance or queries on the Gender Data Submission Portal please read our <a href="/faqs/">FAQs</a> or email us on <a href="mailto:info@ftsewomenleaders.com?subject=Technical Difficulties">info@ftsewomenleaders.com</a> if you’re experiencing technical difficulties.
			</p>
			
			<div class="traffic-light clearfix" style="display: flex;">
				<div class="col-4 login">
					<h4><a href="/member-login/">Log In</a></h4>
					<a href="/member-login/">If you registered your company last year or in previous years and would like to log in to the portal <span class="nowrap">please click here.</span></a>
				</div>
				
				<div class="col-4 change">
					<h4><a href="/user-change-request/">Change User</a></h4>
					<a href="/user-change-request/"> If you registered your company last year or in previous years but you would like to change your user account details <span class="nowrap">please click here.</span></a>
				</div>
				
				<div class="col-4 register">
					<h4><a href="/member-register/">Register</a></h4>
					<a href="/member-register/">If your company is new* to the FTSE 350 and you would like to register <span class="nowrap">please click here.</span></a>
				</div>
			</div>
			
			<p style="text-align: center; width: 70%; margin:auto; ">
				*entered the FTSE after October 2018
			</p>
		</div>
	</div>
</div>