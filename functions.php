<?php
/**
 * Medialog Turspor functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package medialog_turspor
 * @subpackage Medialog_Turspor
 * @since 1.0
 */

/**
 * Medialog Turspor only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function medialog_turspor_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/medialog_turspor
	 * If you're building a theme based on Medialog Turspor, use a find and replace
	 * to change 'medialog_turspor' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'medialog_turspor' );

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

	add_image_size( 'medialog_turspor-featured-image', 2000, 1200, true );

	add_image_size( 'medialog_turspor-large-image', 1200, 800, true );

	add_image_size( 'medialog_turspor-medium-image', 800, 500, true );

	add_image_size( 'medialog_turspor-preview-image', 200, 200, true );

	add_image_size( 'medialog_turspor-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'medialog_turspor' ),
		'social' => __( 'Social Links Menu', 'medialog_turspor' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );



	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', medialog_turspor_fonts_url() ) );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'medialog_turspor' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'medialog_turspor' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'medialog_turspor' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'medialog_turspor' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'medialog_turspor' ),
				'items' => array(
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Medialog Turspor array of starter content.
	 *
	 * @since Medialog Turspor 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'medialog_turspor_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'medialog_turspor_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function medialog_turspor_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( medialog_turspor_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Medialog Turspor content width of the theme.
	 *
	 * @since Medialog Turspor 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'medialog_turspor_content_width', $content_width );
}
add_action( 'template_redirect', 'medialog_turspor_content_width', 0 );

/**
 * Register custom fonts.
 */
function medialog_turspor_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'medialog_turspor' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Medialog Turspor 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function medialog_turspor_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'medialog_turspor-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'medialog_turspor_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function medialog_turspor_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'medialog_turspor' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'medialog_turspor' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'medialog_turspor' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'medialog_turspor' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'medialog_turspor' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'medialog_turspor' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'medialog_turspor_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Medialog Turspor 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function medialog_turspor_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'medialog_turspor' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'medialog_turspor_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Medialog Turspor 1.0
 */
function medialog_turspor_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'medialog_turspor_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function medialog_turspor_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'medialog_turspor_pingback_header' );

/**
 * Display custom color CSS.
 */
