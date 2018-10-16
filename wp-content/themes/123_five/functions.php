<?php 
	
	function enqueue_theme_scripts() {

		$parent_style = 'parent'; // parent theme enqueue tag in parent theme functions.php

		$parent_script = 'parent-main';

		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/build/css/build.css' );
		
		wp_enqueue_style( 'child',
		    get_stylesheet_directory_uri() . '/build/css/build.css',
		    array( $parent_style ),
		    wp_get_theme()->get('Version')
		);

		wp_dequeue_script( 'parent-exec' );

		wp_enqueue_script( 'child-main',
		    get_stylesheet_directory_uri() . '/build/js/build.js',
		    array( $parent_script ),
		    wp_get_theme()->get('Version')
		);

		
		wp_enqueue_script( 'child-exec',
		    get_stylesheet_directory_uri() . '/build/js/exec.js',
		    array( $parent_script ),
		    wp_get_theme()->get('Version')
		);
	}
	add_action( 'wp_enqueue_scripts', 'enqueue_theme_scripts', 100 );




	add_filter('do_remove_homepage_anchors', 'remove_homepage_anchors');
	function remove_homepage_anchors($page_url){
		return str_replace('#', '', $page_url);
	}

	
	function wpse_233129_admin_menu_items() {
	    global $menu;

	    $menu[5][0] = 'Blog Posts';

	    foreach ( $menu as $key => $value ) {
	        if ( 'edit.php' == $value[2] ) {
	            $oldkey = $key;
	        }
	        
	    }
	    
	    // change Posts menu position in the backend
	    $newkey = 83; // use whatever index gets you the position you want
	    // if this key is in use you will write over a menu item!
	    $menu[$newkey]=$menu[$oldkey];
	    unset($menu[$oldkey]);

	}

	function get_current_url(){
		global $wp;
		return home_url(add_query_arg(array(),$wp->request));
	}
	
	add_action( '123_after_mobile_nav', 'action_123_after_mobile_nav' );

	function action_123_after_mobile_nav(){
		?>
		<div class="mobileheaderinfo">
			<div class="mobileheaderinfo-grid">
				<div class="mobileheaderinfo-grid-item">
					<div class="mobileheaderinfo-grid-item-left">
						<i class="mobileheaderinfo-grid-item-left-icon fa fa-phone"></i>
					</div>
					<div class="mobileheaderinfo-grid-item-right">
						<a href="tel:<?php echo get_the_phone('tel') ?>"><?php echo get_the_phone(); ?></a>
					</div>
				</div>
				<div class="mobileheaderinfo-grid-item">
					<div class="mobileheaderinfo-grid-item-left">
						<i class="mobileheaderinfo-grid-item-left-icon fa fa-map-marker"></i>
					</div>
					<div class="mobileheaderinfo-grid-item-right">
						<?php echo get_master_address(''); ?>
					</div>
				</div>
			</div>
		</div>
		<?php 
			if( !get_field('quickquote-disable','options') ) :
		 ?>
			<div class="mobileheaderquote">
				<div class="mobileheaderquote-wrapper">
					<div class="mobileheaderquote-wrapper-text"><?php the_field('header-bar-text', 'option') ?></div>
					<div class="mobileheaderquote-wrapper-button estimate-toggle"><?php the_field('quickquote-button-text', 'option'); ?> <i class="fa fa-angle-right"></i></div>
				</div>
			</div>
		<?php
		endif;
	}

	function do_update_logo_text_image(){
		$bg = get_template_directory() . '/library/img/logo-canvas.png';

		$phpimg = new PHPImage();

		$phpimg->setDimensionsFromImage($bg);
		$phpimg->setQuality(9);
		$phpimg->setFont(get_stylesheet_directory() . '/library/fonts/Montserrat-Black.ttf');

		$text_color = array(255, 255, 255);

		// set parent theme headercolor field
		if( get_field('navs-text-toggle', 'option') ){
			$text_color = hex_to_rgb(get_field('navs-text', 'option'));
		}
		// set child theme header color field
		if( get_field('add_extra_theme_colors_header-logotoggle', 'option') ){
			$text_color = hex_to_rgb(get_field('add_extra_theme_colors_header-logopicker', 'option'));
		}


		$phpimg->setTextColor($text_color);

		$phpimg->text(get_field('site_title', 'option'), array(
	        'fontSize' => 60, 
	        'x' => 0,
	        'y' => 0,
	        'width' => 560,
	        'height' => 128,
	        'alignHorizontal' => 'center',
	        'alignVertical' => 'center',
	    ));

		$phpimg->imagetrim();

		$phpimg->setOutput('png');

		$phpimg->save(wp_upload_dir()['basedir'] . '/logo-text.png');
		chmod(wp_upload_dir()['basedir'] . '/logo-text.png', 0755);
	}

	// Render Title for Footer 'Links' Section
	function action_123_before_mobile_footer_social_links(){
		?>
			<h2 class="fade mobilefooter-h2">extra links</h2>
		<?php
	}
	add_action( '123_before_mobile_footer_social_links', 'action_123_before_mobile_footer_social_links' );

	add_action( '123_before_desktop_footer_social_links', 'action_123_before_desktop_footer_social_links' );

	function action_123_before_desktop_footer_social_links(){
		?>
		<h2 class="fade footer-h2">extra Links</h2>
		<?php
	}

	//////////////////////////////////
	// Render Page Hero Refactoring //
	//////////////////////////////////


	function render_page_hero($slug){
		// should be depricated
		// $headertext = get_field($slug . '-alt-toggle', 'option') ? get_field($slug . '-alt', 'option') : $slug;
		$bgfieldname = '';
		switch ($slug) {
			case 'blog':
				$bgfieldname = 'general-blog-bg';
				break;
			
			case 'coupons':
				$bgfieldname = 'general-coupons-bg';
				break;

			default:
				$bgfieldname = $slug . '-bg';
				break;
		}
		$bgimagestring = '';
		if( $slug !== 'areas-served' ){
			$bgimagestring = 'style="background-image: url(' . get_field($bgfieldname, 'option') . ');"';
		}
		?>	
			<section class="<?php echo $slug ?>-hero hero"<?php echo $bgimagestring; ?>>

				<div class="<?php echo $slug ?>-hero-text hero-text">
					<h1 class=""><?php Pagedata::the_active_page_name($slug); ?></h1>
					<?php echo do_action( '123_action_after_page_hero_header' ); ?>
				</div>

				<div class="<?php echo $slug ?>-hero-tint hero-tint"></div>
				
				<?php if( $slug == 'areas-served' ): ?>
					<div class="areas-served-hero-map" id="map"></div>
				<?php endif; ?>

				<?php if( $slug == 'contact' ): ?>
					<div class="contact-hero-map"></div>
				<?php endif; ?>

			</section>


			<section class="herocontent">
				<div class="<?php echo $slug ?>-herocontent-text herocontent-text">
					<h1 class="<?php echo $slug ?>-herocontent-text-header herocontent-text-header">
						<?php Pagedata::the_active_page_name($slug); ?>
					</h1>
					<?php echo do_action( '123_action_after_page_hero_header' ); ?>
				</div>
			</section>
		<?php
	}

		// add child-theme specific fields directly to the hidden parent field
	function add_colorpickers(){
		// Set the 'hidden' Parent Group (no label)
		$parent = 'field_123_colorpicker_wrapper';
		// List new Fields to Make : acf 'label' => acf 'name'
		$choices = [
			'Nav Logo Text'								=> 'header-logo',
			'Button Background'							=> 'button-bg',
			'Button Text'								=> 'button-text',
			'Footer Background'							=> 'footer-bg',
			'Footer Headers + Underlines'		 		=> 'footer-headers',
			'Footer Text'								=> 'footer-text',
		];
		// Create new Fields
		foreach ($choices as $label => $name) {
			$key = 'field_cp_' . $name;
			acf_add_local_field(array(
				'key' => $key . 'picker',
				'label' => $label,
				'name' => $name . 'picker',
				'type' => 'color_picker',
				'parent' => $parent,
				'wrapper' => array(
					'width' => 25,
				),
			));
			acf_add_local_field(array(
				'key' => $key . 'toggle',
				'label' => 'On / Off',
				'name' => $name . 'toggle',
				'type' => 'true_false',
				'ui' => 1,
				'parent' => $parent,
				'wrapper' => array(
					'width' => 75,
				),
			));
		}
		if(get_field('field_faauoiegwuf23', 'options')){
			update_field('field_faauoiegwuf23', false, 'options');
			function restore_colorpicker_togglevalue (){
				update_field('field_faauoiegwuf23', true, 'options');
			}
			add_action( 'switch_theme','restore_colorpicker_togglevalue' );
		}
	}
	// tweak fields as they are loaded from the db
	function adjust_colorpicker_values($field){
		// fields to reName
		$cp_parents_to_rename = array(
			'field_8123afaasfdaef', 			// navs-bg
			'field_21387fzadsf',				// navs-text
			'field_27fzzzzadsf',				// buttons-underlines
		);
		// give parent group a css ID (to be hidden)
		$parent = 'field_123_colorpicker_wrapper';
		if( $field['key'] == $parent){
			$field['wrapper'] = array(
				'width' => '',
				'class' => '',
				'id' => 'colorpicker_hiddengroup',
			);
		}
		// ReName certain fields...
		if( in_array($field['key'], $cp_parents_to_rename) ){
			$field['label'] = ' ';
			if($field['key'] == 'field_8123afaasfdaef' ){
				$field['label'] = 'Nav Background';
			}
			if($field['key'] == 'field_21387fzadsf' ){
				$field['label'] = 'Nav Links';
			}
			if($field['key'] == 'field_27fzzzzadsf' ){
				$field['label'] = 'Accent Color';
			}
		}
		// go on to the next one...
		return $field;
	}
	// Seamlessly integrate new fields (inside hidden parent) with fields from the parent theme
	function my_acf_admin_head() {
		$screen = get_current_screen();
		if ( $screen->id == "toplevel_page_general-settings" ) :
			?>
				<style type="text/css">
					
					#colorpicker_hiddengroup {
						padding: 0;
						border: none;
						border-top: 1px solid #eeeeee;
					}
					#colorpicker_hiddengroup .acf-fields.-border {
						border: none;
					}

					#colorpicker_hiddengroup > .acf-label{
						display: none;
					}
					.acf-field-faauoiegwuf23,
					.acf-field-29wfeauajhadfsk {
						display: none;
					}
				</style>
			<?php
		endif;
	}

	// tweak fields as they are loaded from the db
	add_filter('acf/load_field', 'adjust_colorpicker_values');
	// add child-theme specific fields directly to the hidden parent field
	add_action( 'acf/init', 'add_colorpickers', 12 );
	// Seamlessly integrate new fields (inside hidden parent) with fields from the parent theme
	add_action('acf/input/admin_head', 'my_acf_admin_head');
?>