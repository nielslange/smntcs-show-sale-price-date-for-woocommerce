<?php
/**
 * Plugin Name:          SMNTCS Show Sale Price Date for WooCommerce
 * Plugin URI:           https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce
 * Description:          Show WooCommerce sale prices date on shopping page
 * Text Domain:          smntcs-show-sale-price-date-for-woocommerce
 * Version:              1.6
 * Tested up to:         6.1
 * Requires at least:    5.3
 * Requires PHP:         5.6
 * WC requires at least: 3.0
 * WC tested up to:      7.1
 * Author:               Niels Lange
 * Author URI:           https://nielslange.com/
 * License:              GPL v2 or later
 * License URI:          https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package SMNTCS_Show_Sale_Price_Date_For_WC
 */

defined( 'ABSPATH' ) || exit;

/**
 * SMNTCS_Show_Sale_Price_Date_For_WC main class.
 */
class SMNTCS_Show_Sale_Price_Date_For_WC {

	/**
	 * Initialise the plugin.
	 *
	 * @return void
	 * @since 1.2.0
	 */
	public static function init() {
		add_action( 'admin_notices', array( __CLASS__, 'admin_notices' ) );
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( __CLASS__, 'add_plugin_settings_link' ) );
		add_filter( 'woocommerce_get_price_html', array( __CLASS__, 'get_price_html' ), 10, 2 );
		add_action( 'customize_register', array( __CLASS__, 'enhance_customizer' ) );
	}

	/**
	 * Show warning if WooCommerce is not active or WooCommerce version <small 3.0
	 *
	 * @return void
	 * @since 1.3.0
	 */
	public static function admin_notices() {
		global $woocommerce;

		if ( ! class_exists( 'WooCommerce' ) || version_compare( $woocommerce->version, '3.0', '<' ) ) {
			$class   = 'notice notice-warning is-dismissible';
			$message = __( 'SMNTCS Show Sale Price Date for WooCommerce requires at least WooCommerce 3.0', 'smntcs-show-sale-price-date-for-woocommerce' );

			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
		}
	}

	/**
	 * Add settings link on plugin page.
	 *
	 * @param array $links The original array with customizer links.
	 * @return array $links The updated array with customizer links.
	 * @since 1.3.0
	 */
	public static function add_plugin_settings_link( $links ) {
		$admin_url     = admin_url( 'customize.php?autofocus[section]=smntcs_sale_price_section' );
		$settings_link = '<a href="' . $admin_url . '">' . __( 'Settings', 'smntcs-show-sale-price-date-for-woocommerce' ) . '</a>';
		array_unshift( $links, $settings_link );

		return $links;
	}

	/**
	 * Add sale end dates to single product page.
	 *
	 * @param String $price The price string.
	 * @param Object $product The product object.
	 * @return String The formated price.
	 * @since 1.0.0
	 */
	public static function get_price_html( $price, $product ) {
		if ( $product->is_type( 'simple' ) ) {
			$sales_price_to = strtotime( $product->get_date_on_sale_to() );
		}

		if ( $product->is_type( 'variable' ) ) {
			$sale_dates    = array();
			$variation_ids = $product->get_visible_children();
			foreach ( $variation_ids as $variation_id ) {
				$variation = wc_get_product( $variation_id );

				if ( $variation->is_on_sale() ) {
					array_push( $sale_dates, strtotime( $variation->get_date_on_sale_to() ) );
				}
			}
			rsort( $sale_dates );
			$sales_price_to = $sale_dates[0];
		}

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
			return apply_filters( 'woocommerce_product_get_price', $price );
		}
	}

	/**
	 * Enhance WordPress customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize The customizer object.
	 * @return void
	 * @since 1.3.0
	 */
	public static function enhance_customizer( $wp_customize ) {
		global $woocommerce;

		// Return if WooCommerce hasn't been installed.
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		$wp_customize->add_section(
			'smntcs_sale_price_section',
			array(
				'title'    => __( 'Show Sale Price Date', 'smntcs-show-sale-price-date-for-woocommerce' ),
				'priority' => 50,
				'panel'    => 'woocommerce',
			)
		);

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
}

SMNTCS_Show_Sale_Price_Date_for_WC::init();
