<?php
cpm_get_email_header();

$tpbk = CPM_URL . '/assets/images/tpbk.png';

$msg_obj     = CPM_Message::getInstance();
$parent_post = get_post( $data['comment_post_ID'] );
$comment_url = '';
$author      = wp_get_current_user();

// Категория проекта
$terms = get_the_terms( $project_id, 'cpm_project_category' );
$category = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : '';

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



// $template_vars = array(
//     '%SITE%'         => wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES ),
//     '%PROJECT_NAME%' => get_post_field( 'post_title', $project_id ),
//     '%PROJECT_URL%'  => '<a style="text-decoration: none;" href="'.cpm_url_project_details( $project_id ).'">'.get_post_field( 'post_title', $project_id ).'</a>',
//     '%AUTHOR%'       => $author->display_name,
//     '%AUTHOR_EMAIL%' => $author->user_email,
//     '%COMMENT_URL%'  => '<a style="text-decoration: none;" href="'.$comment_url .'/#cpm-comment-'.$comment_id.'">'.__( 'comment link', 'cpm' ).'</a>',
//     '%COMMENT%'      => $data['comment_content'],
//     '%IP%'           => get_ipaddress()
// );
// $message = cpm_get_content( cpm_get_option( 'new_comment_body', 'cpm_general ) );
// // message
// foreach ($template_vars as $key => $value) {
//     $message = str_replace( $key, $value, $message );
// }

?>
<div id="author">
	<div style="width:48px;height:48px;float:left;margin:4px"><?php echo get_avatar( $author->ID, 48 ); ?></div> 
	<?php echo $author->display_name; ?><br>
	<?php if ( ! empty( $category ) ): ?>
		<span>CPM категория</span>: <?php echo $category ?><br>
	<?php endif ?>
	<?php echo $type; ?>: <a href="<?php echo $comment_url; ?>"><?php echo $title; ?></a>
</div>

<div id="content" style="clear:both">
	<?php echo $data['comment_content']; ?>
</div>

<div style="font-size:85%">
	<a href="<?php echo $comment_url . '#cpm-comment-' . $comment_id; ?>">
		Просмотреть комментарий
	</a>
</div>
<?php cpm_get_email_footer(); ?>
