<?php
add_action( 'woocommerce_thankyou', 'pnmbr_add_to_vuupt');

add_action('wp_insert_post', function($order_id)
{
    if(!did_action('woocommerce_checkout_order_processed')
        && get_post_type($order_id) == 'shop_order'
        // && validate_order($order_id)
				)
    {
         pnmbr_add_to_vuupt($order_id);
    }
});

function validate_order($order_id)
{
    $order = new \WC_Order($order_id);
    $user_meta = get_user_meta($order->get_user_id());
    if($user_meta)
        return true;
    return false;
}

function pnmbr_add_to_vuupt( $order_id ){

	// Order Setup Via WooCommerce

	$order = new WC_Order( $order_id );

	// Iterate Through Items

	//$items = $order->get_items();
	//foreach ( $items as $item ) {
    // $product_id = $item['product_id'];
    // $product = new WC_Product($item['product_id']);



        // Only add Marmitas
        //if ( has_term( 'marmita', 'product_cat', $product_id ) ) {

	       	$name		= $order->billing_first_name;
        	$surname	= $order->billing_last_name;
        	$email		= $order->billing_email;
          $phone = '55'.$order->billing_phone;
          $notes = $order->get_customer_note();
          $address = formatted_shipping_address($order);
        	$apikey 	= "8sGsj2Cu1UQmUVTX";

					$service_id = get_post_meta( $order_id, 'service_id' )[0];
					$customer_id = get_post_meta( $order_id, 'customer_id' )[0];

					// API Callout to URL
        	$url_customer = 'https://api.vuupt.com/api/v1/customers'.($customer_id ? '/'.$customer_id : '');
        	$url_service = 'https://api.vuupt.com/api/v1/services'.($service_id ? '/'.$service_id : '');

          $geocoded = getGeocodeData($address);

					$body_customer = array(
						"name"	=> "{$name} {$surname}",
						"address" 		=> $address,
						"address_complement" => $order->shipping_address_2,
						"latitude" 		=> $geocoded['latitude'] ?: 0,
						"longitude" 		=> $geocoded['longitude'] ?: 0,
		        "email" => $email,
		        "phone_number" => $phone,
					);

			$response = wp_remote_post( $url_customer,
				array(
					'headers'   => array(
            'Content-Type' => 'application/json; charset=utf-8',
            'Authorization' => 'api_key '.$apikey ),
					'method'    => ( $customer_id ? 'PUT' : 'POST' ),
					'timeout' => 75,
					'body'		=> json_encode($body_customer),
				)
			);

			$vars = json_decode($response['body'],true);

      if ($order->get_payment_method() == 'cod') {
        $ordertitle = '[R$ '.$order->get_total().'] ';
      } else {
        $ordertitle = '[PG] ';
      }
			$ordertitle .= $order_id;
      $ordertitle .= ($notes ? '→'.$notes : '');

			//LOOP ALL THE PRODUCTS IN THE CART
			$products = $order->get_items();
			$ptotal = 0;
      foreach($products as $product) {
			  $ptotal += $product['qty'];
        // $_product =  wc_get_product( $product['product_id'] );
            //GET GET PRODUCT M3
            // $prod_m3 = $_product->get_length() *
            //            $_product->get_width() *
            //            $_product->get_height();
            //MULTIPLY BY THE CART ITEM QUANTITY
            //DIVIDE BY 1000000 (ONE MILLION) IF ENTERING THE SIZE IN CENTIMETERS
            // $prod_m3 = ($prod_m3 * $product['qty']) / 10000;
            //PUSH RESULT TO ARRAY
            // array_push($cart_prods_m3, $prod_m3);
      }
			// $dimension = (int)array_sum($cart_prods_m3) ** (1/3);

			$orderdate = date( 'Y-m-d', $order->get_date_created()->getOffsetTimestamp());
			$dotw =  date( 'D', $order->get_date_created ()->getOffsetTimestamp());
  		$ampm = date( 'a', $order->get_date_created ()->getOffsetTimestamp());

			if (($dotw == 'Mon' && $ampm == 'am') ) {
		    $deliveryperiod = 'tuesday';
		  } else if (($dotw == 'Thu' && $ampm == 'pm') || (in_array ( $dotw, ['Fri', 'Sat', 'Sun']) )) {
		    $deliveryperiod = 'tuesday';
		  } else if ($dotw == 'Thu' && $ampm == 'am') {
		    $deliveryperiod = 'friday';
		  } else {
		    $deliveryperiod = 'friday';
		  }

			$next_delivery = date('Y-m-d', strtotime("next ".$deliveryperiod, strtotime($order->get_date_created()) ));


      $body_service = array(
				"title"	=> $ordertitle,
        "notes" => $notes,
				"customer_id" 		=> $vars['customer']['id'],
				"dimension_1" => $ptotal,
				"dimension_2" => $ptotal,
				"dimension_3" => $ptotal,
				"dimension_4" => $ptotal,
				"dimension_5" => $ptotal,
				"note" => $phone,
				"scheduled_start" => $next_delivery." 11:00:00",
				"scheduled_end" => $next_delivery." 21:00:00",
			);

			// $order->add_order_note( 'agendado para '.$deliveryperiod.':'.$orderdate.'->'.$next_delivery );

      $response = wp_remote_post( $url_service,
				array(
					'headers'   => array(
            'Content-Type' => 'application/json; charset=utf-8',
            'Authorization' => 'api_key '.$apikey ),
					'method'    => ( $service_id ? 'PUT' : 'POST' ),
					'timeout' => 75,
					'body'		=> json_encode($body_service),
				)
			);

			$vars_service = json_decode($response['body'],true);

      // Add order note with customer ID
      $order->add_order_note( 'service id: '.$service_id ?: $vars_service['service']['id'] );
			// Adding meta to avoid duplicity
			update_post_meta($order_id, 'customer_id', $customer_id ?: $vars['customer']['id'] );
			update_post_meta($order_id, 'service_id', $service_id ?: $vars_service['service']['id'] );

			return true;
}

function formatted_shipping_address($order) {
    return
        $order->shipping_address_1 .
        $order->shipping_number . ', ' .
        $order->shipping_city      . ', ' .
        $order->shipping_state     . ' ' .
        $order->shipping_postcode;
}


function getGeocodeData($address)
{
    $address = urlencode($address);
    $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyAjBCtXyKi93aIMOTi5s5wDSkYQ_TC5aQ0";
    $geocodeResponseData = curl_get_contents($googleMapUrl);
    $responseData = json_decode($geocodeResponseData, true);
    if ($responseData['status'] == 'OK') {
        $latitude = isset($responseData['results'][0]['geometry']['location']['lat']) ? $responseData['results'][0]['geometry']['location']['lat'] : "";
        $longitude = isset($responseData['results'][0]['geometry']['location']['lng']) ? $responseData['results'][0]['geometry']['location']['lng'] : "";
        $formattedAddress = isset($responseData['results'][0]['formatted_address']) ? $responseData['results'][0]['formatted_address'] : "";
        if ($latitude && $longitude && $formattedAddress) {
            return [
                'address_formatted' => $formattedAddress,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ];
        } else {
            return 'weird error.';
            return false;
        }
    } else {
        return "ERROR: {$responseData['status']}";
        return false;
    }
}

function curl_get_contents($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}
