<?php
/**
 * @formatter:off
 * Plugin Name: ABR for WC GA Integration
 * Description: Adds an Adjusted Bounce Rate Event to WooCommerce Google Analytics Integration's tracking code.
 * Version: 1.1.1
 * Author: Daan van den Bergh
 * Author URI: https://daan.dev
 * License: GPL2v2 or later
 * Text Domain: woocommerce-ga-abr
 * @formatter:on
 */

/**
 * This function adds the 'adjusted bounce rate' event $abr seconds after the pageview is sent.
 */
function daan_dev_add_adjusted_bounce_rate()
{
    /**
     * Adjust $abr variable to modify the Adjusted Bounce Rate.
     */
    $abr = 30;

    /************************************
     * DO NOT MODIFY ANYTHING BELOW HERE!
     ************************************/
    $text         = "Pageview of $abr seconds or more";
    $milliseconds = $abr * 1000;
    $pageview     = "ga('send', 'pageview');\n";
    $timeout      = "setTimeout(\"ga('send', 'event', 'adjusted bounce rate', '$text')\", $milliseconds);" . "\n";

    wc_enqueue_js($pageview . $timeout);
}

/**
 * There's a typo in the filter's handle.
 * Might this plugin ever break in the future, it's probably because WooCommerce
 * finally decided to fix this typo. :)
 */
add_filter('wc_goole_analytics_send_pageview', 'daan_dev_add_adjusted_bounce_rate');
