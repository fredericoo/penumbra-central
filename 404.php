<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package estudio-triciclo
 */

get_header();
?>

		<?php


      the_post(get_option('page_on_front'));

			get_template_part( 'content-templates/content-'.get_post_type(), get_post_field( 'post_name', get_post() )
					 );
		?>
<?php
get_footer();
