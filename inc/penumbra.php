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

function penumbra_share() {
	global $post;
	$content = '';
		// Get current page URL
		$socialURL = get_permalink();

		// Get current page title
		$socialTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
		// $socialTitle = str_replace( ' ', '%20', get_the_title());

		// Get Post Thumbnail for pinterest
		$socialThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

		// Construct sharing URL without using any script
		$twitterURL = 'https://twitter.com/intent/tweet?text='.$socialTitle.'&amp;url='.$socialURL.'&amp;via=social';
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$socialURL;
		$emailURL = 'https://www.facebook.com/sharer/sharer.php?u='.$socialURL;
		$googleURL = 'https://plus.google.com/share?url='.$socialURL;
		$bufferURL = 'https://bufferapp.com/add?url='.$socialURL.'&amp;text='.$socialTitle;
		$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$socialURL.'&amp;title='.$socialTitle;

		// Based on popular demand added Pinterest too
		$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$socialURL.'&amp;media='.$socialThumbnail[0].'&amp;description='.$socialTitle;

		// Add sharing button at the end of page/page content
		$content .= '<div class="social-social text-center text-lg-left mb-5" style="overflow: hidden">';
		$content .= '<dt>'.__('compartilhar','social').'</dt>';
    $content .= '<dd class="scrollpop slide-up-children poponce">';
		$content .= '<a data-sharing-image="'.get_the_post_thumbnail_url().'" data-sharing-url="'.$socialURL.'" class="social-link social-email" href="javascript:void(0)" target="_blank"><span class="mdi mdi-email-outline"></span></a>';
		$content .= '<a data-sharing-image="'.get_the_post_thumbnail_url().'" data-sharing-url="'.$socialURL.'" class="social-link social-linkedin" href="javascript:void(0)" target="_blank"><span class="mdi mdi-linkedin"></span></a>';
		$content .= '<a data-sharing-image="'.get_the_post_thumbnail_url().'" data-sharing-url="'.$socialURL.'" class="social-link social-facebook" href="javascript:void(0)" target="_blank"><span class="mdi mdi-facebook"></span></a>';
		// $content .= '<a class="social-link social-googleplus" href="'.$googleURL.'" target="_blank">Google+</a>';
		// $content .= '<a class="social-link social-buffer" href="'.$bufferURL.'" target="_blank">Buffer</a>';
		// $content .= '<a class="social-link social-pinterest" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank">Pinterest</a>';
		$content .= '<a data-sharing-image="'.get_the_post_thumbnail_url().'" data-sharing-url="'.$socialURL.'" class="social-link social-twitter" href="javascript:void(0)" target="_blank"><span class="mdi mdi-twitter"></span></a>';
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
    <meta name="description" content="<?php echo $blogdesc ?>">
    <meta name="og:description" content="<?php echo $blogdesc ?>">
    <meta name="twitter:description" content="<?php echo $blogdesc ?>">
    <meta name="keywords" content="">
    <meta name="robots" content=""><meta name="revisit-after" content="7 day">

    <meta property="og:title" content="<?php echo $blogtitle ?>" />
    <meta property="og:url" content="<?php the_permalink();?>" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="" />

    <meta property="twitter:title" content="<?php echo $blogtitle ?>" />
    <meta property="twitter:url" content="<?php the_permalink();?>" />
    <meta property="twitter:card" content="summary" />
    <meta property="twitter:image" content="" />

    <?php
}
add_action('wp_head', 'penumbra_opengraph');


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
