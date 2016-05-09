<?php
/*
Plugin Name: WC Disable Gateway By Product
Plugin URI: http://idigitalpassion.com/
Description: Disable Payment Gateway according by specific product.
Author: Mohd Shahmi
Author URI: http://shahmi.com
Version: 1.0
Text Domain: wootickets-asia-info

Copyright: � 2016 Mohd Shahmi
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/
//referal from : http://stackoverflow.com/questions/28541612/woocommerce-disable-payment-for-certain-categories

/*
 * Disable PayPal payment method in the checkout if certain 
 * products are present in the cart.
 *
 * Add this to your theme's functions.php file
 */
//Reference : https://support.woothemes.com/hc/en-us/articles/203020545-How-to-Disable-a-Payment-Method-in-Checkout-for-Certain-Products
 
add_filter( 'woocommerce_available_payment_gateways', 'filter_gateways', 1);
function filter_gateways( $gateways ){
  global $woocommerce;
  foreach ($woocommerce->cart->cart_contents as $key => $values ) {
  
    // store product IDs in array PayPal method is disabled at checkout
    $nonPPproducts = array(24370);		// LIST YOUR PRODUCTS HERE

    if ( in_array( $values['product_id'], $nonPPproducts ) ) {	
      unset($gateways['BillPlz']);
      // You can unset other gateways using the gateway ID e.g. "cod", "bacs", "stripe"
      break;
    }
  }
  
  return $gateways;
  
}
