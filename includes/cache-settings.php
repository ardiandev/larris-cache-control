<?php 
// Register the setting for the purge toggle
function register_cache_settings() {
    register_setting('cache-settings-group', 'purge_pattern_cache', [
        'type' => 'boolean',
        'sanitize_callback' => 'rest_sanitize_boolean',
        'default' => 0,
    ]);
}

add_action('admin_init', 'register_cache_settings');
