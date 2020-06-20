<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;


do_action( 'woocommerce_before_add_to_cart_quantity' ); ?>
<div class="ch-qty">
	<button type="button" class="plus" >+</button>
	<button type="button" class="minus" >-</button>
<?php
woocommerce_quantity_input( array(
	'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
	'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
	'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
) );
?>
</div>
<?
do_action( 'woocommerce_after_add_to_cart_quantity' );


<button 
type="submit" 
name="add-to-cart" 
value="<?php echo esc_attr( $product->get_id() ); ?>" 
class="btn btn-outline-secondary">
<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
</button>
