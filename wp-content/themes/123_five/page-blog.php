<?php 

if ( !Pagedata::is_active_page('blog') ) {
	header( "Location: " . site_url() . "/404.php" );
}

get_header(); ?>

<main class="blog">
	<?php render_page_hero('blog') ?>
	<section class="blog-blog pagecontent">
		<?php 
		global $wp_query;


		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => get_field('posts-per-page', 'option'),
			'paged' => $paged,
		);
		if( isset($wp_query->query['monthnum']) ){
			$args['monthnum'] = $wp_query->query['monthnum'];
		}
		if( isset($wp_query->query['year']) ){
			$args['year'] = $wp_query->query['year'];
		}
		$the_query = new WP_Query($args);
		if($the_query->have_posts()) : ?>
		<div class="blog-blog-grid">
			<?php while($the_query->have_posts()): $the_query->the_post();  ?>
			<div class="blog-blog-grid-item">
				<div class="blog-blog-grid-item-textcontainer">
					<a href="<?php echo get_permalink(); ?>" class="blog-blog-grid-item-textcontainer-header"><?php echo $post->post_title; ?></a>
					<div class="blog-blog-grid-item-textcontainer-date"><?php echo 'Posted on: ' . date('n/j/Y', strtotime($post->post_date)) . ' at ' . date('g:i A', strtotime($post->post_date)); ?></div>
					<div class="blog-blog-grid-item-textcontainer-description"><?php echo wp_trim_words($post->post_content, 15); ?></div>
					<div class="blog-blog-grid-item-socialcontainer">
						<?php include locate_template( 'modules/sub-modules/social-icons.php' ); ?>
				</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
		


		<?php get_template_part('partials/navigation/blog', 'sidebar'); ?>
		<div class="blog-blog-pagination">

			<?php 

			$original_global = $wp_query;
			$wp_query = null;
			$wp_query = $the_query;

			echo paginate_links(array(
				'prev_text' => '<< Prev',
			));

			wp_reset_postdata();

			$wp_query = $original_global;

			?>
		</div>
		
		<?php endif; ?>
	</section>
	<?php get_template_part('partials/global', 'contact');?>
</main>

<?php get_footer(); ?>