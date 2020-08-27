<?php 

  if (is_user_logged_in()) {
  foreach (wcs_get_users_subscriptions($user_id) as $subscription_id => $subscription) { ?>

<table class="shop_table shop_table_responsive my_account_orders woocommerce-orders-table woocommerce-MyAccount-orders woocommerce-orders-table--orders">
  <h2 class="heading--tall">Assinatura <?= $subscription_id ?></h2>
  <tbody>
  <?php
    foreach ($subscription->get_related_orders() as $sorder_id) {
      $order = wc_get_order( $sorder_id ); ?>
        
            <?php
                // skip invalid
                if ( !$order) {
                  continue;
                }

                // skip if order is still to be paid
                // if (!$order->has_status('processing') && !$order->has_status('completed')) {
                //   continue;
                // }

                // skip if person already picked the weekly menu
                if ($order->get_meta('_items')) {
                  continue;
                }
              
                
                // if ($sorder_id == 183) {
                //     $order->update_meta_data( '_items', 'valor teste' );
                //     $order->save();
                //   }

            $item_count = $order->get_item_count();
            $order_date = $order->get_date_created();

            ?><tr class="order woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?>">
              <td class="order-number woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="<?php esc_attr_e( 'Order Number', 'woocommerce-subscriptions' ); ?>">
                <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
                  <?php echo sprintf( esc_html_x( '#%s', 'hash before order number', 'woocommerce-subscriptions' ), esc_html( $order->get_order_number() ) ); ?>
                </a>
              </td>
              <td class="order-date woocommerce-orders-table__cell woocommerce-orders-table__cell-order-date" data-title="<?php esc_attr_e( 'Date', 'woocommerce-subscriptions' ); ?>">
                <time datetime="<?php echo esc_attr( $order_date->date( 'Y-m-d' ) ); ?>" title="<?php echo esc_attr( $order_date->getTimestamp() ); ?>"><?php echo wp_kses_post( $order_date->date_i18n( wc_date_format() ) ); ?></time>
              </td>
              <td class="order-actions woocommerce-orders-table__cell woocommerce-orders-table__cell-order-actions">
                <?php $actions = array();

                if ( $order->needs_payment() && wcs_get_objects_property( $order, 'id' ) == $subscription->get_last_order( 'ids', 'any' ) ) {
                  $actions['pay'] = array(
                    'url'  => $order->get_checkout_payment_url(),
                    'name' => esc_html_x( 'Pay', 'pay for a subscription', 'woocommerce-subscriptions' ),
                  );
                }

                if ( in_array( $order->get_status(), apply_filters( 'woocommerce_valid_order_statuses_for_cancel', array( 'pending', 'failed' ), $order ) ) ) {
                  $redirect = wc_get_page_permalink( 'myaccount' );

                  if ( wcs_is_view_subscription_page() ) {
                    $redirect = $subscription->get_view_order_url();
                  }

                  $actions['cancel'] = array(
                    'url'  => $order->get_cancel_order_url( $redirect ),
                    'name' => esc_html_x( 'Cancel', 'an action on a subscription', 'woocommerce-subscriptions' ),
                  );
                }

                $actions['menuselect'] = array(
                  'url'  => $order->get_view_order_url(),
                  'name' => esc_html_x( 'Escolher itens', 'escolher itens', 'woocommerce-subscriptions' ),
                );

                $actions = apply_filters( 'woocommerce_my_account_my_orders_actions', $actions, $order );

                if ( $actions ) {
                  foreach ( $actions as $key => $action ) {
                    echo wp_kses_post( '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button btn btn-tertiary btn-block ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>' );
                  }
                }
                ?>
              </td>
            </tr>
          
      <?
    }
  }

?>
</tbody>
</table>
<?php } ?>