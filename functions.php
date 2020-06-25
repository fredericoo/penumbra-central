<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
	'/wp-admin.php',                        // /wp-admin/ related functions
	'/deprecated.php',                      // Load deprecated functions.
	'/smart-image.php',                      // Load deprecated functions.
	'/penumbra.php',                      // Load deprecated functions.
	'/ajax-loading.php',                      // Load deprecated functions.
	'/ajax-variations.php',                      // Load deprecated functions.
	// '/vuupt.php',                      // Load deprecated functions.
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

/**
 * Registers an editor stylesheet for the theme.
 */
function wpdocs_theme_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );

function get_first_paragraph(){
    global $post;
    $str = wpautop( strip_tags(strip_shortcodes(get_the_content())) );
    $str = substr( $str, 0, strpos( $str, '</p>' ) + 4 );
    $str = strip_tags($str, '<a><strong><em>');
    return $str;
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');


add_action('template_redirect', 'remove_shop_breadcrumbs' );
function remove_shop_breadcrumbs(){

        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

}

function pnmbr_display_cart() {

}

function get_last_order_id(){
    global $wpdb;
    $statuses = array_keys(wc_get_order_statuses());
    $statuses = implode( "','", $statuses );

    // Getting last Order ID (max value)
    $results = $wpdb->get_col( "
        SELECT MAX(ID) FROM {$wpdb->prefix}posts
        WHERE post_type LIKE 'shop_order'
        AND post_status IN ('$statuses')
    " );
    return reset($results) ?: '0001';
}


add_action('post_updated', 'pnmbr_revisar_estoque_marmitas');
function pnmbr_revisar_estoque_marmitas($post_id) {
	if ($post_id == 17) {

		$marmitas = get_posts( array(
				'posts_per_page'=> -1,
				'post_type'   => array('product','product_variation'),
				'post_status'  => 'publish',
				'tax_query' => array(
							'relation' => 'AND',
							array(
									'taxonomy' => 'product_cat',
									'field' => 'slug',
									// 'terms' => 'white-wines'
									'terms' => 'marmita'
							)
					),
		) );
		$oos = 'outofstock';
		$is = 'instock';

		foreach ( $marmitas as $marmita ) {
				update_post_meta( $marmita->ID, '_stock_status', wc_clean( $oos ) );
		}

		$marmitas = get_field('produtos', 17);
    foreach( $marmitas as $marmita) {
			update_post_meta( $marmita->ID, '_stock_status', wc_clean( $is ) );
		}
	}
}

add_action('woocommerce_checkout_before_terms_and_conditions', 'checkout_additional_checkboxes');
function checkout_additional_checkboxes( ){
    $checkbox1_text = __( "Estou ciente de que não estou louca e o endereço de entrega está correto", "woocommerce" );
    ?>
    <p class="form-row custom-checkboxes">
        <label class="woocommerce-form__label checkbox custom-one">
            <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="custom_one" > <span><?php echo  $checkbox1_text; ?></span> <span class="required">*</span>
        </label>
    </p>
    <?php
}

add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

function my_custom_checkout_field_process() {
    // Check if set, if its not set add an error.
    if ( ! $_POST['custom_one'] )
        wc_add_notice( __( 'Confira seu endereço e marque a checkbox, sua louca!' ), 'error' );
}


add_filter( 'woocommerce_account_menu_items', 'pnmbr_remove_my_account_dashboard' );
function pnmbr_remove_my_account_dashboard( $menu_links ){

	//unset( $menu_links['dashboard'] );
	unset( $menu_links['downloads'] );
	return $menu_links;

}



add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	<a class="ctl-cart slide-up poponce readypop scrollpop pop" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'Ver seu carrinho' ); ?>">
		<div class="ctl-cart__count"><?php echo sprintf ( _n( '%d item', '%d itens', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></div>
		<div class="ctl-cart__goto">ver carrinho</div>
		<div class="ctl-cart__total"><?php echo WC()->cart->get_cart_total(); ?></div>
	</a>
<?php
$fragments['a.ctl-cart'] = ob_get_clean();
return $fragments;
}