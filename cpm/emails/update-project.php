<?php
cpm_get_email_header();

<<<<<<< HEAD
$tpbk   = CPM_URL . '/assets/images/tpbk.png';
$author = wp_get_current_user();
// Категория проекта
$terms = get_the_terms( $project_id, 'cpm_project_category' );
$category = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : '';
?>

<div id="author">
	<div style="width:48px;height:48px;float:left;margin:4px"><?php echo get_avatar( $author->ID, 48 ); ?></div> 
	<?php echo $author->display_name; ?><br>
	<?php if ( ! empty( $category ) ): ?>
		<span>CPM категория</span>: <?php echo $category ?><br>
	<?php endif ?>	
=======
$tpbk = CPM_URL . '/assets/images/tpbk.png';
$author = wp_get_current_user();
// Категория проекта
$terms = get_the_terms($project_id, 'cpm_project_category');
$category = $terms && !is_wp_error($terms) ? $terms[0]->name : '';
?>

<div id="author">
	<div style="width:48px;height:48px;float:left;margin:4px"><?php echo get_avatar(
 	$author->ID,
 	48
 ); ?></div> 
	<?php echo $author->display_name; ?><br>
	<?php if (!empty($category)): ?>
		<span>CPM категория</span>: <?php echo $category; ?><br>
	<?php endif; ?>	
>>>>>>> 2019
	Обновление в проекте <?php echo $data['post_title']; ?>.
</div>	
	
<div style="font-size:85%">
<<<<<<< HEAD
	<a href="<?php echo cpm_url_project_details( $project_id ); ?>">
=======
	<a href="<?php echo cpm_url_project_details($project_id); ?>">
>>>>>>> 2019
		Просмотреть проект
	</a>
</div>	

<<<<<<< HEAD
<?php
<?php cpm_get_email_footer(); ?>
=======
<?php cpm_get_email_footer(); ?>
>>>>>>> 2019
