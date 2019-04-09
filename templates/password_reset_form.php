<?php $options = get_option('rh_settings'); ?>
<div id="password-reset-form" class="page_textbox">
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
				<h2><?php _e( 'Pick a New Password', 'ftse-data-capture' ); ?></h2>
			<?php endif; ?>
			
			<div class="page_form">
				<form name="resetpassform" id="signupform" autocomplete="off" action="<?php echo site_url( 'wp-login.php?action=resetpass' ); ?>" method="post" autocomplete="off">
					<input type="hidden" id="user_login" name="rp_login" value="<?php echo esc_attr( $attributes['login'] ); ?>" autocomplete="off">
					<input type="hidden" name="rp_key" value="<?php echo esc_attr( $attributes['key'] ); ?>">

					<!-- errors if any -->
					<?php if( count( $attributes['errors'] ) > 0 ) : ?>
						<?php foreach( $attributes['errors'] as $error ) : ?>
							<p class="login-error">
								<?php echo $error; ?>
							</p>
						<?php endforeach; ?>
					<?php endif; ?>

					<p class="form-row">
						<label for="pass1"><?php _e( 'Create Password', 'ftse-data-capture' ); ?></label>
						<input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off" placeholder="<?php _e( 'Create Password', 'ftse-data-capture' ); ?>">
						<span class="error_msg"></span>
					</p>

					<p class="form-row">
						<label for="pass2"><?php _e( 'Repeat Password', 'ftse-data-capture' ); ?></label>
						<input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" placeholder="<?php _e( 'Repeat Password', 'ftse-data-capture' ); ?>">
						<span class="error_msg"></span>
					</p>

					<p class="description" style="text-align: left;">Hint: Please use a password with a minimum of 7 characters and at least 1 number in your password. Special characters allowed: . ! @ # $ % ^ & * ( ) _ + - =</p>

					<p class="form-row">
						<input disabled type="submit" name="submit" id="resetpass-button" class="button register-button" value="<?php _e( 'Set Password', 'ftse-data-capture' ); ?>">
					</p>
				</form>
			</div>
		</div>
	</div>
</div>