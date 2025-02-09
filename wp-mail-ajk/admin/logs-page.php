<?php
if (!defined('ABSPATH')) {
    exit;
}

$log_file = WP_MAIL_AJK_PATH . 'logs/mail.log';
$logs = file_exists($log_file) ? file_get_contents($log_file) : __('No logs available.', 'wp-mail-ajk');

?>
<div class="wrap wp-mail-ajk-settings">
    <h1><?php _e('WP Mail AJK - Logs', 'wp-mail-ajk'); ?></h1>
    <pre><?php echo esc_html($logs); ?></pre>
</div>
