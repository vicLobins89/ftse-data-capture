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
			
			<h2 class="welcome">Please fill in the form below to submit a change of user request.</h2>
			
			<?php echo do_shortcode('[contact-form-7 id="904" title="User change request"]'); ?>
			
			<p class="form-row" style="text-align: center;">If you're experiencing any issues changing the registered user please email us on <a href="mailto:info@ftsewomenleaders.com?subject=Technical Difficulties: User Change Request">info@ftsewomenleaders.com</a>.</p>
		</div>
	</div>
</div>