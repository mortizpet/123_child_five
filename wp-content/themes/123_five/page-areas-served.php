<?php 
if ( !Pagedata::is_active_page('areas-served') ) {
	header( "Location: " . site_url() . "/404.php" );
}
get_header(); ?>

<main class="areas-served">
	<?php render_page_hero('areas-served'); ?>

	
	<section class="areas-served-areas">
		<div class="areas-served-areas-grid">
			<?php 
			/**
			 * 	Render Areas Served
			 */
				$grid_items = return_areas_served_grid_items();
				foreach( $grid_items as $grid_item ) :
					$img_src = wp_get_attachment_image_url( $grid_item['image']['id'], 'medium' );
					$img_srcset = wp_get_attachment_image_srcset( $grid_item['image']['id'], 'medium' );
			 ?>
			 	<div class="fade fade-up areas-served-areas-area">
			 		<div class="areas-served-areas-area-image">
			 			<img
			 				 class="areas-served-areas-area-image-img"
			 				 src="<?php echo esc_url( $img_src ); ?>"
			 			     srcset="<?php echo esc_attr( $img_srcset ); ?>"
			 			     sizes="(max-width: 640px) 641px"
			 	     		 alt="Image" >
			 		</div>
			 		<h4 class="display-tf areas-served-areas-area-header"><?php echo $grid_item['header']; ?></h4>
			 	</div>
			<?php endforeach; ?>
		</div>
	</section>
	<?php

	get_template_part('partials/global', 'recent_posts');
	get_template_part('partials/global', 'contact');

	?>
</main>

<?php get_footer(); ?>