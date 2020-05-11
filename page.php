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
		while ( have_posts() ) :
			the_post();

			get_template_part( 'content-templates/content-'.get_post_type(), get_post_field( 'post_name', get_post() )
					 );

		endwhile; // End of the loop.
		?>
<?php
get_footer();
