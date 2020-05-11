<?php
defined( 'ABSPATH' ) || exit;

function smart_image($attachment_id, $size, $additional = '', $imgclasses = 'fade') {

	if (!$attachment_id) return;

	$attachment = get_post( $attachment_id );
	$alt = '';
	if ($alt = $attachment->post_content);
	if ($alt = $attachment->post_excerpt);
	if ($alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ));
	if ($alt = $attachment->post_title);

	$image_attributes = wp_get_attachment_image_src( $attachment_id, $size );
	$output = '';
	$nobg = (get_field('nobg', $attachment_id) == 1 ? ' nobg ': '');
	// 	opening a lazyloading container with the proportions of the original attachment
	$output .= '<div class="lazy-container '.$additional.$nobg.'" style="--image-w:'.($image_attributes[1] ?: '100px').'; --image-h:'.($image_attributes[2] ?: '100px').'; --image-bg:'.get_color_data($attachment_id, 'dominant_color_hex').'" >';

	$output .= '<img class="lazyload '.$imgclasses.'"';
	// 	lazyloading src
	$output .= 'src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="';
	$output .= 'data-src="'.$image_attributes[0].'"';
	$output .= ' alt="'.$alt.'"';
	$output .= ' ></div>';

	echo $output;
}

add_filter( 'wp_get_attachment_image_src', 'fix_wp_get_attachment_image_svg', 10, 4 );  /* the hook */

 function fix_wp_get_attachment_image_svg($image, $attachment_id, $size, $icon) {
    if (is_array($image) && preg_match('/\.svg$/i', $image[0]) && $image[1] <= 1) {
        if(is_array($size)) {
            $image[1] = $size[0];
            $image[2] = $size[1];
        } elseif(($xml = simplexml_load_file($image[0])) !== false) {
            $attr = $xml->attributes();
            $viewbox = explode(' ', $attr->viewBox);
            $image[1] = isset($attr->width) && preg_match('/\d+/', $attr->width, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[2] : null);
            $image[2] = isset($attr->height) && preg_match('/\d+/', $attr->height, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[3] : null);
        } else {
            $image[1] = $image[2] = null;
        }
    }
    return $image;
}
