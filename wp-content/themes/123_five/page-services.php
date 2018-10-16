<?php
	
	if ( !Pagedata::is_active_page('services') ) {
		header( "Location: " . site_url() . "/404.php" );
	}
	get_header();
	render_page_hero('services');
	get_template_part('modules/services');
	get_template_part('partials/global', 'recent_posts');
	get_template_part('partials/global', 'contact');


	get_footer();
 ?>