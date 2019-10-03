<?php
/**
 * wimp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wimp
 */

if ( ! function_exists( 'wimp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wimp_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wimp, use a find and replace
		 * to change 'wimp' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wimp', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'wimp' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wimp_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'wimp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wimp_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'wimp_content_width', 640 );
}
add_action( 'after_setup_theme', 'wimp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wimp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wimp' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wimp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wimp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wimp_scripts() {
	wp_enqueue_style( 'wimp-style', get_stylesheet_uri() );

	wp_enqueue_style( 'wimp-reset-css', get_template_directory_uri() . '/assets/css/reset.css' );
	wp_enqueue_style( 'wimp-bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'wimp-cookcodesmenu-css', get_template_directory_uri() . '/assets/plugins/cookcodesmenu-master/cookcodesmenu.min.css' );
	// wp_enqueue_style( 'wimp-multiselect-css', get_template_directory_uri() . '/assets/plugins/bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css' );


	// wp_enqueue_style( 'wimp-custom-css', get_template_directory_uri() . '/assets/styles/custom.min.css' );

	wp_enqueue_script( 'wimp-popper-js', get_template_directory_uri() . '/assets/js/popper.min.js', array(), null, true );
	wp_enqueue_script( 'wimp-bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), null, true );
	wp_enqueue_script( 'wimp-cookcodesmenu-js', get_template_directory_uri() . '/assets/plugins/cookcodesmenu-master/jquery.cookcodesmenu.min.js', array('jquery'), null, true );
	// wp_enqueue_script( 'wimp-multiselect-js', get_template_directory_uri() . '/assets/plugins/bootstrap-multiselect-master/dist/js/bootstrap-multiselect.js', array('jquery', 'wimp-bootstrap-js'), null, true );


	wp_enqueue_script( 'wimp-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true );

	wp_enqueue_script( 'wimp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'wimp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wimp_scripts' );

/**
 * Загружаем style.css после плагинов
 */
function my_plugin_unique_style() {
	wp_enqueue_style( 'wimp-custom-css', get_template_directory_uri() . '/assets/styles/custom.min.css' );
}
add_action('wp_enqueue_scripts', 'my_plugin_unique_style', 11 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Произвольные поля Carbon fields
 */
require get_template_directory() . '/inc/carbon-fields-option.php';


/**
 * 404 page title
 */
// function theme_slug_filter_wp_title( $title ) {

// 	if ( is_404() ) {
// 	}
	
// 	$title = 'ADD 404 TITLE TEXT HERE';
// 	// You can do other filtering here, or
// 	// just return $title
// 	return $title;
// }
// // Hook into wp_title filter hook
// add_filter( 'wp_title', 'theme_slug_filter_wp_title' );

/**
 * Change WordPress Logo on Signup Page
 */
function my_login_logo_one() { 

	$general_logo_login = carbon_get_theme_option('general_logo_login');

	?>
		<style type="text/css"> 
			body.login div#login h1 a {
				background-image: url( <?php echo $general_logo_login; ?> );
				/* transform: scale(2,2);
				position: relative;
				top: 50px; */
			}
		</style> 
	<?php 

}
add_action( 'login_enqueue_scripts', 'my_login_logo_one' );