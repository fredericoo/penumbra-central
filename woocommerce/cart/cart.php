<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.1
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>


	<ul class="ctl-cart__contents cart woocommerce-cart-form__contents" cellspacing="0">
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
		<li
			class="ctl-cart__item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

			<div class="product-remove">
				<?php
								// @codingStandardsIgnoreLine
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									__( 'Remove this item', 'understrap' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
							?>
			</div>

			<div class="product-name" data-title="<?php esc_attr_e( 'Produto', 'understrap' ); ?>">
				<?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}

						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'understrap' ) . '</p>', $product_id ) );
						}
						?>
			</div>

			<div class="product-price" data-title="<?php esc_attr_e( 'Preço', 'understrap' ); ?>">
				<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
			</div>

			<div class="product-quantity" data-title="<?php esc_attr_e( 'Quantidade', 'understrap' ); ?>">
				<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							?>
				<button type="button" class="plus">+</button>
				<button type="button" class="minus">-</button>
				<?php
							$product_quantity = woocommerce_quantity_input( array(
								'input_name'   => "cart[{$cart_item_key}][qty]",
								'input_value'  => sprintf('%04d', $cart_item['quantity']),
								'max_value'    => $_product->get_max_purchase_quantity(),
								'min_value'    => '0',
								'product_name' => $_product->get_name(),
							), $_product, false );
						}

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						?>
			</div>

			<div class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'understrap' ); ?>">
				<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
			</div>
		</li>
		<?php
				}
			}
			?>

		<?php do_action( 'woocommerce_cart_contents' ); ?>



		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</ul>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>

	<div class="ctl-cart__actions">

		<?php if ( wc_coupons_enabled() ) { ?>
		<div class="coupon form-row">
			<div class="form-group">
				<label for="coupon_code"><?php esc_html_e( 'Cupom:', 'understrap' ); ?></label> <input type="text"
					name="coupon_code" class="input-text form-control d-inline-block" id="coupon_code" value=""
					placeholder="<?php esc_attr_e( 'Cupom', 'understrap' ); ?>" /> 
					<?php do_action( 'woocommerce_cart_coupon' ); ?>
				</div>
				<div class="form-group align-self-center">
					<button type="submit"
					class="btn btn-outline-primary" name="apply_coupon"
					value="<?php esc_attr_e( 'Aplicar cupom', 'understrap' ); ?>"><?php esc_attr_e( 'Aplicar', 'understrap' ); ?></button>
				</div>
		</div>
		<?php } ?>

		<button type="submit" class="btn btn-outline-primary mb-4" name="update_cart"
			value="<?php esc_attr_e( 'Atualizar preços', 'understrap' ); ?>"><?php esc_html_e( 'Atualizar preços', 'understrap' ); ?></button>
	</div>

			<?php do_action( 'woocommerce_cart_actions' ); ?>

			<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

</form>

<?php if ( $upsell = get_page_by_path( 'upsell', OBJECT, 'page' ) ) { ?>

<?php
		 				global $post;        
						 $posts = get_field('produtos',$upsell->ID);
						 foreach(WC()->cart->get_cart() as $key => $val ) {
							 $_product = $val['data'];
							 foreach ($posts as $pkey => $post) {
								 if ($post->ID == $_product->id) {
									 unset($posts[$pkey]);
								 }
								}
								
							}        
							
							if( $posts ): ?>

<div class="cart-upsell">
	<div class="cart-upsell__inner">
		<h4><?php echo get_the_title($upsell->ID) ?></h4>
		<div class="carousel"
			data-flickity='{ "cellAlign": "left", "pageDots": false, "wrapAround": <?php echo (sizeof($posts) > 3 ? 'true' : 'false'); ?>, "prevNextButtons" : true, "contain" : true, "draggable": true, "groupCells" : "100%", "freeScroll": true, "accessibility": false, "arrowShape": "M2.4,38.2v8.8l22.1,3.2v3.5c0,18.3,9.7,23.8,22.1,23.8c14.7,0,8.5-9.4,20.9-9.4h7.7V58V42.7v-4.4H59.2c-4.7-5.6-8.8-15.3-8.8-15.3c0-0.3-0.6-0.6-0.9-0.6c-3.8,0.6-6.8,3.2-6.8,9.4c0,2.1,1.2,4.7,2.6,6.5H2.1H2.4z" }'>
			<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
			<div class="col-md-5 col-10 my-3">
				<?php setup_postdata($post);
		 	          get_template_part( 'loop-templates/content-marmita', get_post_field( 'post_name', get_post() )); ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php wp_reset_postdata(); endif;

		 				wp_reset_postdata();
		 			} ?>


<div class="cart-collaterals">

	<div class="flair">
		<h4>Pedido nº</h4>
		<h3><?php echo sprintf('%04d', get_last_order_id()); ?></h3>
	</div>
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' );
