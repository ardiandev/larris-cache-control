<?php
/*
Plugin Name: Larris Cache Control
Plugin URI: https://github.com/ardiandev/larris-cache-control
Description: Adds an admin panel switch to control cache clearing.
Version: 1.0
Author: Ardian Pradana
Author URI: https://ardianpradana.com/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('larris-cache-style', plugin_dir_url(__FILE__) . 'cache-control.css');
});

include_once plugin_dir_path(__FILE__) . 'includes/cache-settings.php';
include_once plugin_dir_path(__FILE__) . '/includes/cache-toggle.php';

// ✅ Automatically flush and redetach if toggle is ON
add_action('admin_init', function() {
    // Check if the purge toggle is enabled
    if (get_option('purge_pattern_cache') == 1) {
        // Only clear cache if toggle is on
        if (is_admin()) {
            $theme = wp_get_theme();
            if (method_exists($theme, 'delete_pattern_cache')) {
                $theme->delete_pattern_cache();
            }
        }
    }
});