<?php

$task_data     = cpm()->task->get_task( $task_id );
$due_date      = cpm_get_date( current_time( 'mysql' ) );


cpm_get_email_header();


$tpbk           = CPM_URL . '/assets/images/tpbk.png';
$completed_user = get_user_by( 'id', $data->completed_by );

// $template_vars = array(
//     '%SITE%'         => wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES ),
//     '%PROJECT_NAME%' => get_post_field( 'post_title', $project_id ),
//     '%PROJECT_URL%'  => '<a style="text-decoration: none;" href="'.cpm_url_project_details( $project_id ).'">'.get_post_field( 'post_title', $project_id ).'</a>',
//     '%TASKLIST_URL%' => '<a style="text-decoration: none;" href="'.cpm_url_single_tasklist($project_id, $list_id).'"">'.get_post_field( 'post_title', $list_id ) .'</a>',
//     '%TASK_URL%'     => '<a style="text-decoration: none;" href="'.cpm_url_single_task( $project_id, $list_id, $task_id ).'">'.$data->post_content.'</a>',
//     '%TASK%'         => $data->post_content,
//     '%IP%'           => get_ipaddress()
// );
?>

<div id="author">
	<div style="width:48px;height:48px;float:left;margin:4px"><?php echo get_avatar( $completed_user->ID, 48 ); ?></div> 
	<?php echo $completed_user->display_name; ?><br>
	Задача завершена.
</div>

<div style="font-size:85%">
	<a href="<?php echo cpm_url_single_task( $project_id, $list_id, $task_id ); ?>">
		Просмотреть задачу
	</a>
</div>

<?php cpm_get_email_footer(); ?>
