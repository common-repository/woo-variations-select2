<?php
/*
Plugin Name: WooCommerce variations Select2
Description: A simple plugin that enables Select2 for WooCommerce variations select boxes
Author: Sti3bas
Version: 1.3
Author URI: https://github.com/sti3bas
*/

include_once(ABSPATH . 'wp-admin/includes/plugin.php');

/**
 * Check if WooCommerce is active
 **/
if (! is_plugin_active('woocommerce/woocommerce.php') && ! is_plugin_active_for_network('woocommerce/woocommerce.php')) {
    add_action('admin_notices', 'woovs2_woocommerce_inactive_notice');
    return;
}

function woovs2_woocommerce_inactive_notice()
{
    ?>
	<div id="message" class="error">
		<p>
			<?php echo __('WooCommerce variations Select2 is inactive. The WooCommerce plugin must be active for WooCommerce variations Select2 to work. Please install & activate WooCommerce.', 'woocommerce-variations-select2')?>
		</p>
	</div>
	<?php
}

function woovs2_enqueue_scripts()
{
    $suffix	= defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

    if (! wp_script_is('select2', 'enqueued')) {
        wp_enqueue_script('select2', WC()->plugin_url() . '/assets/js/select2/select2.full' . $suffix . '.js', ['jquery']);
    }

    if (! wp_style_is('select2', 'enqueued')) {
        wp_enqueue_style('select2', WC()->plugin_url() . '/assets/css/select2.css', []);
    }

    wp_enqueue_script('woo-select2', plugin_dir_url(__FILE__) . 'js/woo-variations-select2' . $suffix . '.js', ['jquery', 'select2']);
}

add_action('wp_enqueue_scripts', 'woovs2_enqueue_scripts');

?>