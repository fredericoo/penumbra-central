<div class="produto produto--marmita">
	<div class="produto-grid">

		<div class="p-3 p-lg-4 produto-grid__imagem">
				<?php smart_image(get_post_thumbnail_id() ?: get_option( 'woocommerce_placeholder_image', 0 ),'large','produto__imagem nobg pb-50pc','fade poponce'); ?>
		</div>

			<div class="p-3 p-lg-4 d-flex flex-column h-100">
			<h3 class="produto-grid__titulo produto__titulo"><?php $terms = get_the_terms( get_the_ID(), 'product_cat' ); foreach ($terms as $cat) {
				$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
				//smart_image($thumbnail_id,'large','nobg cat-icon','fade poponce');
			} ?><?php the_title() ?></h3>
				<?php $price = get_post_meta( get_the_ID(), '_price', true ); ?>
				<div class="produto-grid__desc produto__desc"><?php the_excerpt() ?></div>

					<div class="produto__preco produto-grid__preco"><?php woocommerce_template_single_price() ?></div>
					<div class="produto__addtocart produto-grid__addtocart">
						<?php woocommerce_template_single_add_to_cart() ?>
					</div>

		</div>

	</div>

</div>
