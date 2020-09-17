<?php
function disable_upload_sizes( $sizes, $metadata ) {

    // Get filetype data.
    $filetype = wp_check_filetype($metadata['file']);

    // Check if is gif.
    if($filetype['type'] == 'image/gif') {
        // Unset sizes if file is gif.
        $sizes = array();
    }

    // Return sizes you want to create from image (None if image is gif.)
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'disable_upload_sizes', 10, 2);

function read_time() {
    $content = get_post_field( 'post_content', $post->ID );
    $word_count = str_word_count( strip_tags( $content ) );
    $time = ($word_count/275);

	preg_match_all( '/(http:|https:)?\/\/([\w_-]+(?:(?:\.[\w_-]+)+))([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])?/', $content, $matches );

	$count = 0;
	if ( ! empty( $matches ) && ! empty( $matches[ 0 ] ) ) {
	    foreach ( $matches[ 0 ] as $url ) {
	        $split    = explode( '#', $url );
	        $split    = explode( '?', $split[ 0 ] );
	        $split    = explode( '&', $split[ 0 ] );
	        $filename = basename( $split[ 0 ] );
	        $file_type = wp_check_filetype( $filename, wp_get_mime_types() );
	        if ( ! empty ( $file_type[ 'ext' ] ) ) {

	            // (optional) limit inclusion based on file type
	            if( ! in_array( $file_type[ 'ext' ], array('jpg', 'png')) ) continue;

	            $files[ $url ] = $file_type;
	            $urls[]=$url;
	            $count ++;
	        }
	    }
	}

	$time += $count*0.2;

	return ceil($time).' min';

}

function penumbra_share($socialURL) {
	global $post;
	wp_enqueue_script( 'share-buttons', get_template_directory_uri() . '/js/share-buttons-min.js', array(), $js_version, true );

	$content = '';
		// Get current page URL
		if (!$socialURL) $socialURL = get_permalink();

		// Add sharing button at the end of page/page content
		$content .= '<div class="social-social" style="overflow: hidden">';
		$content .= '<dt>'.__('compartilhar','social').'</dt>';
  		$content .= '<dd class="scrollpop slide-up-children poponce">';
		$content .= '<a data-sharing-image="'.get_the_post_thumbnail_url().'" data-sharing-url="'.$socialURL.'" class="social-link social-email" href="javascript:void(0)" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="arcs"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg></a>';
		// $content .= '<a data-sharing-image="'.get_the_post_thumbnail_url().'" data-sharing-url="'.$socialURL.'" class="social-link social-linkedin" href="javascript:void(0)" target="_blank"><span class="mdi mdi-linkedin"></span></a>';
		$content .= '<a data-sharing-image="'.get_the_post_thumbnail_url().'" data-sharing-url="'.$socialURL.'" class="social-link social-facebook" href="javascript:void(0)" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.07C24 5.41 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.04V9.41c0-3.02 1.8-4.7 4.54-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.5c-1.5 0-1.96.93-1.96 1.89v2.26h3.32l-.53 3.5h-2.8V24C19.62 23.1 24 18.1 24 12.07"/></svg></a>';
		// $content .= '<a class="social-link social-googleplus" href="'.$googleURL.'" target="_blank">Google+</a>';
		// $content .= '<a class="social-link social-buffer" href="'.$bufferURL.'" target="_blank">Buffer</a>';
		// $content .= '<a class="social-link social-pinterest" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank">Pinterest</a>';
		$content .= '<a data-sharing-image="'.get_the_post_thumbnail_url().'" data-sharing-url="'.$socialURL.'" class="social-link social-twitter" href="javascript:void(0)" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M24 4.37a9.6 9.6 0 0 1-2.83.8 5.04 5.04 0 0 0 2.17-2.8c-.95.58-2 1-3.13 1.22A4.86 4.86 0 0 0 16.61 2a4.99 4.99 0 0 0-4.79 6.2A13.87 13.87 0 0 1 1.67 2.92 5.12 5.12 0 0 0 3.2 9.67a4.82 4.82 0 0 1-2.23-.64v.07c0 2.44 1.7 4.48 3.95 4.95a4.84 4.84 0 0 1-2.22.08c.63 2.01 2.45 3.47 4.6 3.51A9.72 9.72 0 0 1 0 19.74 13.68 13.68 0 0 0 7.55 22c9.06 0 14-7.7 14-14.37v-.65c.96-.71 1.79-1.6 2.45-2.61z"/></a>';
		$content .= '</dd></div>';

		echo $content;
};

