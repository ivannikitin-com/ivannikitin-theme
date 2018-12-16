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

<div id="cpm_author">
	<div style="width:48px;height:48px;float:left;margin:4px">
		<?php echo get_avatar( $author->ID, 48 ); ?>
	</div> 
	<?php echo $author->display_name; ?><br>
	Новая задача: <?php echo $task_data->post_title ?></br>
	<?php if ( ! empty( $due_date ) ):?>
		Срок: <?php echo $due_date ?></br>
	<?php endif ?>
</div>

<div id="cpm_task_content">
	<?php echo $task_data->post_content ?>
</div>

<hr style="clear:both">

<?php
	// Пять последних комменнтариев
	$comments = get_comments( array(
		'number' 	=> '5',
		'post_id' 	=> $task_id,
		'orderby'	=> 'comment_date',
		'order'		=> 'ASC',		
	) );
?>

<?php if ( count( $comments ) > 0 ) : ?>
<div id="cpm_comments">
	<p>Последние комментарии к задаче:</p>
	<?php foreach( $comments as $comment ) : ?>
	<div class="cpm_comment">
		<div style="width:48px;height:48px;float:left;margin:4px">
			<?php echo get_avatar( $comment->user_id , 48 ); ?>
		</div>	
		<?php echo $comment->comment_author ?>	
		<?php echo $comment->comment_date ?>		
		<br>
		<div>
			<?php echo $comment->comment_content ?>
		</div>
	</div>
	<hr style="clear:both">
	<?php endforeach ?>	
</div>
<?php endif ?>


<div style="font-size:85%">
	<a href="<?php echo cpm_url_single_task( $project_id, $list_id, $task_id ); ?>">
		Просмотреть задачу
	</a>
</div>

<?php cpm_get_email_footer(); ?>
