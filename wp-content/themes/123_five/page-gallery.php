<?php
if ( !Pagedata::is_active_page('gallery') ) {
	header( "Location: " . site_url() . "/404.php" );
}
get_header();
 ?>

<main class="gallery main">
	<?php render_page_hero('gallery') ?>
	<section class="gallery-galleries pagecontent">

		<?php if(have_rows('gallery-repeater', 'option')) : while(have_rows('gallery-repeater', 'option')) :  the_row();?>

			<div class="gallery-galleries-gallery">
				<h2 class="gallery-galleries-gallery-header"><?php echo get_sub_field('gallery-name','option') ?></h2>
				<?php 
				$images = get_sub_field('gallery-gallery', 'option'); 
				$medium_remainder = count($images) % 2;
				$large_remainder = count($images) % 4;
				foreach($images as $index => $image): 
					$classes = '';
					if(!empty($medium_remainder) && $index >= count($images) - $medium_remainder){
						$classes .= 'medium-' . (string) $medium_remainder . ' ';
					}
					if(!empty($large_remainder) && $index >= count($images) - $large_remainder){
						$classes .= 'large-' . (string) $large_remainder . ' ';
					}
					?>
					<a href="<?php echo $image['url']; ?>" class=" gallery-galleries-gallery-imagecontainer<?php echo !empty($classes) ? ' ' . $classes : '';  ?>" data-caption="<?php echo get_sub_field('gallery-name', 'option'); ?>">
						
						<img class="gallery-galleries-gallery-imagecontainer-image"
							src="<?php echo $image['url']; ?>" 
							srcset="<?php echo $image['sizes']['medium']; ?> 300w,
							    <?php echo $image['sizes']['medium_large']; ?> 768w"
						alt="">

					</a>
				<?php endforeach; ?>
			</div>
		<?php endwhile; ?>
		<?php endif; ?>
	</section>
	<?php

	get_template_part('partials/global', 'recent_posts');
	get_template_part('partials/global', 'contact');

	?>
</main>

<?php get_footer(); ?>