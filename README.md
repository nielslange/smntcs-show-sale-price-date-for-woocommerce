# SMNTCS Show Sale Price Date for WooCommerce

![Support Level](https://img.shields.io/badge/support-active-green.svg)
![Build Status](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/actions/workflows/test.yml/badge.svg)
![GPLv3 License](https://img.shields.io/github/license/nielslange/smntcs-show-sale-price-date-for-woocommerce.svg)
![Compatible to WordPress version](https://plugintests.com/plugins/smntcs-show-sale-price-date-for-woocommerce/wp-badge.svg)
![Compatible to PHP version](https://plugintests.com/plugins/smntcs-show-sale-price-date-for-woocommerce/php-badge.svg)
![Downloads](https://img.shields.io/wordpress/plugin/dt/smntcs-show-sale-price-date-for-woocommerce.svg)
![Plugin Version](https://img.shields.io/wordpress/plugin/v/smntcs-show-sale-price-date-for-woocommerce.svg)
![Tag Version](https://img.shields.io/github/tag/nielslange/smntcs-show-sale-price-date-for-woocommerce.svg)

Show WooCommerce sale prices date on shopping page.

## Description

Show WooCommerce sale prices date on shopping page.

## Plugin page

You can find the plugin on https://wordpress.org/plugins/smntcs-show-sale-price-date-for-woocommerce/.

## Installation

1. Upload `smntcs-woocommerce-show-sale-price-date` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the `Plugins` menu in WordPress.

## Filter

### Adjust date format:

```
add_filter( 'sale_date_format', 'my_custom_sale_date_format' );
function my_custom_sale_date_format() {
	return 'r';
}
```

### Adjust label:

```
add_filter( 'sale_date_label', 'my_custom_sale_date_label' );
function my_custom_sale_date_label() {
	return 'Valid until';
}
```

## Contribute

Contributions are always welcome. Simply [create a new issue](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/new) or [open a pull request](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/compare).

## Changelog

### 1.6 (2022.12.03)

- [Add support for variable products](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/58)
- Test up to WC 7.1
- Test up to WP 6.1

### 1.5 (2022.10.08)

- Test up to WC 6.9
- Test up to WP 6.0

### 1.4 (2022.01.09)

- Test up to WP 5.9

### 1.3 (2020.05.09)

- [Add info that WooCommerce plugin is required](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/19)
- [Add settings link to plugin page](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/18)
- [Declaring required and supported WooCommerce version](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/15)
- [Make label editable via customizer](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/17)

### 1.2 (2020.03.21)

- [Add GPL3 license](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/11)
- [Format filter on README.txt in pseudo-markdown](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/9)
- [Update screenshot](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/10)

### 1.1 (2020.03.21)

- [Add build tools](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/1)
- [Add release workflow and assets](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/2)

### 1.0 (2020.03.14)

- Initial release
