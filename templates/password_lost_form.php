<?php $options = get_option('rh_settings'); ?>
<div id="password-lost-form" class="page_textbox">
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
				<h2><?php _e( 'Forgot Your Password?', 'ftse-data-capture' ); ?></h2>
			<?php endif; ?>

			<!-- errors if any -->
			<?php if( count( $attributes['errors'] ) > 0 ) : ?>
				<?php foreach( $attributes['errors'] as $error ) : ?>
					<p class="login-error">
						<?php echo $error; ?>
					</p>
				<?php endforeach; ?>
			<?php endif; ?>

			<p class="login-info">
				<?php
					_e( "Enter your email and we'll send you a link to create a new password.", 'ftse-data-capture' );
				?>
			</p>

			<div class="page_form">
				<form id="signupform" action="<?php echo wp_lostpassword_url(); ?>" method="post" autocomplete="off">
					<p class="form-row">
						<label for="user_login"><?php _e( 'Email', 'ftse-data-capture' ); ?></label>
						<input type="text" name="user_login" id="user_login" autocomplete="off" placeholder="<?php _e( 'Email', 'ftse-data-capture' ); ?>">
					</p>

					<p class="form-row">
						<input type="submit" name="submit" class="button register-button" id="lostpassword-button" value="<?php _e( 'Reset Password', 'ftse-data-capture' ); ?>">
					</p>
				</form>
			</div>
		</div>
	</div>
</div>