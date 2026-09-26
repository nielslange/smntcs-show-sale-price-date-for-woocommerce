<?php
/**
 * Plugin Name:          SMNTCS Show Sale Price Date for WooCommerce
 * Plugin URI:           https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce
 * Description:          Shows the end date of a WooCommerce sale next to the sale price on the product page.
 * Text Domain:          smntcs-show-sale-price-date-for-woocommerce
 * Version:              1.9
 * Requires at least:    5.3
 * Requires PHP:         7.4
 * Requires Plugins:     woocommerce
 * WC requires at least: 3.0
 * WC tested up to:      11.1
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
		add_action( 'admin_notices', array( __CLASS__, 'admin_notices' ), 10, 0 );
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( __CLASS__, 'add_plugin_settings_link' ) );
		add_filter( 'woocommerce_get_price_html', array( __CLASS__, 'get_price_html' ), 10, 2 );
		add_action( 'customize_register', array( __CLASS__, 'enhance_customizer' ) );
		add_action( 'before_woocommerce_init', array( __CLASS__, 'declare_compatibility' ), 10, 0 );
	}

	/**
	 * Declare compatibility with WooCommerce features.
	 *
	 * @return void
	 * @since 1.9
	 */
	public static function declare_compatibility() {
		if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'cart_checkout_blocks', __FILE__, true );
		}
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
	 * Add the sale end date to the price on the single product page.
	 *
	 * Only the product that the page is about gets the date, so related and
	 * up-sell products keep their normal price. Every other price is returned
	 * unchanged.
	 *
	 * @param string     $price   The price HTML.
	 * @param WC_Product $product The product object.
	 * @return string The price HTML, with the sale end date when there is one.
	 * @since 1.0.0
	 */
	public static function get_price_html( $price, $product ) {
		if ( ! $product instanceof WC_Product || ! is_product() || ! $product->is_on_sale() ) {
			return $price;
		}

		$queried_id = get_queried_object_id();
		if ( $product->get_id() !== $queried_id && $product->get_parent_id() !== $queried_id ) {
			return $price;
		}

		$timestamp = self::get_sale_end_timestamp( $product );
		if ( ! $timestamp ) {
			return $price;
		}

		$format = apply_filters( 'sale_date_format', get_option( 'date_format' ) );
		$label  = apply_filters( 'sale_date_label', get_option( 'smntcs_sale_price_label', __( 'Discounted until', 'smntcs-show-sale-price-date-for-woocommerce' ) ) );
		$date   = wp_date( $format, $timestamp );
		$text   = $label ? $label . ' ' . $date : $date;

		return str_replace( '</ins>', '</ins> <small class="smntcs-sale-price-date">(' . esc_html( $text ) . ')</small>', $price );
	}

	/**
	 * Get the timestamp at which the sale of a product ends.
	 *
	 * For variable products this is the latest end date of all variations on sale.
	 *
	 * @param WC_Product $product The product object.
	 * @return int The Unix timestamp, or 0 when the sale has no end date.
	 * @since 1.9
	 */
	private static function get_sale_end_timestamp( $product ) {
		if ( $product instanceof WC_Product_Variable ) {
			$timestamps = array();
			foreach ( $product->get_visible_children() as $variation_id ) {
				$variation = wc_get_product( $variation_id );
				if ( $variation && $variation->is_on_sale() && $variation->get_date_on_sale_to() ) {
					$timestamps[] = $variation->get_date_on_sale_to()->getTimestamp();
				}
			}

			return $timestamps ? max( $timestamps ) : 0;
		}

		$date_on_sale_to = $product->get_date_on_sale_to();

		return $date_on_sale_to ? $date_on_sale_to->getTimestamp() : 0;
	}

	/**
	 * Enhance WordPress customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize The customizer object.
	 * @return void
	 * @since 1.3.0
	 */
	public static function enhance_customizer( $wp_customize ) {
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
				'default'           => __( 'Discounted until', 'smntcs-show-sale-price-date-for-woocommerce' ),
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

SMNTCS_Show_Sale_Price_Date_For_WC::init();
