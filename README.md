# SMNTCS Show Sale Price Date for WooCommerce

Contributors: nielslange  
Tags: WooCommerce, Sale Price End Date  
Version: 1.0  
Requires at least: 5.3  
Tested up to: 5.4  
Requires PHP: 5.6  
License: GPL3+  
License URI: http://www.gnu.org/licenses/gpl.html  

Show WooCommerce sale prices date on shopping page.

## Description

Show WooCommerce sale prices date on shopping page.

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

Contributions are always welcome. Simply head over to [Github](https://github.com/nielslange/smntcs-woocommerce-show-sale-price-date/pulls) and create an issue or open a pull request.

## Installation

1. Upload 'smntcs-woocommerce-show-sale-price-date' to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress

## Change log

**1.0**

* Initial release
