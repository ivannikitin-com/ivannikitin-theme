<?php
/**
 * Хуки Project Manager
 */
 
/* --------------------------- Темы E-mail --------------------------- */
add_filter( 'cpm_email_project_new_subject', 	'in_cpm_email_project_new_subject', 10, 2 );
function in_cpm_email_project_new_subject( $subject, $project )
{
	return $project . ': Новый проект';
}

add_filter( 'cpm_email_project_update_subject', 'in_cpm_email_project_update_subject', 10, 2 );
function in_cpm_email_project_update_subject( $subject, $project )
{
	return $project . ': Новый участник в проекте';
}

add_filter( 'cpm_email_complete_task_subject', 	'in_cpm_email_complete_task_subject', 10, 3 );
function in_cpm_email_complete_task_subject( $subject, $project, $task )
{
	return $project . ': ' . $task . ': Задача завершена';
}

add_filter( 'cpm_email_new_message_subject', 	'in_cpm_email_new_message_subject', 10, 3 );
function in_cpm_email_new_message_subject( $subject, $project, $message )
{
	return $project . ': Новое сообщение: ' . mb_substr( $message, 0, 50 ) . '...';
}

add_filter( 'cpm_email_new_comment_subject', 	'in_cpm_email_comment_subject', 10, 3 );
add_filter( 'cpm_email_update_comment_subject', 'in_cpm_email_comment_subject', 10, 3 );
function in_cpm_email_comment_subject( $subject, $project, $task )
{
	return $project . ': ' . $task . ': Комментарий к задаче';
}

add_filter( 'cpm_email_new_task_subject', 	'in_cpm_email_new_task_subject', 10, 3 );
function in_cpm_email_new_task_subject( $subject, $project, $list )
{
	return $project . ': ' . $list . ': Новая задача';
}


/* --------------------------- Адреса E-mail from и reply to --------------------------- */
add_filter( 'cpm_from_email', 'in_cpm_from_email', 10, 1 );
function in_cpm_from_email( $email_from )
{
	$current_user = wp_get_current_user();
	if ( !($current_user instanceof WP_User) )
		return $email_from;
	
	$user_cpm_email = urlencode( $current_user->user_login ) . '@ivannikitin.com';
	$user_name = $current_user->display_name;
	
	return "From: $user_name <$user_cpm_email>";
}

add_filter( 'cpm_reply_to', 'in_cpm_reply_to', 10, 2 );
function in_cpm_reply_to( $to, $comment_post_id )
{
	$current_user = wp_get_current_user();
	if ( !($current_user instanceof WP_User) )
		return $to;
	
	return $current_user->user_email;
}