<?php

cpm_get_email_header();

$tpbk = CPM_URL . '/assets/images/tpbk.png';

$pro_obj = CPM_Project::getInstance();
$msg_obj = CPM_Message::getInstance();

$project = $pro_obj->get( $project_id );
$msg     = $msg_obj->get( $message_id );
$author  = wp_get_current_user();
// $template_vars = array(
//     '%SITE%'         => wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES ),
//     '%PROJECT_NAME%' => $project->post_title,
//     '%PROJECT_URL%'  => '<a style="text-decoration: none;" href="'.cpm_url_project_details( $project_id ).'">'.get_post_field( 'post_title', $project_id ).'</a>',
//     '%AUTHOR%'       => $author->display_name,
//     '%AUTHOR_EMAIL%' => $author->user_email,
//     '%MESSAGE_URL%'  => '<a style="text-decoration: none;" href="'.cpm_url_single_message( $project_id, $message_id ).'">'.get_post_field( 'post_title', $message_id ). '</a>',
//     '%MESSAGE%'      => $msg->post_content,
//     '%IP%'           => get_ipaddress()
// );
// $subject = apply_filters( 'new_message_sub', __('New Message', 'cpm') );
// $message = cpm_get_content( cpm_get_option( 'new_message_body', 'cpm_general ) );
// // subject
// foreach ($template_vars as $key => $value) {
//     $subject = str_replace( $key, $value, $subject );
// }
// // message
// foreach ($template_vars as $key => $value) {
//     $message = str_replace( $key, $value, $message );
// }
?>

<div id="author">
	<div style="width:48px;height:48px;float:left;margin:4px"><?php echo get_avatar( $author->ID, 48 ); ?></div> 
	<?php echo $author->display_name; ?><br>
	<?php echo $msg->post_title; ?>
</div>


<div id="content" style="clear:both">
	<?php echo $msg->post_content; ?>
</div>


<div style="font-size:85%">
	<a href="<?php echo cpm_url_single_message( $project_id, $message_id ); ?>">
		Просмотреть сообщение
	</a>
</div>

<?php cpm_get_email_footer(); ?>
