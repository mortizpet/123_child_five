<?php
if ( !Pagedata::is_active_page('company') ) {
	header( "Location: " . site_url() . "/404.php" );
}
get_header(); ?>

<main class="company main">
	<!-- 123_websites thanks you -->
	<?php 
		$selected_option = get_field('company-page-option-toggle', 'option');
		
		if($selected_option == 'option1' && !empty(get_field('company-subheader', 'option'))):

			add_action( '123_action_after_page_hero_header', 'after_page_hero_header' );

			function after_page_hero_header(){
				?>
					<div class="company-hero-text-subheader hero-text-subheader"><?php echo get_field('company-subheader', 'option') ?></div>
				<?php
			}

		endif;

		render_page_hero('company'); 

	?>
	<?php if($selected_option == 'option1'): ?>
		<?php
			if(!empty(get_field('company-content', 'options'))) :
		 ?>
	<section class="company-wysiwyg pagecontent">
		<?php echo get_field('company-content','options'); ?>
	</section>
	 <?php 
		endif;
	  ?>
	<?php endif; ?>
	<?php if($selected_option == 'option2'): ?>
	<?php if(have_rows('company-employee-repeater', 'option')): ?>
	
	<section class="company-employees section pagecontent">
		<div class="company-employees-grid">
			<?php while(have_rows('company-employee-repeater', 'option')): the_row();?>
	
				<div class="company-employees-grid-item fade fade-up">
					<div class="company-employees-grid-item-imagecontainer">
						<?php if( !empty(get_sub_field('company-employee-image', 'option')) ): ?>
							<img src="<?php echo get_sub_field('company-employee-image', 'option'); ?>" class="company-employees-grid-item-imagecontainer-image">
						<?php else: ?>
							<img src="<?php the_field('featured-placeholder', 'option'); ?>" class="company-employees-grid-item-imagecontainer-image">
						<?php endif; ?>
					</div>
					<div class="company-employees-grid-item-rightwrap">	
						<div class="company-employees-grid-item-textcontainer">
							<h3 class="company-employees-grid-item-textcontainer-name"><?php echo get_sub_field('company-employee-name'); ?></h3>
							<div class="company-employees-grid-item-textcontainer-title"><?php echo get_sub_field('company-employee-title'); ?></div>
							<div class="company-employees-grid-item-textcontainer-description"><?php echo get_sub_field('company-employee-description'); ?></div>	
						</div>
						<?php 
							if( have_rows('company-employee-socialmedia', 'options') ) : 
						 ?>
							<ul class="sociallinks">
							<?php 
								while( have_rows('company-employee-socialmedia', 'options') ) : 
								the_row();
								$sp_sm_url = get_sub_field('url');
								$sp_sm_icon = get_sub_field('fonticon');
								$sp_sm_img = get_sub_field('image');
						 	 ?>
						 		<li class="sociallinks-item">
									<a class="sociallinks-item-link" href="<?php echo $sp_sm_url; ?>">
										<i class="sociallinks-item-link-icon fa <?php echo $sp_sm_icon; ?>"></i>
									</a>
						 		</li>
							 <?php 
								endwhile;
							 ?>
							</ul>
						 <?php
							endif;
						 ?>
					</div>

				</div>
			<?php endwhile; ?>
		</div>
	</section>
	<?php endif; ?>
	<?php endif; ?>
	<?php

	get_template_part('partials/global', 'recent_posts');
	get_template_part('partials/global', 'contact');

	?>
</main>

<?php get_footer(); ?>