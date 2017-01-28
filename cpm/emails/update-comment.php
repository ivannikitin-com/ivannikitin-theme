<?php

cpm_get_email_header();

$tpbk = CPM_URL . '/assets/images/tpbk.png';

$msg_obj     = CPM_Message::getInstance();
$parent_post = get_post( $data['comment_post_ID'] );
$author      = wp_get_current_user();
$comment_url = '';

switch ( $parent_post->post_type ) {
    case 'cpm_message':
        $type        = __( 'Message', 'cpm' );
        $title       = $parent_post->post_title;
        $comment_url = cpm_url_single_message( $project_id, $data['comment_post_ID'] );
        break;

    case 'cpm_task_list':
        $title       = $parent_post->post_title;
        $type        = __( 'Task List', 'cpm' );
        $comment_url = cpm_url_single_tasklist( $project_id, $parent_post->ID );
        break;

    case 'cpm_task':
        $type        = __( 'Task', 'cpm' );
        $title       = $parent_post->post_title;
        $comment_url = cpm_url_single_task( $project_id, $parent_post->post_parent, $parent_post->ID );
        break;
}


?>

<div id="author">
	<div style="width:48px;height:48px;float:left;margin:4px"><?php echo get_avatar( $author->ID, 48 ); ?></div> 
	<?php echo $author->display_name; ?><br>
	<?php echo $type; ?>: <a href="<?php echo $comment_url; ?>"><?php echo $title; ?></a>
</div>

<div id="content" style="clear:both">
	<?php echo $data['text']; ?>
</div>

<div style="font-size:85%">
	<a href="<?php echo $comment_url; ?>">
		Просмотреть комментарий
	</a>
</div>

<?php cpm_get_email_footer(); ?>
