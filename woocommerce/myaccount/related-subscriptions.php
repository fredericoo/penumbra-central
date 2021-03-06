<?php
/**
 * Related Subscriptions section beneath order details table
 *
 * @author   Prospress
 * @category WooCommerce Subscriptions/Templates
 * @version  2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php if ( $upsell = get_page_by_path( 'assinatura', OBJECT, 'page' ) ) { ?>

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
							
							if( $posts ):
								WC()->cart->empty_cart(); ?>
								
<header>
	<h3 class="text-tertiary border-tertiary"><?php echo get_the_title($upsell->ID) ?></h3>
	<p><?= apply_filters('the_content', get_post_field('post_content', $upsell->ID)); ?></p>
</header>

<a class="ctl-subscriptionCart cart slide-up poponce readypop scrollpop" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'Ver seu carrinho' ); ?>">
  <div class="ctl-subscriptionCart__count"><?php echo sprintf ( _n( '%d item', '%d itens', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></div>
  <div class="ctl-subscriptionCart__goto">esvaziar carrinho</div>
  <div class="ctl-subscriptionCart__total"><?php echo WC()->cart->get_cart_total(); ?></div>
</a>
<div class="cart-pickmenu row">
<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
			<div class="col-md-4 col-sm-6 col-12 my-3">
				<?php setup_postdata($post);
		 	          get_template_part( 'loop-templates/content-marmita', get_post_field( 'post_name', get_post() )); ?>
			</div>
			<?php endforeach; ?>
</div>
</div>
<?php wp_reset_postdata(); endif;

		 				wp_reset_postdata();
					 } ?>
					 
<header>
	<h2><?php esc_html_e( 'Assinaturas relacionadas', 'woocommerce-subscriptions' ); ?></h2>
</header>

<table class="shop_table shop_table_responsive my_account_orders woocommerce-orders-table woocommerce-MyAccount-subscriptions woocommerce-orders-table--subscriptions">
	<thead>
		<tr>
			<th class="subscription-id order-number woocommerce-orders-table__header woocommerce-orders-table__header-order-number woocommerce-orders-table__header-subscription-id"><span class="nobr"><?php esc_html_e( 'Subscription', 'woocommerce-subscriptions' ); ?></span></th>
			<th class="subscription-status order-status woocommerce-orders-table__header woocommerce-orders-table__header-order-status woocommerce-orders-table__header-subscription-status"><span class="nobr"><?php esc_html_e( 'Status', 'woocommerce-subscriptions' ); ?></span></th>
			<th class="subscription-next-payment order-date woocommerce-orders-table__header woocommerce-orders-table__header-order-date woocommerce-orders-table__header-subscription-next-payment"><span class="nobr"><?php echo esc_html_x( 'Próximo pagamento', 'table heading', 'woocommerce-subscriptions' ); ?></span></th>
			<th class="subscription-total order-total woocommerce-orders-table__header woocommerce-orders-table__header-order-total woocommerce-orders-table__header-subscription-total"><span class="nobr"><?php echo esc_html_x( 'Total', 'table heading', 'woocommerce-subscriptions' ); ?></span></th>
			<th class="subscription-actions order-actions woocommerce-orders-table__header woocommerce-orders-table__header-order-actions woocommerce-orders-table__header-subscription-actions">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $subscriptions as $subscription_id => $subscription ) : ?>
			<tr class="order woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $subscription->get_status() ); ?>">
				<td class="subscription-id order-number woocommerce-orders-table__cell woocommerce-orders-table__cell-subscription-id woocommerce-orders-table__cell-order-number" data-title="<?php esc_attr_e( 'ID', 'woocommerce-subscriptions' ); ?>">
					<a href="<?php echo esc_url( $subscription->get_view_order_url() ); ?>">
						<?php echo sprintf( esc_html_x( '#%s', 'hash before order number', 'woocommerce-subscriptions' ), esc_html( $subscription->get_order_number() ) ); ?>
					</a>
				</td>
				<td class="subscription-status order-status woocommerce-orders-table__cell woocommerce-orders-table__cell-subscription-status woocommerce-orders-table__cell-order-status" style="white-space:nowrap;" data-title="<?php esc_attr_e( 'Status', 'woocommerce-subscriptions' ); ?>">
					<?php echo esc_html( wcs_get_subscription_status_name( $subscription->get_status() ) ); ?>
				</td>
				<td class="subscription-next-payment order-date woocommerce-orders-table__cell woocommerce-orders-table__cell-subscription-next-payment woocommerce-orders-table__cell-order-date" data-title="<?php echo esc_attr_x( 'Next payment', 'table heading', 'woocommerce-subscriptions' ); ?>">
					<?php echo esc_html( $subscription->get_date_to_display( 'next_payment' ) ); ?>
				</td>
				<td class="subscription-total order-total woocommerce-orders-table__cell woocommerce-orders-table__cell-subscription-total woocommerce-orders-table__cell-order-total" data-title="<?php echo esc_attr_x( 'Total', 'Used in data attribute. Escaped', 'woocommerce-subscriptions' ); ?>">
					<?php echo wp_kses_post( $subscription->get_formatted_order_total() ); ?>
				</td>
				<td class="subscription-actions order-actions woocommerce-orders-table__cell woocommerce-orders-table__cell-subscription-actions woocommerce-orders-table__cell-order-actions">
					<a href="<?php echo esc_url( $subscription->get_view_order_url() ) ?>" class="btn btn-outline-secondary btn-block"><?php echo esc_html_x( 'View', 'view a subscription', 'woocommerce-subscriptions' ); ?></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_subscription_after_related_subscriptions_table', $subscriptions, $order_id ); ?>
