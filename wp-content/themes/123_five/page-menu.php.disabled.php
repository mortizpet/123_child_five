<?php
if ( !Pagedata::is_active_page('menu') ) {
	header( "Location: " . site_url() . "/404.php" );
}
get_header(); ?>

<main class="menu main">
	<?php render_page_hero('menu'); ?>
	<section class="menu-menu pagecontent">
		<?php if(have_rows('menu-repeater', 'option')) : ?>
			<div class="menu-menu-grid">
				<?php while(have_rows('menu-repeater', 'option')): the_row();  ?>
					<div class="menu-menu-grid-category">
						
						<?php if( !empty( get_sub_field('menu-category-name', 'option') ) ) : ?>
							<h2 class="menu-menu-grid-category-header"><?php echo get_sub_field('menu-category-name', 'option'); ?></h2>
						<?php endif; ?>
						<?php if( !empty( get_sub_field('menu-category-description', 'option') ) ): ?>
							<div class="menu-menu-grid-category-description"><?php echo get_sub_field('menu-category-description', 'option'); ?></div>
						<?php endif;

						/////////////////
						// photo style //
						/////////////////
						if( get_field('menu-category-type', 'option') == 'masonry' ) :

							if( have_rows('menu-category-repeater', 'option') ): ?>
							<div class="menu-menu-grid-category-grid">
								<?php while( have_rows('menu-category-repeater', 'option') ): the_row(); ?>
									<?php $has_image = get_sub_field('menu-item-picture-toggle', 'option'); ?>
									<div class="menu-menu-grid-category-grid-item<?php echo get_sub_field('menu-item-picture-toggle', 'option') ? ' hasimage' : '';?>">
										<?php if($has_image): ?>
											<div class="menu-menu-grid-category-grid-item-imagecontainer">
												<img src="<?php echo get_sub_field('menu-item-picture', 'option'); ?>" class="menu-menu-grid-category-grid-item-imagecontainer-image">
											</div>
										<?php endif; ?>
										<div class="menu-menu-grid-category-grid-item-textcontainer">
											<?php if( !empty(get_sub_field('menu-item-name', 'option')) ): ?>	
												<h3 class="menu-menu-grid-category-grid-item-textcontainer-header"><?php echo get_sub_field('menu-item-name', 'option'); ?></h3>
											<?php endif; ?>
											<?php if( !empty(get_sub_field('menu-item-description', 'option')) ): ?>	
												<div class="menu-menu-grid-category-grid-item-textcontainer-description"><?php echo get_sub_field('menu-item-description', 'option'); ?></div>
											<?php endif; ?>
											<?php if( !empty(get_sub_field('menu-item-price', 'option')) ): ?>	
												<div class="menu-menu-grid-category-grid-item-textcontainer-price"><?php echo get_sub_field('menu-item-price', 'option'); ?></div>
											<?php endif; ?>
										</div>
									</div>
								<?php endwhile; ?>
							</div>
							<?php endif; ?>
						<?php else: 
							// list style
							if( have_rows('menu-category-list-repeater', 'option') ): ?>
								<div class="menu-menu-grid-category-listgrid">
									<?php while( have_rows('menu-category-list-repeater', 'option') ): the_row();  ?>
										<div class="menu-menu-grid-category-listgrid-item">
											<?php if( !empty(get_sub_field('menu-list-item-name', 'option')) ): ?>	
												<h3 class="menu-menu-grid-category-listgrid-item-header"><?php echo get_sub_field('menu-list-item-name', 'option'); ?></h3>
											<?php endif; ?>
											<?php if( !empty(get_sub_field('menu-list-item-price', 'option')) ): ?>	
												<div class="menu-menu-grid-category-listgrid-item-price"><?php echo get_sub_field('menu-list-item-price', 'option'); ?></div>
											<?php endif; ?>
											<?php if( !empty(get_sub_field('menu-list-item-description', 'option')) ): ?>	
												<div class="menu-menu-grid-category-listgrid-item-description"><?php echo get_sub_field('menu-list-item-description', 'option'); ?></div>
											<?php endif; ?>
										</div>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>

						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</section>
	<?php

	get_template_part('partials/global', 'recent_posts');
	get_template_part('partials/global', 'contact');

	?>
</main>

<?php get_footer(); ?>