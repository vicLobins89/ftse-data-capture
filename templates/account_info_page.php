<link href="https://addtocalendar.com/atc/1.5/atc-style-blue.css" rel="stylesheet" type="text/css">
<style type="text/css">
.atc-style-blue .atcb-link,
.atc-style-blue .atcb-link:hover,
.atc-style-blue .atcb-link:active,
.atc-style-blue .atcb-link:focus {
    margin: 0 0 0 5px;
    padding: 5px 20px;
    background: #8ab648;
    border-radius: 0;
    zoom: 1;
}
</style>

<script type="text/javascript">(function () {
if (window.addtocalendar)if(typeof window.addtocalendar.start == "function")return;
if (window.ifaddtocalendar == undefined) { window.ifaddtocalendar = 1;
	var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
	s.type = 'text/javascript';s.charset = 'UTF-8';s.async = true;
	s.src = ('https:' == window.location.protocol ? 'https' : 'http')+'://addtocalendar.com/atc/1.5/atc.min.js';
	var h = d[g]('body')[0];h.appendChild(s); }})();
</script>
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
			
			<h2 class="welcome">Hello, <?php echo $user->first_name .' '. $user->last_name; ?>.<br>You're registered.</h2>
			
			<h2>User Details <a href="mailto:info@ftsewomenleaders.com?subject=[Hampton-Alexander Review] Account Details Change Request">Details incorrect? Contact us at info@ftsewomenleaders.com</a></h2>
			
			<div class="account-info left">
				<p><strong>Company Name:</strong> <?php echo $meta['company_name']; ?></p>
				<p><strong>Contact Name:</strong> <?php echo $user->nickname; ?></p>
				<p><strong>Contact Email:</strong> <?php echo $user->user_email; ?></p>
			</div>
			<div class="account-info right">
				<p><strong>Contact Phone:</strong> <?php echo $meta['contact_phone']; ?></p>
				<p><strong>Position/Job Title:</strong> <?php echo $meta['job_title']; ?></p>
				<p><strong>Sector:</strong> <?php echo $meta['sector']; ?></p>
			</div>
			
			<div class="clearfix"></div>
			
			<h2>Next Steps - Submitting your Data</h2>
			
			<p>The online facility will open for companies to submit their gender data from <strong>Friday 29 June until Tuesday 31 July 2018</strong>. You can submit your company’s data by clicking on the link sent to you once registered or by logging into the data submission portal via the Hampton-Alexander Review website at <a href="http://ftsewomenleaders.com">www.ftsewomenleaders.com</a>.
			<br><br>
			
			To add a reminder in your diary click here 
			<span class="addtocalendar atc-style-blue">
				<var class="atc_event">
					<var class="atc_date_start">2018-06-29 09:00:00</var>
					<var class="atc_date_end">2018-07-31 18:00:00</var>
					<var class="atc_timezone">Europe/London</var>
					<var class="atc_title">FTSE 350 Gender Data Submission Portal is now open</var>
					<var class="atc_description">Hampton-Alexander Review FTSE Women Leaders
 
						FTSE 350 Gender Data Submission 2018 portal is open from <strong>Friday 29 June to Tuesday 31 July</strong>. Please register or login to submit your companies data via www.ftsewomenleaders.com
 
If you have any questions please contact us at info@ftsewomenleaders.com</var>
					<var class="atc_location">http://ftsewomenleaders.com/gender-equality-data-collection/</var>
					<var class="atc_organizer">Hampton-Alexander Review</var>
					<var class="atc_organizer_email">info@ftsewomenleaders.com</var>
				</var>
			</span>
			
			<!--<a target="_blank" href="https://calendar.google.com/calendar/event?action=TEMPLATE&amp;tmeid=djM3cm9tcmpkdGJmMXJuN2trZWM0NHZnY2MgdmljQGhvbmV5LmNvLnVr&amp;tmsrc=vic%40honey.co.uk"><img border="0" src="https://www.google.com/calendar/images/ext/gc_button1_en.gif"></a> or here <a href="webcal://ftsewomenleaders.com/wp-content/plugins/ftse-data-capture/FTSE-350-Gender-Data-Submission.ics"><img style="max-width: 30px;" src="<?php// echo plugins_url('ftse-data-capture/outlook-cal.png'); ?>"/></a>-->
			<br><br>
			<em>Please note: In line with the recommendations of the Hampton-Alexander Review and to encourage greater transparency and public reporting of gender data, companies are also requested to publish details of the number of women on the Executive Committee and the Direct Reports to the Executive Committee in their Annual Report and Accounts and\or on their websites.</em>
			<br><br>
			If you have any questions please refer to the <a href="/faqs/" target="_blank">FAQs</a> or contact the team at <a href="mailto:info@ftsewomenleaders.com">info@ftsewomenleaders.com</a>.
			</p>			
			
			<br><br>
<!--			<a href="/gender-equality-data-collection/" class="big-button">Please click here for the data submission stage of the process</a>-->
			
			<a href="<?php echo wp_logout_url( '/member-login/?logged_out=true' ); ?>" class="logout-link button">Logout</a>
		</div>
	</div>
</div>