function medialog_turspor_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo medialog_turspor_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'medialog_turspor_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function medialog_turspor_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'medialog_turspor-fonts', medialog_turspor_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'medialog_turspor-style', get_stylesheet_uri() );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'medialog_turspor-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'medialog_turspor-style' ), '1.0' );
	}

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'medialog_turspor-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'medialog_turspor-style' ), '1.0' );
		wp_style_add_data( 'medialog_turspor-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'medialog_turspor-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'medialog_turspor-style' ), '1.0' );
	wp_style_add_data( 'medialog_turspor-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'medialog_turspor-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	$medialog_turspor_l10n = array(
		'quote'          => medialog_turspor_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'medialog_turspor-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
		$medialog_turspor_l10n['expand']         = __( 'Expand child menu', 'medialog_turspor' );
		$medialog_turspor_l10n['collapse']       = __( 'Collapse child menu', 'medialog_turspor' );
		$medialog_turspor_l10n['icon']           = medialog_turspor_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	}

	wp_enqueue_script( 'medialog_turspor-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'medialog_turspor-skip-link-focus-fix', 'medialog_tursporScreenReaderText', $medialog_turspor_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'medialog_turspor_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Medialog Turspor 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function medialog_turspor_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'medialog_turspor_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Medialog Turspor 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function medialog_turspor_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'medialog_turspor_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Medialog Turspor 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function medialog_turspor_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'medialog_turspor_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Medialog Turspor 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function medialog_turspor_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'medialog_turspor_front_page_template' );


/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );




// Function shortcode to get the wather.
function medialog_weather_shortcode($gpx_url) {
  $yr_url = '';
  $city = '';
  $gpx = simplexml_load_file($gpx_url);
	$lat = $gpx->trk->trkseg->trkpt[0]['lat'];
	$lon = $gpx->trk->trkseg->trkpt[0]['lon'];
	$fcast = simplexml_load_file('http://api.met.no/weatherapi/textlocation/1.0/?language=nb;latitude=' . $lat . ';longitude=' . $lon);
	$product = $fcast->time;

	$html = '<img src="../../wp-content/themes/medialog-turspor/assets/images/yr-logo.png"
                  alt="yrlogo" title="yrlogo" id="yrboks" width="30px" height="30px"><div id="weather_data" class="hidden">';

	foreach ( $product as $value ) {
	     $vaer = $value->location->forecast;
	     $klass = $value->location['name'];
	     $html = $html . '<div><h3>' . $klass .'</h3></div><div class="forecast">' . $vaer . '</div>';
	}


	$fcast = simplexml_load_file('https://api.met.no/weatherapi/locationforecastlts/1.3/?lat=' . $lat . ';lon=' . $lon);
	$product = $fcast->product;
	$i = 0;
	$clock  = date("H", time() + 10800);
	$today  = date("j F Y \k\l H\.", time() + 10800);
	$fdate  = date("Y-m-d\TH:00:00\Z", time() + 10800);

	foreach ( $product->time as $value ) {
	    if ( $value['from'] == $fdate ) {
	        $location   = $value->location;
	        isset($nedb) OR $nedb = $location->precipitation['value'];
	        isset($temp) OR $temp = $location->temperature['value'];
	        isset($windSpeed) OR $windSpeed = $location->windSpeed['name'];
	        isset($mps) OR $mps = $location->windSpeed['mps'];
	        isset($symbol) OR $symbol = $location->symbol['number'];
	        isset($imgclass) OR $imgclass = $location->symbol['id'];
	    	$i++;
	    	if($i==5) break;
	        }

	}

    $html = $html .
            '<h6>' . $today . '</h6><div class="forecast">
            <div><p class="heading">Tid</p><p>' . $clock .'</p></div>
            <div><p class="heading">Varsel</p>
                <img class="' . $imgclass . '" src="https://external.api.met.no/weatherapi/weathericon/1.1/?symbol='
                    . $symbol. '&content_type=image/png">
                <p class="yrlink"><a href="https://www.yr.no/kart/#lat=' . $lat . '&lon=' . $lon . '&zoom=8" target="_blank" title="Værmelding yr.no" alt="Værmelding yr.no" class="button">
                    Nedbørskart
                </a></p>
            </div>
            <div><p class="heading">Temp.</p><p>' . $temp .'°</p></div>
            <div><p class="heading">Nedbør</p><p>≈ ' . $nedb .' mm</p></div>
            <div><p class="heading">Vind</p><p>' . $windSpeed .', ' . $mps .'m/s </p></div>
            </div>';

	return $html . '</div>';
}
add_shortcode('medialog_weather', 'medialog_weather_shortcode');

// Function shortcode to get yr and storm links.
function medialog_weatherlinks_shortcode($gpx_url)) {
      $gpx = simplexml_load_file($gpx_url);
	    $lat = $gpx->trk->trkseg->trkpt[0]['lat'];
	    $lon = $gpx->trk->trkseg->trkpt[0]['lon'];

	$html = '<div class="yrboks">
      <a href="https://www.yr.no/kart/#lat='  . $lat . '&lon='  . $lon . '&zoom=8" target="_blank" title="Værmelding yr.no" alt="Værmelding yr.no">
         <img src="../wp-content/themes/medialog-turspor/assets/images/yr-logo.png" alt="yr.no" title="Værmelding yr.no" width="25px" height="25px"></a>
    </div>
	  <div class="stormboks">
      <a href="https://www.storm.no/stedssok/?lat='  . $lat . '&lng='  . $lon . '&zoom=0" target="_blank" title="Værmelding storm.no" alt="Værmelding storm.no">
         <img src="../wp-content/uploads/2017/10/storm_icon_25.png" alt="storm.no" title="Værmelding storm.no" height="25px">
      </a>
    </div>';

	return $html;
}
add_shortcode('medialog_weatherlinks', 'medialog_weatherlinks_shortcode');

// Function shortcode for link on googlemap.
function medialog_googlemap_shortcode($gpx_url) {
  $gpx = simplexml_load_file($gpx_url);
	$lat = $gpx->trk->trkseg->trkpt[0]['lat'];
	$lon = $gpx->trk->trkseg->trkpt[0]['lon'];
	return '<a href="https://www.google.no/maps/dir/' . $lat . ',' . $lon . '" target="_blank"><icon class="fa fa-map-marker"></icon> Finn via google-map</a>';
}
add_shortcode('medialog_googlemap', 'medialog_googlemap_shortcode');
