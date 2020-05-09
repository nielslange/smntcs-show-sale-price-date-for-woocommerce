=== SMNTCS Show Sale Price Date for WooCommerce ===

Contributors: nielslange
Tags: WooCommerce, Sale, Price
Version: 1.2
Requires at least: 5.3
Requires PHP: 5.6
Tested up to: 5.4
WC requires at least: 3.0
WC tested up to: 4.1
License: GPL3+
License URI: http://www.gnu.org/licenses/gpl.html

Show WooCommerce sale prices date on shopping page

== Description ==

Show WooCommerce sale prices date on shopping page

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

1. Upload 'smntcs-woocommerce-show-sale-price-date' to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Change log ==

= 1.2 =
* [Add GPL3 license](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/11)
* [Format filter on README.txt in pseudo-markdown](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/9)
* [Update screenshot](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/10)

= 1.1 =
* [Add build tools](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/1)
* [Add release workflow and assets](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/2)

= 1.0 =
* Initial release
