<?php

if ( !Pagedata::is_active_page('testimonials') ) {
	header( "Location: " . site_url() . "/404.php" );
}
get_header();
 ?>

<main class="testimonials">
	
	<?php render_page_hero('testimonials'); ?>

	<section class="testimonials-testimonials pagecontent">
		<?php if(have_rows('testimonials-repeater', 'option')): ?>
			<div class="testimonials-testimonials-grid">
			<?php while(have_rows('testimonials-repeater', 'option')): the_row(); ?>
				<?php 
				$select = get_sub_field(' testimonials-repeater-select', 'option');
				$grid_item_class = $select == 'youtube' ? 'testimonials-youtubegriditem' : ''; 
				if(!empty(get_sub_field('testimonials-repeater-image'))){
					$grid_item_class .= ' hasimage';
				}
				?>
				<div class="fade fade-up testimonials-testimonials-grid-item<?php echo $grid_item_class; ?>">
					<?php if( get_sub_field('testimonials-repeater-select', 'option') == 'personal' ): ?>
						<?php if(!empty(get_sub_field('testimonials-repeater-image'))): ?>
							<div style="background-image: url('<?php echo get_sub_field('testimonials-repeater-image') ?>');" class="testimonials-testimonials-grid-item-image"></div>
						<?php endif; ?>
						<div class="testimonials-testimonials-grid-item-textwrap">	
							<div class="testimonials-testimonials-grid-item-personinfo">
								<div class="testimonials-testimonials-grid-item-personinfo-name"><?php echo get_sub_field('testimonials-repeater-name'); ?></div>
							</div>
							<div class="testimonials-testimonials-grid-item-quote">“<?php echo get_sub_field('testimonials-repeater-quote'); ?>”</div>
							<i class="testimonials-testimonials-grid-item-quotemark fa fa-quote-right"></i>
						</div>
					<?php endif; ?>
					<?php if( get_sub_field('testimonials-repeater-select', 'option') == 'youtube' ): ?>
						<div class="testimonials-testimonials-grid-item-youtubecontainer">
							<?php the_sub_field('testimonials-repeater-youtube', 'option'); ?>
						</div>
					<?php endif; ?>

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