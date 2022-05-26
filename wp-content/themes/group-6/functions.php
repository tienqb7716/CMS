<?php

/**
 * group-6 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package group-6
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}
/**
@ Chèn CSS và Javascript vào theme
@ sử dụng hook wp_enqueue_scripts() để hiển thị nó ra ngoài front-end
 **/
function my_styles()
{
	/*
    * Hàm get_stylesheet_uri() sẽ trả về giá trị dẫn đến file style.css của theme
    * Nếu sử dụng child theme, thì file style.css này vẫn load ra từ theme mẹ
    */
	wp_register_style(
		'main-style',
		get_template_directory_uri() . '/style.css',
		'all'
	);
	wp_enqueue_style('main-style');
}
add_action('wp_enqueue_scripts', 'my_styles');
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function group_6_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on group-6, use a find and replace
		* to change 'group-6' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('group-6', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');


	/**
@ Tạo menu vào theme
@ sử dụng hook wp_enqueue_scripts() để hiển thị nó ra ngoài front-end
	 **/
	add_theme_support('menus');

	function register_menus()
	{
		register_nav_menus(
			array(
				'top-menu' => 'Top Menu',
			)
		);
	}
	add_action('init', 'register_menus');

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'group_6_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 150,
			'width'       => 150,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
	_styles();

	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array ( 'jquery' ), 1.1, true);
		
}
add_action('after_setup_theme', 'group_6_setup');

function _styles() {
	/*
	* Hàm get_stylesheet_uri() sẽ trả về giá trị dẫn đến file style.css của theme
	* Nếu sử dụng child theme, thì file style.css này vẫn load ra từ theme mẹ
	*/
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/bootstrap.min.css',
	'all' );
	wp_enqueue_style( 'bootstrap' );
	wp_register_style( 'main-style', get_template_directory_uri() . '/style.css',
	'all' );
	wp_enqueue_style( 'main-style' );
	
}
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function group_6_content_width()
{
	$GLOBALS['content_width'] = apply_filters('group_6_content_width', 640);
}
add_action('after_setup_theme', 'group_6_content_width', 0);
 
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function group_6_widgets_init()
{
	//sidebar-1
	register_sidebar(
		array(
			'name'          => esc_html__('Right Sidebar', 'group-6'),
			'id'            => 'buzzsidebarone',
			'description'   => esc_html__('Add widgets here.', 'group-6'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title wow fadeInUp" data-wow-delay="0.3s">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(array(
		'name'          => esc_html__('Home Main Widget Area', 'group-6'),
		'id'            => 'buzzstorehomearea',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title wow fadeInUp" data-wow-delay="0.3s">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(
		'name'          => esc_html__('Footer Widget Area One', 'group-6'),
		'id'            => 'buzzstorefooterone',
		'description'   => esc_html__('Add widgets here.', 'group-6'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'group_6_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function group_6_scripts()
{
	wp_enqueue_style('group-6-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('group-6-style', 'rtl', 'replace');

	wp_enqueue_script('group-6-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	// thêm thư viện font awesome
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', _S_VERSION);

	/* Simple Line Icons */
	wp_enqueue_style('simple-line-icons', get_template_directory_uri() . '/assets/library/simple-line-icons/css/simple-line-icons.css', _S_VERSION);

	/* Animation */
	wp_enqueue_style('animate', get_template_directory_uri() . '/assets/library/animate/animate.css', _S_VERSION);
}
add_action('wp_enqueue_scripts', 'group_6_scripts');

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
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

//Tạo toggle
if (!function_exists('buzzstore_main_header')) {
	function buzzstore_main_header()
	{ ?>
		<div class="buzz-main-header">
			<div class="buzz-container buzz-clearfix">
				<div class="buzz-site-branding">
					<button class="buzz-toggle mobile-only" data-toggle-target=".header-mobile-menu" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
						<div class="one"></div>
						<div class="two"></div>
						<div class="three"></div>
					</button>


				</div><!-- .site-branding -->

				<?php do_action('buzzstore_search'); ?>
				<!-- search section -->

			</div>
		</div><!-- Main header section -->
		<?php
	}
}
add_action('buzzstore_header', 'buzzstore_main_header', 9);


/**
 * Get 3 new post and display them;
 */
add_shortcode('group6_new_post', 'group_6_print_new_post');
if (!function_exists('group_6_print_new_post')) {
	function group_6_print_new_post(){
		if (function_exists('add_shortcode')) { ?>
			<h2><em>New post</em></h2>
			<div class="row row-cols-1 row-cols-md-3 g-4">
				<?php
				$args = array(
					'post_status' => 'publish', // Chỉ lấy những bài viết được publish
					'showposts' => 3, // số lượng bài viết
				);
				$postquerys = new WP_Query($args);
				if ($postquerys->have_posts()) {
					while ($postquerys->have_posts()) : $postquerys->the_post();?>
						<div class="col">
							<div class="card border-0">
								<div class="border">
									<div class="card-img-top">
										<?php
										the_post_thumbnail('full', array('class' => 'img-fluid'));
										?>
									</div>
								</div>
								<div class="card-body card-custom">
									<a href="<?php the_permalink(); ?>"></a>
									<h4 class="card-title" style="text-align: center;"><a href=" <?php the_permalink(); ?> " class="text-decoration-none " title=" <?php the_title(); ?> "><?php the_title(); ?></a></h4>
									<p class="card-text mt-3"> <?php echo get_the_excerpt() ?></p>
									<span class="badge rounded-pill  text-dark"><?php echo get_the_date(); ?></span>
								</div>
							</div>
						</div>
				<?php endwhile;
				} ?>
			</div>
	<?php  }
	};
};



/**
 * Footer Widget One
*/
function custom_footer_widget_one() {
	$args = array(
		'id' 							=> 'footer-widget-col-one',
		'name'						=> __('Footer Column One', 'text_domain'),
		'description'			=> __('Column One', 'text_domain'),
		'before_title'		=> '<h3 class="title">',
		'after_title' 		=> '</h3>',
		'before_widget'		=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'    => '</div>'
	);
	register_sidebar( $args );
}
add_action( 'widgets_init', 'custom_footer_widget_one');


/**
 * Footer Widget Two
*/
function custom_footer_widget_two() {
	$args = array(
		'id' 							=> 'footer-widget-col-two',
		'name'						=> __('Footer Column Two', 'text_domain'),
		'description'			=> __('Column One', 'text_domain'),
		'before_title'		=> '<h3 class="title">',
		'after_title' 		=> '</h3>',
		'before_widget'		=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'    => '</div>'
	);
	register_sidebar( $args );
}
add_action( 'widgets_init', 'custom_footer_widget_two');


/**
 * Footer Widget Three
*/
function custom_footer_widget_three() {
	$args = array(
		'id' 							=> 'footer-widget-col-three',
		'name'						=> __('Footer Column Three', 'text_domain'),
		'description'			=> __('Column One', 'text_domain'),
		'before_title'		=> '<h3 class="title">',
		'after_title' 		=> '</h3>',
		'before_widget'		=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'    => '</div>'
	);
	register_sidebar( $args );
}
add_action( 'widgets_init', 'custom_footer_widget_three');
