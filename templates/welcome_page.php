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
			
			<h2 class="welcome">Welcome</h2>
			
			<p style="text-align: center; width: 70%; margin:auto; ">
				Please select one of the options below or email us on <a href="mailto:info@ftsewomenleaders.com?subject=Technical Difficulties">info@ftsewomenleaders.com</a> if you're experiencing technical difficulties.
			</p>
			
			<div class="traffic-light clearfix" style="display: flex;">
				<div class="col-4 login">
					<h4><a href="/member-login/">Log In</a></h4>
					<a href="/member-login/">If you registered your company last year and would like to log in to the portal please click here.</a>
				</div>
				
				<div class="col-4 change">
					<h4><a href="/user-change-request/">Change User</a></h4>
					<a href="/user-change-request/">If your company registered last year but you would like to change your user account details please click here.</a>
				</div>
				
				<div class="col-4 register">
					<h4><a href="/member-register/">Register</a></h4>
					<a href="/member-register/">If your company is new* to the FTSE 350 please click here to register.</a>
				</div>
			</div>
			
			<p style="text-align: center; width: 70%; margin:auto; ">
				*entered the FTSE after October 2018
			</p>
		</div>
	</div>
</div>