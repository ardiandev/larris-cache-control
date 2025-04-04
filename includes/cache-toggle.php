<?php
// Add the Cache purge toggle switch to the admin page
function display_cache_toggle() {
    // Get and sanitize current setting
    $purge_enabled = (int) get_option('purge_pattern_cache', 0); // Force to int (0 or 1)
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Cache Control Settings', 'larris-theme'); ?></h1>
        <p><?php esc_html_e('Toggle the switch below to enable or disable automatic cache clearing. When enabled, any changes to the theme patterns will automatically trigger a cache purge, which can help ensure that the latest changes are reflected on the site.', 'larris-theme'); ?></p>

        <form method="post" action="options.php">
            <?php settings_fields('cache-settings-group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="purge_pattern_cache"><?php esc_html_e('Enable Cache Purge', 'larris-theme'); ?></label>
                    </th>
                    <td>
                        <!-- Keep your custom switch styling -->
                        <label class="switch">
                            <input type="checkbox" id="purge_pattern_cache" name="purge_pattern_cache" value="1" <?php checked($purge_enabled, 1); ?> />
                            <span class="slider round"></span>
                        </label>
                        <p class="description"><?php esc_html_e('Enable or disable automatic cache purge feature when the theme patterns are updated.', 'larris-theme'); ?></p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Hook to add the settings page in the WordPress admin menu
add_action('admin_menu', function() {
    add_menu_page(
        __('Cache Control Settings', 'larris-theme'), // Page title
        __('Cache Control', 'larris-theme'),          // Menu title
        'manage_options',                             // Capability
        'cache-control-settings',                     // Slug
        'display_cache_toggle',                       // Callback
        'dashicons-admin-tools',                      // Icon
        60                                            // Position
    );
});