function penumbra_register_widget() {
	register_widget( 'smart_image' );
}
add_action( 'widgets_init', 'penumbra_register_widget' );

class smart_image extends WP_Widget {

	function __construct() {
	parent::__construct(
	// widget ID
	'smart_image',
	// widget name
	__('Penumbra Share Bar', 'penumbra'),
	// widget description
	array ( 'description' => __( 'Barra de compartilhamentos', 'penumbra' ), )
	);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		// echo $args['before widget'];
		//if title is present
		// If ( ! empty ( $title ) )
		// echo $args['before_title'] . $title . $args['after_title'];
		//output
		penumbra_share();
		// echo $args[‘after_widget’];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
			$title = $instance[ 'title' ];
		else
			$title = __( 'Default Title', 'hstngr_widget_domain' );
		?>
		<p>
		<!-- <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> -->
		<!-- <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /> -->


		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
		}

}

function penumbra_opengraph() {

    if (is_single() || is_page()) {
      $blogdesc = get_the_excerpt();
      $blogtitle = get_the_title();
    } else {
      $blogdesc = get_bloginfo('description');
      $blogtitle = get_bloginfo('name');
    }
    ?>
	<?php 
	if ($_GET['ref'] && !is_user_logged_in() ) {
		$blogtitle = 'Clique aqui para ganhar Cupons Mágicos d’A Central!';
		$blogdesc = 'Troque cupons mágicos por descontos na compra das Marmitas mais saborosas da cidade. É almoço, é jantar, é sobremesa!';
	} ?>
    <meta name="title" content="<?= $blogtitle ?>" />
    <meta name="description" content="<?php echo $blogdesc ?>">
    <meta name="og:description" content="<?php echo $blogdesc ?>">
    <meta name="twitter:description" content="<?php echo $blogdesc ?>">
    <meta name="keywords" content="">
    <meta name="robots" content=""><meta name="revisit-after" content="7 day">

    <meta property="og:title" content="<?= $blogtitle ?>" />
    <meta property="og:url" content="<?php the_permalink();?>" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="" />

    <meta property="twitter:title" content="<?= $blogtitle ?>" />
    <meta property="twitter:url" content="<?php the_permalink();?>" />
    <meta property="twitter:card" content="summary" />
    <meta property="twitter:image" content="" />

    <?php
}
add_action('wp_head', 'penumbra_opengraph', 10);


add_action("wp_ajax_get_cart_number", "penumbra_cart_number");
add_action("wp_ajax_nopriv_get_cart_number", "penumbra_cart_number");

function penumbra_cart_number() {

$result['html'] = WC()->cart->get_cart_contents_count();
$result['qty'] = WC()->cart->get_cart_contents_count();
$result['total'] = WC()->cart->get_cart_contents_total();

$result['type'] = "success";
$result['url'] = get_permalink($_REQUEST["post_id"]);

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$result = json_encode($result);
	echo $result;
}
else {
	header("Location: ".$_SERVER["HTTP_REFERER"]);
}

die();

}

function wpb_woo_my_account_order() {
	$myorder = array(
		'dashboard'          => __( 'Indique & ganhe', 'woocommerce' ),
		'cupons_magicos' => __( 'Cupons Mágicos', 'woocommerce' ),
		'orders'             => __( 'Orders', 'woocommerce' ),
		'edit-address'       => __( 'Addresses', 'woocommerce' ),
		'payment-methods'    => __( 'Payment', 'woocommerce' ),
		'edit-account'       => __( 'Meus dados', 'woocommerce' ),
		'customer-logout'    => __( 'Logout', 'woocommerce' ),
	);

	return $myorder;
}
add_filter ( 'woocommerce_account_menu_items', 'wpb_woo_my_account_order' );