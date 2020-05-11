<div class="produto scrollpop slide-up">
	<a href="<?php the_permalink() ?>"><?php smart_image(get_post_thumbnail_id() ?: get_option( 'woocommerce_placeholder_image', 0 ),'large','produto__imagem nobg pb-50pc','fade'); ?></a>
	<a href="<?php the_permalink() ?>"><h3 class="produto__titulo"><?php the_title() ?></h3></a>
	<?php $price = get_post_meta( get_the_ID(), '_price', true ); ?>
	<div class="produto__preco"><?php echo wc_price( $price ); ?></div>
	<p><?php the_excerpt() ?></p>
	<a class="btn btn-outline-primary link produto__link" href="<?php the_permalink() ?>">me dê detalhes</a>
</div>
