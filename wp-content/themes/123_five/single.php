<?php 

if ( !Pagedata::is_active_page('blog') ) {
	header( "Location: " . site_url() . "/404.php" );
}

get_header(); 

?>

<main class="single main">
	<section class="single-hero" style="background-image: url('<?php echo get_blog_image($post->ID); ?>');">
		<h1 class="single-hero-header"><?php the_title(); ?></h1>
		<div class="single-hero-tint"></div>
	</section>
	<section class="single-single section">
		<h2 class="single-single-title"><?php the_title(); ?></h2>
		<div class="single-single-date"><?php echo 'Posted on: ' . date('n/j/Y', strtotime(get_the_date())) . ' at ' . date('g:i A', strtotime(get_the_date())); ?></div>
		<div class="single-single-content"><?php echo wpautop($post->post_content); ?></div>
		<?php get_template_part('partials/navigation/blog', 'sidebar'); ?>
		<div class="single-single-socialcontainer">
			<?php include locate_template( 'modules/sub-modules/social-icons.php' ); ?>
		</div>
	</section>
</main>


<?php get_footer(); ?>