<?php
/**
 * Plugin Name: SMNTCS Show Sale Price Date for WooCommerce
 * Plugin URI:
 * Description: Show WooCommerce sale prices date on shopping page
 * Author: Niels Lange
 * Author URI: https://nielslange.de/
 * Version: 1.0
 * Text Domain: smntcs-show-sale-price-date-for-woocommerce
 * Domain Path: /languages
 * License: GPL3+
 * License URI: http://www.gnu.org/licenses/gpl.txt
 *
 * @category   Plugin
 * @package    WordPress
 * @subpackage SMNTCS Show Sale Price Date for WooCommerce
 * @author     Niels Lange <info@nielslange.de>
 * @license    http://www.gnu.org/licenses/gpl.txt GNU General Public License version 3
 */

/**
 * Add sale date end date to product page.
 *
 * @param String $price The price string.
 * @param Object $product The product object.
 * @return String The formated price.
 */
function smntcs_woocommerce_get_price_html( $price, $product ) {
	global $post;
	$sales_price_to = get_post_meta( $post->ID, '_sale_price_dates_to', true );
	if ( is_single() && '' !== $sales_price_to ) {
		$format = apply_filters( 'sale_date_format', get_option( 'date_format' ) );
		$label  = apply_filters( 'sale_date_label', 'Discounted until' );
		$date   = wp_date( $format, $sales_price_to );
		return str_replace( '</ins>', ' </ins><small>(' . esc_html( $label ) . ' ' . esc_html( $date ) . ')</small>', $price );
	} else {
		return apply_filters( 'woocommerce_get_price', $price );
	}
}
add_filter( 'woocommerce_get_price_html', 'smntcs_woocommerce_get_price_html', 100, 2 );
