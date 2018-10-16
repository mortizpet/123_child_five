<?php get_header(); ?>
<main class="home">
	<section class="home-hero hero">
		<div class="home-hero-text hero-text">
			<h1 class="home-hero-text-header hero-text-header"><?php echo get_field('home-hero-header-text', 'option'); ?></h1>
			<?php if( !get_field('disable-slider-button', 'option') ): ?>
				<a href="<?php echo site_url(); ?>/company" class="home-hero-text-button"><?php echo !empty(get_field('slider-button-text', 'option')) ? get_field('slider-button-text', 'option') : 'Learn More'; ?></a>	
			<?php endif; ?>
		</div>
		<?php $rows = get_field('general-home-slider', 'option'); ?>
		<?php if(have_rows('general-home-slider', 'option') && count($rows) >= 3): ?>
		<div class="home-hero-slides">
			<?php while(have_rows('general-home-slider', 'option')): the_row(); ?>
				<div style="background-image: url('<?php echo get_sub_field('general-home-slider-image'); ?>');" class="home-hero-slides-slide"></div>
			<?php endwhile; ?>
		<?php else: ?>
			<div style="background-image: url('<?php echo get_template_directory_uri(); ?>/library/img/home/slides/slide01.jpg');" class="home-hero-slides-slide"></div>
			<div style="background-image: url('<?php echo get_template_directory_uri(); ?>/library/img/home/slides/slide02.jpg');" class="home-hero-slides-slide"></div>
			<div style="background-image: url('<?php echo get_template_directory_uri(); ?>/library/img/home/slides/slide03.jpg');" class="home-hero-slides-slide"></div>
			<div style="background-image: url('<?php echo get_template_directory_uri(); ?>/library/img/home/slides/slide04.jpg');" class="home-hero-slides-slide"></div>
		</div>
		<?php endif; ?>
		<div class="home-hero-tint hero-tint"></div>
	</section>
	
	
	<section class="home-cover">
		<div class="home-cover-content">
			<h1 class="home-cover-content-header"><?php the_field('home-hero-header-text', 'option') ?></h1>
			<?php if( !empty(get_field('home-hero-header-text', 'option')) ): ?>
				<div class="home-cover-content-subheader"><?php the_field('home-hero-header-text-2', 'option') ?></div>
			<?php endif; ?>
			<?php if( !get_field('quickquote-disable', 'option') ): ?>
				<a href="#" class="home-cover-content-button estimate-toggle"><?php the_field('quickquote-button-text', 'option') ?><i class="fa fa-angle-right"></i></a>
			<?php endif; ?>
		</div>
	</section>
	<?php if( !get_field('quickquote-disable', 'option') ): ?>
		<section class="home-quickquote">
			<div class="home-quickquote-wrapper">
				<div class="home-quickquote-wrapper-left"><?php the_field('quickquote-header', 'option') ?></div>
				<div class="home-quickquote-wrapper-right">
					<div class="home-quickquote-wrapper-right-button estimate-toggle"><?php the_field('quickquote-button-text', 'option') ?> <i class="fa fa-angle-right"></i></div>
				</div>
			</div>	
		</section>
	<?php endif; ?>
	<?php 
		/**
		 * Featured Services Section
		 * 		with View All c2a
		 * 		limited to 3 featured items
		 */
		if ( Pagedata::is_active_page('services') ) :
	?>	
	<section class="services">
		<h2 class="home-services-header section-header">
			<?php Pagedata::the_active_page_name('services'); ?>
		</h2>
		<?php 
			if(have_rows('services-repeater', 'option')) :
		 ?>
				<div class="services-grid">
		<?php 
			while(have_rows('services-repeater', 'option')) : 
				// begin iterating thru services items
				the_row();
		 ?>
			<div class="services-grid-item">
				<div class="services-grid-item-imagecontainer">
					<?php 
						if( get_sub_field('service-image','options') ){
							$gridItemImage = get_sub_field('service-image','options');
						} else {
							$gridItemImage = get_field('featured-placeholder','options');
						}
					 ?>
					 <figure class="services-grid-item-imagecontainer-figure">
						<img src="<?php echo $gridItemImage['url']; ?>" class="services-grid-item-imagecontainer-figure-image">
					 </figure>
				</div>
				<div class="services-grid-item-descriptioncontainer">
					<h3 class="services-grid-item-descriptioncontainer-header"><?php echo get_sub_field('service-name', 'option'); ?></h3>
					<div class="services-grid-item-descriptioncontainer-description"><?php echo get_sub_field('service-description', 'option'); ?></div>
					<div class="services-grid-item-descriptioncontainer-price"><?php echo get_sub_field('service-price', 'option'); ?></div>
				</div>
			</div>
			<?php 
			if(get_row_index() > 2){
				break;
			}
			endwhile; ?>
		</div>
		<a href="<?php echo site_url(); ?>/services" class="home-services-viewall button-viewall">view all <i class="fa fa-angle-right"></i></a>
		<?php endif; ?>
	</section>
	<?php endif; ?>
	<?php 
		//////////////////////////////
		// Testimonials as a Slider //
		//////////////////////////////
		if ( Pagedata::is_active_page('testimonials') ) :
	 ?>
		<?php if( have_rows('testimonials-repeater', 'option') && get_field('testimonials-toggle', 'option') ): ?>
		<section class="<?php echo get_field('testimonials-toggle', 'option') == false ? 'unfancytestimonials' : ''; ?> home-testimonials section">
			
			<h2 class="home-testimonials-header section-header">
				<?php Pagedata::the_active_page_name('testimonials'); ?>				
			</h2>
			
			<?php if(have_rows('testimonials-repeater', 'option')): ?>
			<div class="home-testimonials-grid">
				<?php while(have_rows('testimonials-repeater', 'option')): the_row(); 

					$select = get_sub_field('testimonials-repeater-select', 'option');
					$grid_item_class = $select == ' youtube' ? 'testimonials-youtubegriditem' : ''; 
					$grid_item_class .= !empty(get_sub_field('testimonials-repeater-image')) ? ' hasimage' : '';
				 ?>
				<div class="home-testimonials-grid-item<?php echo $grid_item_class ?>">
					<?php if( get_sub_field('testimonials-repeater-select', 'option') == 'personal' ): ?>
					<?php if( !empty(get_sub_field('testimonials-repeater-image')) ): ?>
						<img src="<?php echo get_sub_field('testimonials-repeater-image') ?>" class="home-testimonials-grid-item-image">
					<?php endif; ?>
					<div class="home-testimonials-grid-item-name"><?php echo get_sub_field('testimonials-repeater-name'); ?></div>


					<div class="home-testimonials-grid-item-quote">
						<?php
							$grid_item_quote = wpautop(get_sub_field('testimonials-repeater-quote'));
							echo "\"";
							if( strlen($grid_item_quote) > 250 ){
								echo substr($grid_item_quote, 0, 250) . "...";
							} else {
								echo $grid_item_quote;
							}
							echo "\""; 
						 ?>
					</div>
					

					<i class="home-testimonials-grid-item-quotemark fa fa-quote-right"></i>
					<?php endif; ?>
				
					<?php if( get_sub_field('testimonials-repeater-select', 'option') == 'youtube' ): ?>
						<div class="home-testimonials-grid-item-youtubecontainer">
						<?php the_sub_field('testimonials-repeater-youtube', 'option'); ?>
						</div>
					<?php endif; ?>
				

				</div>
				
				<?php endwhile; ?>

				<div class="home-testimonials-arrows">
					<i class="home-testimonials-arrows-left fa fa-angle-left grey"></i>
					<i class="home-testimonials-arrows-right fa fa-angle-right"></i>
				</div>
	


				
			</div>
			<a href="<?php echo site_url() ?>/testimonials" class="home-testimonials-viewall button-viewall">view all <i class="fa fa-angle-right"></i></a>
			<?php endif; ?>
		</section>
		<?php endif; ?>
	<?php endif; ?>
	<?php 
		//////////////////////////////
		// Areas Served BG and Link //
		//////////////////////////////
		if ( Pagedata::is_active_page('areas-served') ) :
	 ?>
		<section class="home-areasserved section">
			<h2 class="home-areasserved-header section-header">
				<?php Pagedata::the_active_page_name('areas-served'); ?>
			</h2>
			<div class="home-areasserved-map">
				<a href="<?php echo site_url(); ?>/areas-served" class="home-areasserved-map-learnmore button-viewall" href="<?php echo get_template_directory_uri() ?>/areasserved">learn more <i class="fa fa-angle-right"></i></a>
				<div class="home-areasserved-map-tint"></div>
				<div class="home-areasserved-map-gmap areas-served-hero-map" id="map"></div>
			</div>
		</section>
	<?php endif; ?>
</main>

<?php get_footer(); ?>