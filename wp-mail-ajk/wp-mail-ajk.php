<?php
/**
 * Plugin Name: WP Mail AJK
 * Plugin URI:  https://example.com/wp-mail-ajk
 * Description: Wtyczka do konfiguracji wysyłania e-maili z WordPressa poprzez zewnętrzne serwery poczty.
 * Version:     1.0.0
 * Author:      AJK
 * Author URI:  https://example.com
 * License:     GPL2
 * Text Domain: wp-mail-ajk
 */

if (!defined('ABSPATH')) {
    exit; // Blokada bezpośredniego dostępu
}

// Definicja stałej dla ścieżek wtyczki
define('WP_MAIL_AJK_PATH', plugin_dir_path(__FILE__));
define('WP_MAIL_AJK_URL', plugin_dir_url(__FILE__));

// Załadowanie plików
require_once WP_MAIL_AJK_PATH . 'includes/mailer.php';

// Dodanie strony ustawień wtyczki
function wp_mail_ajk_add_admin_menu() {
    add_options_page(
        __('WP Mail AJK Settings', 'wp-mail-ajk'),
        __('WP Mail AJK', 'wp-mail-ajk'),
        'manage_options',
        'wp-mail-ajk',
        'wp_mail_ajk_settings_page'
    );
}
add_action('admin_menu', 'wp_mail_ajk_add_admin_menu');

// Załadowanie pliku ustawień
function wp_mail_ajk_settings_page() {
    require_once WP_MAIL_AJK_PATH . 'admin/settings-page.php';
}

// Rejestracja ustawień
function wp_mail_ajk_register_settings() {
    register_setting('wp_mail_ajk_options_group', 'wp_mail_ajk_settings');
}
add_action('admin_init', 'wp_mail_ajk_register_settings');

// Załadowanie skryptów i stylów z nowej lokalizacji
function wp_mail_ajk_enqueue_admin_scripts($hook) {
    if ($hook !== 'settings_page_wp-mail-ajk') {
        return;
    }
    wp_enqueue_script('wp-mail-ajk-js', WP_MAIL_AJK_URL . 'js/mail-settings.js', ['jquery'], null, true);
    wp_enqueue_style('wp-mail-ajk-css', WP_MAIL_AJK_URL . 'assets/styles.css');
}
add_action('admin_enqueue_scripts', 'wp_mail_ajk_enqueue_admin_scripts');
