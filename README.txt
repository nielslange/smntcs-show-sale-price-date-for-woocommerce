=== SMNTCS Show Sale Price Date for WooCommerce ===

Contributors: nielslange
Tags: WooCommerce Sale Price
Version: 1.4
Tested up to: 5.8
Requires at least: 5.3
Requires PHP: 5.6
WC requires at least: 3.0
WC tested up to: 6.0
License: GPLv2+
License URI: https://opensource.org/licenses/GPL-2.0

Show WooCommerce sale prices date on shopping page.

== Description ==

Show WooCommerce sale prices date on shopping page.

== Filter ==

**Adjust date format:**

    add_filter(‘sale_date_format’,’my_custom_sale_date_format’ );
    function my_custom_sale_date_format() {
        return “r”;
    }

**Adjust label:**

    add_filter(‘sale_date_label’,’my_custom_sale_date_label’ );
    function my_custom_sale_date_label() {
        return “Valid until”;
    }

== Contribute ==

Contributions are always welcome. Simply head over to [Github](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce) and create an issue or open a pull request.

== Installation ==

1. Upload `smntcs-woocommerce-show-sale-price-date` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the `Plugins` menu in WordPress.

== Change log ==

= 1.4 (2022.01.09) =
* Test up to WP 5.9

= 1.3 (2020.05.09) =
* [Add info that WooCommerce plugin is required](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/19)
* [Add settings link to plugin page](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/18)
* [Declaring required and supported WooCommerce version](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/15)
* [Make label editable via customizer](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/17)

= 1.2 (2020.03.21) =
* [Add GPL3 license](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/11)
* [Format filter on README.txt in pseudo-markdown](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/9)
* [Update screenshot](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/10)

= 1.1 (2020.03.21) =
* [Add build tools](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/1)
* [Add release workflow and assets](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/2)

= 1.0 (2020.03.14) =
* Initial release
