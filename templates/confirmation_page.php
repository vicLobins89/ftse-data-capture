<?php
$user = wp_get_current_user();
//get meta
$user_id = $user->id;
$meta = get_user_meta( $user_id );
$meta = array_filter( array_map( function( $a ) {
	return $a[0];
}, $meta ) );

$options = get_option('rh_settings');
?>

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
			
			<h2 class="welcome">Thank you, <?php echo $user->first_name .' '. $user->last_name; ?></h2>
			
			<p>
				The data you entered has been successfully submitted and you will receive a confirmation email for your own records.
				<br><br>
				The Hampton-Alexander Review will publish the details in November 2019.
				<br><br>
				Thank you for your continued support. We look forward to sharing best practice and reporting on progress in our annual report which will be published on the 13<sup>th</sup> November 2019.
				<br><br>
				<strong>The Hampton-Alexander Team</strong>
			</p>
			
			<a href="/gender-equality-data-collection/" class="big-button green-btn">Click here to review your account</a>
			<!--<a href="<?php //echo wp_logout_url( $redirect ); ?>" class="logout-link">Logout</a>-->
		</div>
	</div>
</div>