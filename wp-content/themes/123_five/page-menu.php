<?php
	if ( !Pagedata::is_active_page('menu') ) {
		header( "Location: " . site_url() . "/404.php" );
	}
	get_header();
 ?>

<?php 
render_page_hero('menu');
get_template_part('modules/menu');

 ?>


<?php 
	get_footer();
 ?>