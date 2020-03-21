# SMNTCS Show Sale Price Date for WooCommerce

[![Support Level](https://img.shields.io/badge/support-active-green.svg)](#support-level)
[![Build Status](https://api.travis-ci.com/nielslange/smntcs-show-sale-price-date-for-woocommerce.svg?branch=master)](https://api.travis-ci.com/nielslange/smntcs-show-sale-price-date-for-woocommerce)
[![GPLv3 License](https://img.shields.io/github/license/nielslange/smntcs-show-sale-price-date-for-woocommerce.svg)](https://www.gnu.org/licenses/gpl.html)
[![Compatible to WordPress version](https://plugintests.com/plugins/smntcs-show-sale-price-date-for-woocommerce/wp-badge.svg)](https://plugintests.com/plugins/smntcs-show-sale-price-date-for-woocommerce/latest)
[![Compatible to PHP version](https://plugintests.com/plugins/smntcs-show-sale-price-date-for-woocommerce/php-badge.svg)](https://plugintests.com/plugins/smntcs-show-sale-price-date-for-woocommerce/latest)
[![Downloads](https://img.shields.io/wordpress/plugin/dt/smntcs-show-sale-price-date-for-woocommerce.svg)](https://wordpress.org/plugins/smntcs-show-sale-price-date-for-woocommerce/)
[![Plugin Version](https://img.shields.io/wordpress/plugin/v/smntcs-show-sale-price-date-for-woocommerce.svg)](https://wordpress.org/plugins/smntcs-show-sale-price-date-for-woocommerce/)
[![Tag Version](https://img.shields.io/github/tag/nielslange/smntcs-show-sale-price-date-for-woocommerce.svg)](https://wordpress.org/plugins/smntcs-show-sale-price-date-for-woocommerce/)

Show WooCommerce sale prices date on shopping page.

## Description

Show WooCommerce sale prices date on shopping page.

## Plugin page

You can find the plugin on https://wordpress.org/plugins/smntcs-show-sale-price-date-for-woocommerce/.

## Installation

1. Upload 'smntcs-woocommerce-show-sale-price-date' to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress

## Filter

### Adjust date format:

```
add_filter(‘sale_date_format’,’my_custom_sale_date_format’ );
function my_custom_sale_date_format() {
	return “r”;
}
```

### Adjust label:

```
add_filter(‘sale_date_label’,’my_custom_sale_date_label’ );
function my_custom_sale_date_label() {
	return “Valid until”;
}
```

## Contribute

Contributions are always welcome. Simply [create a new issue](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/new) or [open a pull request](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/compare).

## Change log

### 1.1
* [Add build tools](https://github.com/nielslange/smntcs-show-sale-price-date-for-woocommerce/issues/1)

### 1.0
* Initial release
