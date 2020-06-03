<div data-toggle="modal" data-target="#modal" data-modal-id="<?php echo get_the_ID(); ?>" class="grid-item produto produto--marmita scrollpop fade poponce p-relative
<?php $terms = get_the_terms( get_the_ID(), 'product_cat' );

if ( $terms && ! is_wp_error( $terms ) ) :

	$cats = [];
	?> <?php
	foreach ( $terms as $term ) {
		echo ' cat-'.esc_html($term->term_id);
	}
endif;
?>
	">
	<?php foreach ($terms as $cat) {
		$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		smart_image($thumbnail_id,'large','nobg cat-icon','fade poponce');
	} ?>
	<div class="row">
		<div class="<?php echo (get_post_thumbnail_id() ? 'col-8 col-md-7 col-lg-6' : 'col-12') ?> px-0">
			<div class="p-3">
				<a data-toggle="modal" data-target="#modal" data-modal-id="<?php echo get_the_ID(); ?>" href="<?php the_permalink() ?>"><h3 class="produto__titulo"><?php the_title() ?></h3></a>
				<?php $price = get_post_meta( get_the_ID(), '_price', true ); ?>
				<div class="produto__desc"><?php the_excerpt() ?></div>
				<div class="produto__preco"><?php echo wc_price( $price ); ?></div>
			</div>
		</div>
		<?php if (get_post_thumbnail_id()): ?>
			<div class="col-4 col-md-5 col-lg-6 px-0">
				<div class="p-3">
					<a data-toggle="modal" data-target="#modal" data-modal-id="<?php echo get_the_ID(); ?>" href="<?php the_permalink() ?>"><?php smart_image(get_post_thumbnail_id() ?: get_option( 'woocommerce_placeholder_image', 0 ),'thumbnail','produto__imagem nobg pb-50pc','fade poponce'); ?></a>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<a data-toggle="modal" data-target="#modal" data-modal-id="<?php echo get_the_ID(); ?>"  class="btn produto__link btn-block" href="<?php the_permalink() ?>">Adicionar</a>
</div>
