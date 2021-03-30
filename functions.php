<?php
	/**
	 * Bootstrap 4 on Wordpress functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
	 * @package 	WordPress
	 * @subpackage 	Bootstrap 4.0.0
	 * @author 		Babobski
	 */
	
	
	/* ========================================================================================================================
	
	Add language support to theme
	
	======================================================================================================================== */
	add_action('after_setup_theme', 'my_theme_setup');
	function my_theme_setup(){
		load_theme_textdomain('wp_babobski', get_template_directory() . '/language');
	}
	


	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'external/bootstrap-utilities.php' );
	require_once( 'external/bs4navwalker.php' );
	
	/* ========================================================================================================================
	
	Add html 5 support to wordpress elements
	
	======================================================================================================================== */
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );

	/* ========================================================================================================================
	
	Theme specific settings
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	
	//add_image_size( 'name', width, height, crop true|false );
	
	register_nav_menus(array('primary' => 'Primary Navigation'));

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'bootstrap_script_init' );

	add_filter( 'body_class', array( 'BsWp', 'add_slug_to_body_class' ) );

	/* ========================================================================================================================
	
	Custom Post Types - include custom post types and taxonomies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	
	======================================================================================================================== */

 /* =========================================================================================================================
  * Disable all admin bars when developing
  * =========================================================================================================================
  */
  add_filter('show_admin_bar', '__return_false');

	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

  function bootstrap_script_init() {
//    wp_deregister_script('jquery');
      wp_enqueue_script('jquery');

//    wp_register_script('slick', get_template_directory_uri().'/js/slick.min.js', null, null);
//		wp_enqueue_script('slick');
    wp_register_script('core', get_template_directory_uri().'/js/core.min.js', null, null);
		wp_enqueue_script('core');
    wp_localize_script( 'core', 'ajax_info', array(
    'ajax_url' => admin_url( 'admin-ajax.php' )
	));

    wp_register_script('vendors', get_template_directory_uri().'/js/vendors.min.js', null, null);
    wp_enqueue_script('vendors');

		wp_register_style('style', get_stylesheet_directory_uri().'/style.css', null, null);
		wp_enqueue_style('style');
	}
	
	/* ========================================================================================================================
	
	Security & cleanup wp admin
	
	======================================================================================================================== */
	
	//remove wp version
	function theme_remove_version() {
	return '';
	}
	
	add_filter('the_generator', 'theme_remove_version');
	
	//remove default footer text
	function remove_footer_admin () {
		echo "";
	}
	 
	add_filter('admin_footer_text', 'remove_footer_admin');
	
	//remove wordpress logo from adminbar
	function wp_logo_admin_bar_remove() {
		global $wp_admin_bar;

		/* Remove their stuff */
		$wp_admin_bar->remove_menu('wp-logo');
	}
	
	add_action('wp_before_admin_bar_render', 'wp_logo_admin_bar_remove', 0);
	
	// Remove default Dashboard widgets
	function disable_default_dashboard_widgets() {
	
		//remove_meta_box('dashboard_right_now', 'dashboard', 'core');
		remove_meta_box('dashboard_activity', 'dashboard', 'core');
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
		remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
		remove_meta_box('dashboard_plugins', 'dashboard', 'core');
	
		remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
		remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
		remove_meta_box('dashboard_primary', 'dashboard', 'core');
		remove_meta_box('dashboard_secondary', 'dashboard', 'core');
	}
	add_action('admin_menu', 'disable_default_dashboard_widgets');
	
	remove_action('welcome_panel', 'wp_welcome_panel');
	
	/* ========================================================================================================================
	
	Custom login
	
	======================================================================================================================== */
	
	// Add custom css
	function my_custom_login() {
		echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/style.css" />';
	}
	add_action('login_head', 'my_custom_login');
	
	// Link the logo to the home of our website
	function my_login_logo_url() {
		return get_bloginfo( 'url' );
	}
	add_filter( 'login_headerurl', 'my_login_logo_url' );
	
	// Change the title text 
	function my_login_logo_url_title() {
		return 'Bootstrap 4 on WordPress';
	}
	add_filter( 'login_headertitle', 'my_login_logo_url_title' );
	

	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function bootstrap_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>
		<li class="media">
			<div class="media-left">
				<?php echo get_avatar( $comment ); ?>
			</div>
			<div class="media-body">
				<h4 class="media-heading"><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</div>
		<?php endif;
	}

/* ===========================================================================================================================
 *
 * Remove Cruft
 * ===========================================================================================================================
*/
  remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
  remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
  remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
  remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
  remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
  remove_action( 'wp_head', 'rel_canonical' );
  remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

  
/*
 *
 * The Option Init With Acf
 * 
*/
  
  if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
    }
    
/*
* 
* svg upload
* 
*/
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    
    
    // return
    return $path;
    
}

add_action( 'wp_ajax_nopriv_hide_firewall_popup', 'hide_firewall_popup_func' );
add_action( 'wp_ajax_hide_firewall_popup', 'hide_firewall_popup_func' );

function hide_firewall_popup_func() {
    $result = false;
    if(isset($_POST['hide']) && $_POST['hide']){
        $cookie_name = "firewall_popup";
        $cookie_value = true;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        $result = true;
    }
    echo $result;exit;
}