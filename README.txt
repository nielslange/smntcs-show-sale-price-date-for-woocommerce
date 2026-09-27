=== SMNTCS Show Sale Price Date for WooCommerce ===

Contributors:       nielslange
Tags:               woocommerce, sale price, sale date, discount, product page
Requires at least:  5.3
Tested up to:       7.1
Requires PHP:       7.4
Stable tag:         2.0
License:            GPL v2 or later
License URI:        https://www.gnu.org/licenses/gpl-2.0.html

Shows the date a WooCommerce sale ends next to the sale price on the product page.

== Description ==

SMNTCS Show Sale Price Date for WooCommerce tells your customers how long a sale lasts. When a product has a scheduled sale with an end date, the date appears next to the sale price on the product page, for example "(Discounted until 31 December 2026)".

For variable products the latest end date of all variations on sale is shown. Products whose sale has no end date keep their normal price display.

You can change the label in the Customizer under WooCommerce, then Show Sale Price Date.

== Filters ==

Add these lines to your theme's functions.php file or a small plugin.

Change the date format to any PHP date format:

`add_filter( 'sale_date_format', function () { return 'j F Y'; } );`

Change the label in code instead of the Customizer:

`add_filter( 'sale_date_label', function () { return 'Valid until'; } );`

== Contribute ==

Contributions are always welcome. Simply head over to [GitHub](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce) and create an issue or open a pull request.

== Installation ==

1. Upload `smntcs-woocommerce-show-sale-price-date` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the `Plugins` menu in WordPress.

== Changelog ==

= 2.0 (2026.09.27) =

- Fix the formatting of the filter examples in the readme

= 1.9 (2026.09.26) =

- Test up to WordPress 7.1
- Update development dependencies and GitHub Actions
- Test up to WooCommerce 11.1
- Fix a fatal error with WooCommerce 11.1 in the product list, the REST API and the Cart and Checkout blocks
- Stop showing a 1970 date for sales without an end date
- Show the date only for the product the page is about, not for related products
- Declare compatibility with High-Performance Order Storage and the Cart and Checkout blocks

= 1.8 (2024.12.31) =

- Test up to WordPress 6.7

= 1.7 (2024.10.28) =

- Test up to WordPress 6.6

= 1.6 (2022.12.03) =

- [Add support for variable products](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/58)
- Test up to WooCommerce 7.1
- Test up to WordPress 6.1

= 1.5 (2022.10.08) =

- Test up to WooCommerce 6.9
- Test up to WordPress 6.0

= 1.4 (2022.01.09) =

- Test up to WordPress 5.9

= 1.3 (2020.05.09) =

- [Add info that WooCommerce plugin is required](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/19)
- [Add settings link to plugin page](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/18)
- [Declaring required and supported WooCommerce version](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/15)
- [Make label editable via customizer](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/17)

= 1.2 (2020.03.21) =

- [Add GPL3 license](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/11)
- [Format filter on README.txt in pseudo-markdown](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/9)
- [Update screenshot](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/10)

= 1.1 (2020.03.21) =

- [Add build tools](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/1)
- [Add release workflow and assets](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/2)

= 1.0 (2020.03.14) =

- Initial release
