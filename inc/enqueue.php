<?php
/**
 * Understrap enqueue scripts
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'understrap_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function understrap_scripts() {

		$penumbra_options = ['flickity'	=> true,
												 'isotope'	=> false,
												 'ajax'			=> true,
											 	];

		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.css' );

		if ($penumbra_options['flickity']) wp_enqueue_style( 'flickity', get_template_directory_uri() . '/css/flickity.css', array(), $css_version );

		wp_enqueue_style( 'understrap-styles', get_template_directory_uri() . '/css/theme.css', array(), $css_version );
		wp_enqueue_style( 'font-sharp',  get_template_directory_uri() . '/fonts/sharp/sharp-medium-min.css', array(), $css_version );
		wp_enqueue_style( 'font-caaires',  get_template_directory_uri() . '/fonts/caaires/caaires-min.css', array(), $css_version );
		//wp_enqueue_style( 'material-design', get_template_directory_uri() . '/fonts/materialdesignicons.css', array(), $css_version );

		wp_enqueue_script( 'jquery' );

		$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/penumbra.js' );
		wp_enqueue_script( 'understrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true );
		wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), $js_version, true );
		wp_enqueue_script( 'scrollpop', get_template_directory_uri() . '/js/scrollpop-min.js', array(), $js_version, true );
		// wp_enqueue_script( 'charming', get_template_directory_uri() . '/js/charming-min.js', array(), $js_version, true );

		if ($penumbra_options['flickity']) wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/flickity-min.js', array(), $js_version, true );
		if ($penumbra_options['isotope']) wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope-min.js', array(), $js_version, true );
		if ($penumbra_options['isotope']) wp_enqueue_script( 'isotope-packery', get_template_directory_uri() . '/js/isotope-packery.js', array(), $js_version, true );
		if ($penumbra_options['ajax']) {
			wp_enqueue_script( 'ajax', get_template_directory_uri() . '/js/ajax.js', array(), $js_version, true );
			wp_localize_script( 'ajax', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),'homeid' => get_option('page_on_front') ));
		}
		wp_enqueue_script( 'lazy', get_template_directory_uri() . '/js/lazy.js', array(), $js_version, true );
		wp_enqueue_script( 'pnmbr', get_template_directory_uri() . '/js/penumbra.js', array(), $js_version, true );

		// wp_enqueue_style( 'share-buttons', get_template_directory_uri() . '/css/share-buttons.css', array(), $css_version );
		// wp_enqueue_script( 'share-buttons', get_template_directory_uri() . '/js/share-buttons.js', array(), $js_version, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // endif function_exists( 'understrap_scripts' ).

add_action( 'wp_enqueue_scripts', 'understrap_scripts' );
