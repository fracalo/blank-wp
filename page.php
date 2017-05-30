<?php
	$title = get_the_title($post->ID);
	
	$content_post = get_post($post->ID);
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
?>
<?php get_header(); ?>
<div class="container">
	<div class="row ">
		<div class="col-xs-12">
			<div class='content'>
				<?php echo $content; ?>
			</div>
		</div>
	</div>
</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>