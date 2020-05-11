<?php
add_action("wp_ajax_carregar_post", "penumbra_carregar_post");
add_action("wp_ajax_nopriv_carregar_post", "penumbra_carregar_post");

function penumbra_carregar_post() {

	$result['bodyclass'] = '';
	global $sitepress;
	global $post;
	global $author;

	$post = get_post( $_REQUEST["post_id"] , OBJECT );
	setup_postdata( $post );
	$result['bodyclass'] = 'type-'.get_post_type();
	ob_start();
	$author = $_REQUEST["post_id"];

	get_template_part( 'content-templates/content-'.get_post_type(),
	get_post_field( 'post_name', get_post() )
);
$result['tabtitle'] = strip_tags(get_the_title($_REQUEST["post_id"])).' – '.get_bloginfo( 'name' );

$result['html'] = ob_get_clean();
ob_end_clean();
wp_reset_postdata();

$result['type'] = "success";
$result['url'] = get_permalink($_REQUEST["post_id"]);

//    $result['vote_count'] = "top";

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$result = json_encode($result);
	echo $result;
}
else {
	header("Location: ".$_SERVER["HTTP_REFERER"]);
}

die();

}
