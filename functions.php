<?php
/**
 * paper-anchor functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package paper-anchor
 */

if ( ! function_exists( 'paper_anchor_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function paper_anchor_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on paper-anchor, use a find and replace
	 * to change 'paper-anchor' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'paper-anchor', get_template_directory() . '/languages' );

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
		'menu-1' => esc_html__( 'Primary', 'paper-anchor' ),
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
	add_theme_support( 'custom-background', apply_filters( 'paper_anchor_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'paper_anchor_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function paper_anchor_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'paper_anchor_content_width', 640 );
}
add_action( 'after_setup_theme', 'paper_anchor_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function paper_anchor_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'paper-anchor' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'paper-anchor' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'paper_anchor_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function paper_anchor_scripts() {
	wp_enqueue_style( 'paper-anchor-style', get_stylesheet_uri() );

	wp_enqueue_style( 'paper-anchor-crane-styles', get_template_directory_uri() . '/dist/style.css', array(), '20151215', false );

	wp_enqueue_script( 'paper-anchor-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'paper-anchor-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'paper_anchor_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Theme Settings Page.
 */
require get_template_directory() . '/inc/theme-settings.php';

/**
 * Add GA Tracking Code to Website.
 */
function crane_ga_tracking_code() { ?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', '<?php echo esc_attr( get_option('google_ua_code') ); ?>', 'auto');
	  ga('send', 'pageview');

	</script>
<?php }
add_action( 'wp_footer', 'crane_ga_tracking_code', 10 );
