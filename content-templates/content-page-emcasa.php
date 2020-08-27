

<article id="interactive-content">
	<section>

		<div class="container">

			<div class="row">
				<div class="col-lg-6 col-md-8 col-10 mx-auto">

					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
						y="0px" viewBox="0 0 512 237" xml:space="preserve" class="typeonapath">
						<text text-anchor="middle">
							<textPath startOffset="50%" class="svgtext font-sharp25 fill-secondary" xlink:href="#typepath"><?php the_title() ?></textPath>
						</text>
					</svg>

				</div>
			</div>

			<div class="row">

				<?php
      $secao1 = get_field('secao_1');
      if( $secao1 ): ?>
				<div class="col-lg-4 col-md-6 marmitas--explicacao order-1">
					<h2 class="wavy-text display-4"><?php echo $secao1['titulo']; ?></h2>
					<div class="px-5">
						<?php echo $secao1['texto']; ?>
					</div>
				</div>
				<?php endif; ?>

				<?php
      $secao2 = get_field('secao_2');
      if( $secao2 ): ?>
				<div class="col-lg-4 col-md-6 marmitas--explicacao order-2">
					<h2 class="wavy-text display-4"><?php echo $secao2['titulo']; ?></h2>
					<div class="px-3">
						<?php echo $secao2['texto']; ?>
					</div>
				</div>
				<?php endif; ?>

				<div class="col-12  order-lg-4 order-3">
					<div class="marmitas--box">
						<h2 class="wavy-text d-md-none display-4">A entrega</h2>
						<div class="px-5 marmitas--explicacao">
							<p class="d-none d-md-block pb-4 pt-3">A entrega é feita duas vezes por semana,<br /> em horário
								comercial.</p>
							<p class="d-block d-md-none">Peça quantas marmitas quiser a qualquer hora. <strong>A ENTREGA É FEITA DUAS
									VEZES POR SEMANA, EM HORÁRIO COMERCIAL.</strong></p>
						</div>

						<?php get_template_part( 'components/entrega-row'); ?>

					</div>

				</div>

				<div class="col-lg-4 marmitas--explicacao order-lg-3 order-4">
					<h2 class="wavy-text d-md-none d-lg-block display-4">promoções!</h2>

					<div class="row justify-content-center">
						<div class="col-6 col-md-4 col-lg-6 promo mb-5 mt-3 mb-lg-0 mt-md-0">
							<strong class="text-primary">na compra de 7+ marmitas</strong>

							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 181"
								style="enable-background:new 0 0 512 181;" xml:space="preserve">
								<defs>
									<path id="pathpromo" d="M21.5,58.5C82.3,129.4,165,173,256,173s173.7-43.6,234.5-114.5" />
								</defs>
								<polygon class="fill-primary" points="255.9,66.9 238.5,79.6 245.2,59.1 227.8,46.4 249.3,46.5 256,26.1 262.6,46.5 284.2,46.6 266.7,59.2
               	273.4,79.6 " />

								<text text-anchor="middle">
									<textPath startOffset="50%" class="fill-secondary svgtext--lg" xlink:href="#pathpromo">entrega grátis!
									</textPath>
								</text>

							</svg>

						</div>
						<div class="col-6 col-md-4 col-lg-6 promo mb-5 mt-3 mb-lg-0 mt-md-0">


							<strong class="text-primary">na compra de 14 marmitas</strong>
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 181"
								style="enable-background:new 0 0 512 181;" xml:space="preserve">
								<defs>
									<path id="pathpromo" d="M21.5,58.5C82.3,129.4,165,173,256,173s173.7-43.6,234.5-114.5" />
								</defs>
								<polygon class="fill-primary" points="255.9,66.9 238.5,79.6 245.2,59.1 227.8,46.4 249.3,46.5 256,26.1 262.6,46.5 284.2,46.6 266.7,59.2
               	273.4,79.6 " />

								<text text-anchor="middle">
									<textPath startOffset="50%" class="fill-secondary svgtext--lg" xlink:href="#pathpromo">a 15ª é de
										brinde!</textPath>
								</text>

							</svg>
						</div>
					</div>
				</div>

				<!-- //row -->
			</div>

			<!-- //container -->
		</div>

	</section>

	<nav class="scrollmenu sticky-top top--navbar">
		<div class="container">
			<a href="#marmitas" class="scroll">Marmitas da semana</a>
			<?php $ss == 0; while ( have_rows('secoes') ) : the_row(); $ss++; ?>
			<a href="#sec-<?php echo $ss; ?>" class="scroll"><?php the_sub_field('titulo') ?></a>
			<?php endwhile;
      wp_reset_postdata(); ?>
		</div>
	</nav>

	<?php

    $posts = get_field('produtos');
    if( $posts ): ?>
	<section id="marmitas" class="pb-5 archive-marmita secao">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-10 mx-auto scrollpop fade poponce">
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
						y="0px" viewBox="0 0 512 237" xml:space="preserve" class="typeonapath">
						<text text-anchor="middle">
							<textPath startOffset="50%" class="svgtext font-sharp25 fill-primary" xlink:href="#typepath">Marmitas da semana</textPath>
						</text>
					</svg>
				</div>
			</div>
			<p class="marmitas--explicacao d-lg-none mb-5"><strong>TODA SEMANA UM CARDÁPIO NOVO!</strong><br />Sempre temos
				opções vegetarianas e veganas.</p>
			<div class="row">
				<div class="col-md-12 col-lg-4 mx-auto mb-4">
				</div>
			</div>
			<div class="row justify-content-center">
				<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				<div class="col-lg-4 col-md-6 col-12 mb-gutter">
					<?php setup_postdata($post);
            get_template_part( 'loop-templates/content-marmita', get_post_field( 'post_name', get_post() )); ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	<?php endif; ?>


	<?php
