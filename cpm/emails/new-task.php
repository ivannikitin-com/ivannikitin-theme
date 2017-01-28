<?php
cpm_get_email_header();
$task_data = cpm()->task->get_task( $task_id );
$due_date  = cpm_get_date( $task_data->due_date );
if ( ! empty( $due_date ) ) {
    $next_name = sprintf( '<em style="font-family: lato; color: #B3B3B3; ">%s</em>
                    <strong style="font-family: lato; color: #7e7e7e;">
                        <span style="padding-right: 5px;">%s</span>', __( 'Due Date ', 'cpm' ), $due_date );
} else {
    $next_name = '';
}

$tpbk   = CPM_URL . '/assets/images/tpbk.png';
$author = wp_get_current_user();
$linkto = cpm_get_option( 'email_url_link', 'cpm_mails' );

?>

<div id="author">
	<div style="width:48px;height:48px;float:left;margin:4px"><?php echo get_avatar( $author->ID, 48 ); ?></div> 
	<?php echo $author->display_name; ?><br>
	Новая задача: <?php echo $task_data->post_title ?></br>
	<?php if ( ! empty( $due_date ) ):?>
		Срок: <?php echo $due_date ?></br>
	<?php endif ?>
</div>

<div style="font-size:85%">
	<a href="<?php echo cpm_url_single_task( $project_id, $list_id, $task_id ); ?>">
		Просмотреть задачу
	</a>
</div>

<?php cpm_get_email_footer(); ?>
