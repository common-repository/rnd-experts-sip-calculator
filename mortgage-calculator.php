<?php
/*
 *
 * Plugin Name:     Mortgage Calculator
 * Plugin URI:      rndexperts.com
 * Description:     This plugin can be used to calculate Systematic Investment Plan (SIP). You can place shortcode <code>[sip-calculator]</code> anywhere on your templates, pages or posts.
 * Author:          Rnd Experts
 * Author URI:      rndexperts.com
 * Text Domain:     mortgage-calculator
 * Domain Path:     /languages
 * Version:         0.2.0
 *
 * @package         Mortgage_Calcualtor
 */
define('SCALC_Calculator_Url', plugin_dir_url(__FILE__));
define('SCALC_Calculator_Path', plugin_dir_path(__FILE__));
/**
 * Registers a stylesheet.
 */
if (!function_exists('scalc_custom_plugin_styles')) {
    function scalc_custom_plugin_styles()
    {
        wp_register_style('scalc-bootstrapcdn', plugin_dir_url(__FILE__) . 'assets/css/bootstrap.min.css');
        wp_register_script('scalc-bootstrapcdnjs', plugin_dir_url(__FILE__) . 'assets/js/bootstrap.bundle.min.js', array('jquery'), '', false);
        wp_register_script('scalc-chartsjs', plugin_dir_url(__FILE__) . 'assets/js/loader.js', array('jquery'), '', false);

    }
    // Register style sheet.
    add_action('wp_enqueue_scripts', 'scalc_custom_plugin_styles');
}

if (!function_exists('scalc_PluginTextdomain')) {
    function scalc_PluginTextdomain()
    {
        load_plugin_textdomain('mortgage-calculator', false, basename(dirname(__FILE__)) . '/languages/');
    }
    add_action('init', 'scalc_PluginTextdomain');
}

if (!function_exists('scalc_shortcode_fn')) {
    function scalc_shortcode_fn($atts)
    {
        $a = shortcode_atts(array(
            'invested_amount_monthly' => 5000,
            'estimated_return_rate' => 10,
            'years' => 5,
        ), $atts);

        wp_enqueue_style('scalc-bootstrapcdn');
        wp_enqueue_script('scalc-bootstrapcdnjs');
        wp_enqueue_script('scalc-chartsjs');
        ob_start();
        include SCALC_Calculator_Path . 'includes/index.php';
        return ob_get_clean();

    }
    add_shortcode('sip-calculator', 'scalc_shortcode_fn');
}