// check if the repeater field has rows of data
if( have_rows('secoes') ):
$ss = 0;
// loop through the rows of data
while ( have_rows('secoes') ) : the_row(); $ss++; ?>

	<section id="sec-<?php echo $ss; ?>" class="secao">
		<div class="container">
			<div class="secao__info mb-2">

				<div class="row">
					<div class="col-lg-4 col-md-6 col-10 mx-auto scrollpop fade poponce">
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
							y="0px" viewBox="0 0 512 237" xml:space="preserve" class="typeonapath">
							<text text-anchor="middle">
								<textPath startOffset="50%" class="svgtext font-sharp25 fill-primary" xlink:href="#typepath"><?php the_sub_field('titulo') ?></textPath>
							</text>
						</svg>
					</div>
				</div>

				<div class="marmitas--explicacao mb-5 mt-n5 scrollpop fade poponce ms-200"><?php the_sub_field('texto') ?></div>
			</div>

			<div class="row justify-content-center">
				<?php $posts = get_sub_field('produtos'); foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				<div class="col-lg-4 col-md-6 col-12 mb-gutter">
					<?php setup_postdata($post);
            get_template_part( 'loop-templates/content-marmita', get_post_field( 'post_name', get_post() )); ?>
				</div>
				<?php endforeach; wp_reset_postdata(); ?>
			</div>
		</div>
	</section>

	<?php endwhile;
wp_reset_postdata();
endif;

?>
</article>
<a class="ctl-cart slide-up poponce readypop scrollpop" href="<?php echo wc_get_cart_url(); ?>"
	title="<?php _e( 'Ver seu carrinho' ); ?>">
	<div class="ctl-cart__count">
		<?php echo sprintf ( _n( '%d item', '%d itens', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
	</div>
	<div class="ctl-cart__goto">ver carrinho</div>
	<div class="ctl-cart__total"><?php echo WC()->cart->get_cart_total(); ?></div>
</a>
