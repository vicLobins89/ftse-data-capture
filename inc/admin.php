<?php

add_action( 'show_user_profile', 'ftse_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'ftse_extra_user_profile_fields' );
add_action( 'personal_options_update', 'ftse_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'ftse_save_extra_user_profile_fields' );
 
function ftse_save_extra_user_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
	update_user_meta( $user_id, 'company_name', $_POST['company_name'] );
	update_user_meta( $user_id, 'ftseIndex', $_POST['ftseIndex'] );
	update_user_meta( $user_id, 'invTrust', $_POST['invTrust'] );
	update_user_meta( $user_id, 'sector', $_POST['sector'] );
	update_user_meta( $user_id, 'contact_phone', $_POST['contact_phone'] );
	update_user_meta( $user_id, 'mobile_phone', $_POST['mobile_phone'] );
	update_user_meta( $user_id, 'job_title', $_POST['job_title'] );
	update_user_meta( $user_id, 'sec_name', $_POST['sec_name'] );
	update_user_meta( $user_id, 'sec_email', $_POST['sec_email'] );
}

function ftse_extra_user_profile_fields( $user ) { ?>
<h3>Extra Custom Meta Fields</h3>

<table class="form-table">
	<tr>
		<th><label for="company_name">Company Name</label></th>
		<td>
		<input type="text" id="company_name" name="company_name" size="20" value="<?php echo esc_attr( get_the_author_meta( 'company_name', $user->ID )); ?>">
		</td>
	</tr>
	
	<tr>
		<th><label for="ftseIndex">FTSE Index</label></th>
		<td>
		<input type="text" id="ftseIndex" name="ftseIndex" size="20" value="<?php echo esc_attr( get_the_author_meta( 'ftseIndex', $user->ID )); ?>">
		</td>
	</tr>
	
	<tr>
		<th><label for="invTrust">Investment Trust</label></th>
		<td>
		<input type="text" id="invTrust" name="invTrust" size="20" value="<?php echo esc_attr( get_the_author_meta( 'invTrust', $user->ID )); ?>">
		</td>
	</tr>
	
	<tr>
		<th><label for="sector">Sector</label></th>
		<td>
		<input type="text" id="sector" name="sector" size="20" value="<?php echo esc_attr( get_the_author_meta( 'sector', $user->ID )); ?>">
		</td>
	</tr>
	
	<tr>
		<th><label for="contact_phone">Contact phone</label></th>
		<td>
		<input type="text" id="contact_phone" name="contact_phone" size="20" value="<?php echo esc_attr( get_the_author_meta( 'contact_phone', $user->ID )); ?>">
		</td>
	</tr>
	
	<tr>
		<th><label for="mobile_phone">Mobile phone</label></th>
		<td>
		<input type="text" id="mobile_phone" name="mobile_phone" size="20" value="<?php echo esc_attr( get_the_author_meta( 'mobile_phone', $user->ID )); ?>">
		</td>
	</tr>
	
	<tr>
		<th><label for="job_title">Job Title</label></th>
		<td>
		<input type="text" id="job_title" name="job_title" size="20" value="<?php echo esc_attr( get_the_author_meta( 'job_title', $user->ID )); ?>">
		</td>
	</tr>
	
	<tr>
		<th><label for="sec_name">Secondary Contact Name</label></th>
		<td>
		<input type="text" id="sec_name" name="sec_name" size="20" value="<?php echo esc_attr( get_the_author_meta( 'sec_name', $user->ID )); ?>">
		</td>
	</tr>
	
	<tr>
		<th><label for="sec_email">Secondary Contact Email</label></th>
		<td>
		<input type="text" id="sec_email" name="sec_email" size="20" value="<?php echo esc_attr( get_the_author_meta( 'sec_email', $user->ID )); ?>">
		</td>
	</tr>
</table>
<?php }
	
function ftse_plugin_menu() {
	add_menu_page('FTSE Data Capture Results', 'FTSE Data', 'administrator', 'ftse-data-capture-results', 'ftse_plugin_settings_page', 'dashicons-editor-ol', 1);
}

function ftse_plugin_settings_page() {
	// Set up vars
	global $wpdb;
	$surveyTable = $wpdb->prefix."survey_data";
	$years = $wpdb->get_results( "SELECT DISTINCT year FROM $surveyTable ORDER BY year ASC" );
	$ftseIndexes = [0, 100, 250];
	$currentYear = date('Y');
	
	// Begin output
	echo '<div class="wrap">
			<h2>FTSE Data Capture Results</h2>';
	
	echo '<div class="tab">';
		foreach($years as $year) : ?>
			<button class="tablinks" onclick="openTab(event, 'year-<?php echo $year->year; ?>')"><?php echo $year->year; ?></button>
		<?php endforeach;
	echo '</div>';
	
	foreach($years as $year) {
		echo '<div id="year-'.$year->year.'" class="tabcontent">';
				
		foreach($ftseIndexes as $ftseIndexNo) {
			$users = get_users( array(
				'role__not_in' => array('administrator'),
				'meta_key' => 'ftseIndex',
				'meta_value' => $ftseIndexNo
			) );
			
			echo '<h3>FTSE '.$ftseIndexNo.'</h3>
				<a href="#" class="export" data-index="'.$ftseIndexNo.'">Export FTSE '.$ftseIndexNo.' Status into spread sheet</a>
				<table class="ftseIndex'.$ftseIndexNo.'" width="100%" BORDER=0 CELLPADDING=1 CELLSPACING=0>
					<thead><tr>
					<td class="export">Company</td>
					<td>Sector</td>

					<td>Executive Committee members at the start of the year 1 July '.($currentYear-1).' - men</td>
					<td>Executive Committee members at the start of the year 1 July '.($currentYear-1).' - women</td>
					<td>Executive Committee members that left in the year to 30 June '.$currentYear.' - men</td>
					<td>Executive Committee members that left in the year to 30 June '.$currentYear.' - women</td>
					<td>Executive Committee members that joined in the year to 30 June '.$currentYear.' - men</td>
					<td>Executive Committee members that joined in the year to 30 June '.$currentYear.' - women</td>
					<td>Executive Committee members - men</td>
					<td>Executive Committee members - women</td>
					<td>Total number of Executive Committee members</td>

					<td>Direct Reports at the start of the year 1 July '.($currentYear-1).' - men</td>
					<td>Direct Reports at the start of the year 1 July '.($currentYear-1).' - women</td>
					<td>Direct Reports that left in the year to 30 June '.$currentYear.' - men</td>
					<td>Direct Reports that left in the year to 30 June '.$currentYear.' - women</td>
					<td>Direct Reports that joined in the year to 30 June '.$currentYear.' - men</td>
					<td>Direct Reports that joined in the year to 30 June '.$currentYear.' - women</td>
					<td>Direct Reports - men</td>
					<td>Direct Reports - women</td>
					<td>Total number of Direct Reports</td>
					
					<td>Human Resources Director (HRD) - Gender</td>
					<td>Human Resources Director (HRD) - Name</td>
					<td>Chief Information Officer (CIO) - Gender</td>
					<td>Chief Information Officer (CIO) - Name</td>
					<td>Group Counsel and Company Secretary - Gender</td>
					<td>Group Counsel and Company Secretary - Name</td>
					<td>Group Counsel - Gender</td>
					<td>Group Counsel - Name</td>
					<td>Company Secretary - Gender</td>
					<td>Company Secretary - Name</td>

					<td class="export">User</td>
					<td class="export">Email</td>
					<td class="export">Phone</td>
					<td class="export">Mobile</td>
					<td class="export">Date</td>
					
					<td class="export">Status</td>
					<td>Investment Trust?</td>
					</tr></thead>
					<tbody>';
			foreach($users as $user) {
				$surveyData = $wpdb->get_row( "SELECT * FROM $surveyTable WHERE user_id = '$user->ID' AND year = '$year->year'" );
//				$surveyData = $wpdb->get_row( "SELECT * FROM $surveyTable WHERE company = '$user->user_login' AND year = '$year->year'" );
                
				$company = ( !$surveyData->company ? get_user_meta($user->ID, 'company_name', true) : $surveyData->company );
				$ftseIndex = ( !$surveyData->ftse ? get_user_meta($user->ID, 'ftseIndex', true) : $surveyData->ftse );
				$sector = get_user_meta($user->ID, 'sector', true);
				$invTrust = get_user_meta($user->ID, 'invTrust', true);
				$telephone = get_user_meta($user->ID, 'contact_phone', true);
				$mobiletelephone = get_user_meta($user->ID, 'mobile_phone', true);
				$status;
				if( $surveyData->locked == '1' ) {
					$status = 'Submitted';
				} elseif( $surveyData->locked == '0' ) {
					$status = 'Partial';
				} else {
					$status = 'No submission';
				}
				echo '<tr>
					<td width="180" class="export">'.$company.'</td>
					<td width="180">'.$sector.'</td>

					<td>'.$surveyData->turnExecAvgMen.'</td>
					<td>'.$surveyData->turnExecAvgWomen.'</td>
					<td>'.$surveyData->turnExecLeftMen.'</td>
					<td>'.$surveyData->turnExecLeftWomen.'</td>
					<td>'.$surveyData->turnExecJoinedMen.'</td>
					<td>'.$surveyData->turnExecJoinedWomen.'</td>
					<td>'.$surveyData->repExecMen.'</td>
					<td>'.$surveyData->repExecWomen.'</td>
					<td>'.$surveyData->repExecTotal.'</td>

					<td>'.$surveyData->turnDirectAvgMen.'</td>
					<td>'.$surveyData->turnDirectAvgWomen.'</td>
					<td>'.$surveyData->turnDirectLeftMen.'</td>
					<td>'.$surveyData->turnDirectLeftWomen.'</td>
					<td>'.$surveyData->turnDirectJoinedMen.'</td>
					<td>'.$surveyData->turnDirectJoinedWomen.'</td>
					<td>'.$surveyData->repDirectMen.'</td>
					<td>'.$surveyData->repDirectWomen.'</td>
					<td>'.$surveyData->repDirectTotal.'</td>
					
					<td>'.$surveyData->leadingExec.'</td>
					<td>'.$surveyData->leadingExecName.'</td>
					<td>'.$surveyData->seniorInfoTech.'</td>
					<td>'.$surveyData->seniorInfoTechName.'</td>
					<td>'.$surveyData->gcSecCombined.'</td>
					<td>'.$surveyData->gcSecCombinedName.'</td>
					<td>'.$surveyData->headOfLegal.'</td>
					<td>'.$surveyData->headOfLegalName.'</td>
					<td>'.$surveyData->companySec.'</td>
					<td>'.$surveyData->companySecName.'</td>

					<td class="export">'.$user->first_name.' '.$user->last_name.'</td>
					<td class="export">'.( !$surveyData->contact_email ? $user->user_email : $surveyData->contact_email ).'</td>
					<td class="export">'.$telephone.'</td>
					<td class="export">'.$mobiletelephone.'</td>
					<td class="export">'.$surveyData->dateSubmitted.'</td>
					
					<td class="export">'.$status.'</td>
					<td>'.$invTrust.'</td>
				</tr>';
			}
			echo '</tbody></table>';
		}
		echo '</div>'; //.year-tab
	}
	echo '</div>'; //.wrap
}
add_action('admin_menu', 'ftse_plugin_menu');

?>