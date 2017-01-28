<?php
cpm_get_email_header();

$tpbk   = CPM_URL . '/assets/images/tpbk.png';
$author = wp_get_current_user();
?>

<div id="author">
	<div style="width:48px;height:48px;float:left;margin:4px"><?php echo get_avatar( $author->ID, 48 ); ?></div> 
	<?php echo $author->display_name; ?><br>
	Обновление в проекте <?php echo $data['post_title']; ?>.
</div>	
	
<div style="font-size:85%">
	<a href="<?php echo cpm_url_project_details( $project_id ); ?>">
		Просмотреть проект
	</a>
</div>	

<?php
cpm_get_email_footer();