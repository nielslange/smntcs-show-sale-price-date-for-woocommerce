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
 * Requires PHP: 5.6
 * Tested up to: 5.4
 * WC requires at least: 3.0
 * WC tested up to: 4.1
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
 * Show warning if WooCommerce is not active or WooCommerce version < 3.0
 *
 * @return void
 * @since 1.3.0
 */
function smntcs_sale_price_admin_notices() {
	global $woocommerce;

	if ( ! class_exists( 'WooCommerce' ) || version_compare( $woocommerce->version, '3.0', '<' ) ) {
		$class   = 'notice notice-warning is-dismissible';
		$message = __( 'SMNTCS Show Sale Price Date for WooCommerce requires at least WooCommerce 3.0', 'smntcs-show-sale-price-date-for-woocommerce' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}
}
add_action( 'admin_notices', 'smntcs_sale_price_admin_notices' );

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
 * Add settings link on plugin page.
 *
 * @param array $links The original array with customizer links.
 * @return array $links The updated array with customizer links.
 * @since 1.3.0
 */
function smntcs_sale_price_settings_link( $links ) {
	$admin_url     = admin_url( 'customize.php?autofocus[section]=smntcs_sale_price_section' );
	$settings_link = '<a href="' . $admin_url . '">' . __( 'Settings', 'smntcs-show-sale-price-date-for-woocommerce' ) . '</a>';
	array_unshift( $links, $settings_link );

	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'smntcs_sale_price_settings_link' );

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

		if ( $label ) {
			return str_replace( '</ins>', '</ins> <small>(' . esc_html( $label ) . ' ' . esc_html( $date ) . ')</small>', $price );
		} else {
			return str_replace( '</ins>', '</ins> <small>(' . esc_html( $date ) . ')</small>', $price );
		}
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
			'label'       => __( 'Label', 'smntcs-show-sale-price-date-for-woocommerce' ),
			'section'     => 'smntcs_sale_price_section',
			'type'        => 'text',
			'input_attrs' => array(
				'placeholder' => __( 'Discounted until', 'smntcs-show-sale-price-date-for-woocommerce' ),
			),
		)
	);
}
add_action( 'customize_register', 'smntcs_sale_price_enhance_customizer' );
