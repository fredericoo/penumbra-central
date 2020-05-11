<?php
/**
 * Pagination layout.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'understrap_pagination' ) ) {

	function understrap_pagination( $args = array(), $class = 'pagination' ) {

		if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
			return;
		}

		$args = wp_parse_args(
			$args,
			array(
				'mid_size'           => 2,
				'prev_next'          => true,
				'prev_text'          => __( '&laquo;', 'understrap' ),
				'next_text'          => __( '&raquo;', 'understrap' ),
				'screen_reader_text' => __( 'Posts navigation', 'understrap' ),
				'type'               => 'array',
				'current'            => max( 1, get_query_var( 'paged' ) ),
			)
		);

		$links = paginate_links( $args );

		?>

		<nav aria-label="<?php echo $args['screen_reader_text']; ?>">

			<ul class="pagination mx-auto">

				<?php
				foreach ( $links as $key => $link ) {
					?>
					<li class="page-item <?php echo strpos( $link, 'current' ) ? 'active' : ''; ?>">
						<?php echo str_replace( 'page-numbers', 'page-link', $link ); ?>
					</li>
					<?php
				}
				?>

			</ul>

		</nav>

		<?php
	}
}


function bootstrap_pagination( $echo = true ) {
	global $wp_query;

	$big = 999999999; // need an unlikely integer

	$pages = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'type'  => 'array',
			'prev_next'   => true,
			'prev_text'    => __('«','Penumbra'),
			'next_text'    => __('»','Penumbra'),
		)
	);

	if (is_array($pages)) {
			$paged = ($paged == 0) ? 1 : $paged;
			$pagination = '<ul class="pagination justify-content-center">';
			foreach ($pages as $page) {
				//$page = strip_tags($page);
				$pagination .= '<li class="page-item">' . str_replace('page-numbers', 'page-link', $page) . '</li>';
			}
			$pagination .= '</ul>';
			if ($echo) {
				echo $pagination;
			} else {
				return $pagination;
			}
		}
}
