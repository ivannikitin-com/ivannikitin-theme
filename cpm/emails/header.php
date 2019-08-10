<?php
$logo_path   = cpm_get_option( 'logo', 'cpm_general' );
$date        = cpm_date2mysql( current_time( 'mysql' ) );
$custom_date = date( 'd.m.Y', strtotime( $date ) );
$calendar    = CPM_URL . '/assets/images/calendar.png';
?>
