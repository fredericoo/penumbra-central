<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.1
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>

<div class="woocommerce-form-coupon-toggle">
<?php wc_print_notice( apply_filters( 'woocommerce_checkout_coupon_message', __( 'Tem um cupom promocional?', 'understrap' ) . ' <a href="#" class="showcoupon">' . __( 'Clique aqui p’ra ser feliz', 'understrap' ) . '</a>' ), 'notice' ); ?></div>

<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">

	<p><?php esc_html_e( 'Se você possui um cupom, insira-o abaixo:', 'understrap' ); ?></p>

	<p class="form-row form-row-first">
		<input type="text" name="coupon_code" class="form-control" placeholder="<?php esc_attr_e( 'Código promocional', 'understrap' ); ?>" id="coupon_code" value="" />
	</p>

	<p class="form-row form-row-last">
		<button type="submit" class="btn btn-outline-primary link" name="apply_coupon" value="<?php esc_attr_e( 'Aplicar cupom', 'understrap' ); ?>"><?php esc_html_e( 'Aplicar cupom', 'understrap' ); ?></button>
	</p>

	<div class="clear"></div>
</form>
