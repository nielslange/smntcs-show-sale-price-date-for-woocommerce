<?php
/**
 * Plugin Name: SMNTCS Show Sale Price Date for WooCommerce
 * Plugin URI: https://github.com/nielslange/smntcs-woocommerce-quantity-buttons
 * Description: Show WooCommerce sale prices date on shopping page
 * Author: Niels Lange
 * Author URI: https://nielslange.de/
 * Text Domain: smntcs-show-sale-price-date-for-woocommerce
 * Domain Path: /languages
 * Version: 1.2
 * Requires at least: 5.3
 * Tested up to: 5.4
 * Requires PHP: 5.6
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
 * Load text domain.
 *
 * @return void
 * @since 1.3.0
 */
function smntcs_sale_price_load_textdomain() {
	load_plugin_textdomain( 'smntcs-show-sale-price-date-for-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'smntcs_sale_price_load_textdomain' );

/**
 * Add sale date end date to product page.
 *
 * @param String $price The price string.
 * @param Object $product The product object.
 * @return String The formated price.
 * @since 1.0.0
 */
function smntcs_woocommerce_get_price_html( $price, $product ) {
	global $post;
	$sales_price_to = get_post_meta( $post->ID, '_sale_price_dates_to', true );
	if ( is_single() && '' !== $sales_price_to ) {
		$format = apply_filters( 'sale_date_format', get_option( 'date_format' ) );
		$label  = apply_filters( 'sale_date_label', get_option( 'smntcs_sale_price_label', 'Discounted until' ) );
		$date   = wp_date( $format, $sales_price_to );
		return str_replace( '</ins>', '</ins> <small>(' . esc_html( $label ) . ' ' . esc_html( $date ) . ')</small>', $price );
	} else {
		return apply_filters( 'woocommerce_get_price', $price );
	}
}
add_filter( 'woocommerce_get_price_html', 'smntcs_woocommerce_get_price_html', 100, 2 );

/**
 * Enhance WordPress customizer.
 *
 * @param WP_Customize_Manager $wp_customize The customizer object.
 * @return void
 * @since 1.3.0
 */
function smntcs_sale_price_enhance_customizer( $wp_customize ) {
	global $woocommerce;

	// Return if WooCommerce hasn't been installed.
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	// Create customizer section.
	$wp_customize->add_section(
		'smntcs_sale_price_section',
		array(
			'title'    => __( 'Show Sale Price Date', 'smntcs-show-sale-price-date-for-woocommerce' ),
			'priority' => 50,
			'panel'    => 'woocommerce',
		)
	);

	// Label "Discounted until".
	$wp_customize->add_setting(
		'smntcs_sale_price_label',
		array(
			'default'           => 'Discounted until',
			'sanitize_callback' => 'sanitize_text_field',
			'type'              => 'option',
		)
	);
	$wp_customize->add_control(
		'smntcs_sale_price_label',
		array(
			'label'   => __( 'Label', 'smntcs-show-sale-price-date-for-woocommerce' ),
			'section' => 'smntcs_sale_price_section',
			'type'    => 'text',
		)
	);
}
add_action( 'customize_register', 'smntcs_sale_price_enhance_customizer' );
