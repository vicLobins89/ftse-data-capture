<?php $options = get_option('rh_settings'); ?>
<div id="login-form-container" class="page_textbox">
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
				<h2><?php _e( 'Sign In', 'ftse-data-capture' ); ?></h2>
			<?php endif; ?>

			<!-- errors if any -->
			<?php if( count( $attributes['errors'] ) > 0 ) : ?>
				<?php foreach( $attributes['errors'] as $error ) : ?>
					<p class="login-error">
						<?php echo $error; ?>
					</p>
				<?php endforeach; ?>
			<?php endif; ?>

			<!-- registered message -->
			<?php if( $attributes['registered'] ) : ?>
				<p class="login-info">
					<?php
						printf( __( 'You have successfully registered to <b>%s</b>.', 'ftse-data-capture' ), get_bloginfo( 'name' ) );
					?>
				</p>
			<?php endif; ?>

			<!-- password reset message -->
			<?php if( $attributes['lost_password_sent'] ) : ?>
				<p class="login-info">
					<?php _e( 'Check your email for a link to reset your password', 'ftse-data-capture' ); ?>
				</p>
			<?php endif; ?>

			<!-- password changed message -->
			<?php if( $attributes['password_updated'] ) : ?>
				<p class="login-info">
					<?php _e( 'You have successfully created your password', 'ftse-data-capture' ); ?>
				</p>
			<?php endif; ?>

			<!-- logged out message -->
			<?php if( $attributes['logged_out'] ) : ?>
				<p class="login-info">
					<?php _e( 'Signed out', 'ftse-data-capture' ); ?>
				</p>
			<?php endif; ?>
			
			<div class="page_form">
				<form id="signupform" action="<?php echo wp_login_url(); ?>" method="post" autocomplete="off">

					<p class="form-row">
						<label for="user_login"><?php _e( 'Email', 'ftse-data-capture' ); ?></label>
						<input type="text" name="log" id="user_login" autocomplete="off" placeholder="<?php _e( 'Email', 'ftse-data-capture' ); ?>">
					</p>

					<p class="form-row">
						<label for="user_pass"><?php _e( 'Password', 'ftse-data-capture' ); ?></label>
						<input type="password" name="pwd" id="user_pass" autocomplete="off" placeholder="<?php _e( 'Password', 'ftse-data-capture' ); ?>">
					</p>
					
<!--
					<p class="form-row checkbox">
						<input type="checkbox" id="rememberme" name="rememberme" value="forever" />
    					<label for="rememberme"><span></span><?php// _e( "Remember me", 'ftse-data-capture' ); ?></label>
					</p>
-->

					<p class="signup-submit">
						<input type="submit" name="wp-submit" class="register-button" id="wp-submit" value="<?php _e( 'Login', 'ftse-data-capture' ); ?>" />
						<input type="hidden" name="redirect_to" value="">
					</p>
				</form>
			</div>

			<a class="forgot-password" href="<?php echo wp_lostpassword_url(); ?>">
				<?php _e( 'Forgot your password?', 'ftse-data-capture' ); ?>
			</a>
			
			<p class="form-row" style="text-align: center;">If you're experiencing any issues logging in please email us on <a href="mailto:info@ftsewomenleaders.com?subject=Technical Difficulties: Log In">info@ftsewomenleaders.com</a>.</p>
		</div>
	</div>
</div>