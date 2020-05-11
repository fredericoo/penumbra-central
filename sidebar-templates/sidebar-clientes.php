<?php
/**
 * Sidebar setup for footer full.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

?>

<?php if ( is_active_sidebar( 'clientes' ) ) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<div class="wrapper logos bg-light" id="wrapper-clientes">

		<div class="<?php echo esc_attr( $container ); ?>" id="footer-full-content" tabindex="-1">
			<h6 class="text-center text-md-left"><?php echo __('Clientes','penumbra') ?></h6>

			<div class="row justify-content-center">

				<?php dynamic_sidebar( 'clientes' ); ?>

			</div>

		</div>

	</div><!-- #wrapper-footer-full -->

<?php endif;
