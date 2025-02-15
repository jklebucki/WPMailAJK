<?php
if (!defined('ABSPATH')) {
    exit;
}

// Pobranie aktualnych ustawień
$options = get_option('wp_mail_ajk_settings');

?>
<div class="wrap wp-mail-ajk-settings">
    <h1><?php _e('WP Mail AJK - Email Configuration', 'wp-mail-ajk'); ?></h1>
    <?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']): ?>
        <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible">
            <p><strong><?php _e('Settings saved.', 'wp-mail-ajk'); ?></strong></p>
        </div>
    <?php endif; ?>
    <form method="post" action="options.php">
        <?php 
        settings_fields('wp_mail_ajk_options_group'); 
        do_settings_sections('wp_mail_ajk_options_group');
        ?>
        <table class="form-table">
            <tr>
                <th scope="row"><?php _e('Email Provider', 'wp-mail-ajk'); ?></th>
                <td>
                    <select id="email_provider" name="wp_mail_ajk_settings[email_provider]">
                        <option value="smtp" <?php selected($options['email_provider'], 'smtp'); ?>>SMTP</option>
                        <option value="google" <?php selected($options['email_provider'], 'google'); ?>>Google (OAuth)</option>
                        <option value="exchange" <?php selected($options['email_provider'], 'exchange'); ?>>Microsoft Exchange</option>
                        <option value="exchange_online" <?php selected($options['email_provider'], 'exchange_online'); ?>>Exchange Online</option>
                        <option value="sendgrid" <?php selected($options['email_provider'], 'sendgrid'); ?>>SendGrid</option>
                        <option value="mailgun" <?php selected($options['email_provider'], 'mailgun'); ?>>Mailgun</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php _e('From Email', 'wp-mail-ajk'); ?></th>
                <td><input type="text" name="wp_mail_ajk_settings[from_email]" value="<?php echo esc_attr($options['from_email']); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><?php _e('From Name', 'wp-mail-ajk'); ?></th>
                <td><input type="text" name="wp_mail_ajk_settings[from_name]" value="<?php echo esc_attr($options['from_name']); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><?php _e('Content-Type', 'wp-mail-ajk'); ?></th>
                <td>
                    <select name="wp_mail_ajk_settings[content_type]">
                        <option value="text/plain" <?php selected($options['content_type'], 'text/plain'); ?>><?php _e('Plain Text', 'wp-mail-ajk'); ?></option>
                        <option value="text/html" <?php selected($options['content_type'], 'text/html'); ?>><?php _e('HTML', 'wp-mail-ajk'); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php _e('Charset', 'wp-mail-ajk'); ?></th>
                <td>
                    <select name="wp_mail_ajk_settings[charset]">
                        <option value="UTF-8" <?php selected($options['charset'], 'UTF-8'); ?>>UTF-8</option>
                        <option value="ISO-8859-1" <?php selected($options['charset'], 'ISO-8859-1'); ?>>ISO-8859-1</option>
                    </select>
                </td>
            </tr>

            <tbody id="smtp_settings" class="email-settings">
                <tr>
                    <th><?php _e('SMTP Host', 'wp-mail-ajk'); ?></th>
                    <td><input type="text" name="wp_mail_ajk_settings[smtp_host]" value="<?php echo esc_attr($options['smtp_host']); ?>"></td>
                </tr>
                <tr>
                    <th><?php _e('SMTP Port', 'wp-mail-ajk'); ?></th>
                    <td><input type="text" name="wp_mail_ajk_settings[smtp_port]" value="<?php echo esc_attr($options['smtp_port']); ?>"></td>
                </tr>
                <tr>
                    <th><?php _e('Username', 'wp-mail-ajk'); ?></th>
                    <td><input type="text" name="wp_mail_ajk_settings[smtp_user]" value="<?php echo esc_attr($options['smtp_user']); ?>"></td>
                </tr>
                <tr>
                    <th><?php _e('Password', 'wp-mail-ajk'); ?></th>
                    <td><input type="password" name="wp_mail_ajk_settings[smtp_pass]" value="<?php echo esc_attr($options['smtp_pass']); ?>"></td>
                </tr>
                <tr>
                    <th><?php _e('SMTP Encryption', 'wp-mail-ajk'); ?></th>
                    <td>
                        <select name="wp_mail_ajk_settings[smtp_encryption]">
                            <option value="" <?php selected($options['smtp_encryption'], ''); ?>><?php _e('None', 'wp-mail-ajk'); ?></option>
                            <option value="ssl" <?php selected($options['smtp_encryption'], 'ssl'); ?>>SSL</option>
                            <option value="tls" <?php selected($options['smtp_encryption'], 'tls'); ?>>TLS</option>
                        </select>
                    </td>
                </tr>
            </tbody>

            <tbody id="exchange_settings" class="email-settings">
                <tr>
                    <th><?php _e('Exchange Host', 'wp-mail-ajk'); ?></th>
                    <td><input type="text" name="wp_mail_ajk_settings[exchange_host]" value="<?php echo esc_attr($options['exchange_host']); ?>"></td>
                </tr>
                <tr>
                    <th><?php _e('Exchange Port', 'wp-mail-ajk'); ?></th>
                    <td><input type="text" name="wp_mail_ajk_settings[exchange_port]" value="<?php echo esc_attr($options['exchange_port']); ?>"></td>
                </tr>
                <tr>
                    <th><?php _e('Username', 'wp-mail-ajk'); ?></th>
                    <td><input type="text" name="wp_mail_ajk_settings[exchange_user]" value="<?php echo esc_attr($options['exchange_user']); ?>"></td>
                </tr>
                <tr>
                    <th><?php _e('Password', 'wp-mail-ajk'); ?></th>
                    <td><input type="password" name="wp_mail_ajk_settings[exchange_pass]" value="<?php echo esc_attr($options['exchange_pass']); ?>"></td>
                </tr>
            </tbody>

            <tbody id="exchange_online_settings" class="email-settings">
                <tr>
                    <th><?php _e('Exchange Online Username', 'wp-mail-ajk'); ?></th>
                    <td><input type="text" name="wp_mail_ajk_settings[exchange_online_user]" value="<?php echo esc_attr($options['exchange_online_user']); ?>"></td>
                </tr>
                <tr>
                    <th><?php _e('Exchange Online Password', 'wp-mail-ajk'); ?></th>
                    <td><input type="password" name="wp_mail_ajk_settings[exchange_online_pass]" value="<?php echo esc_attr($options['exchange_online_pass']); ?>"></td>
                </tr>
            </tbody>

            <tbody id="google_settings" class="email-settings">
                <tr>
                    <th><?php _e('Google Username', 'wp-mail-ajk'); ?></th>
                    <td><input type="text" name="wp_mail_ajk_settings[google_user]" value="<?php echo esc_attr($options['google_user']); ?>"></td>
                </tr>
                <tr>
                    <th><?php _e('Google Password', 'wp-mail-ajk'); ?></th>
                    <td><input type="password" name="wp_mail_ajk_settings[google_pass]" value="<?php echo esc_attr($options['google_pass']); ?>"></td>
                </tr>
            </tbody>

            <tbody id="sendgrid_settings" class="email-settings">
                <tr>
                    <th><?php _e('SendGrid API Key', 'wp-mail-ajk'); ?></th>
                    <td><input type="text" name="wp_mail_ajk_settings[sendgrid_api_key]" value="<?php echo esc_attr($options['sendgrid_api_key']); ?>"></td>
                </tr>
            </tbody>

            <tbody id="mailgun_settings" class="email-settings">
                <tr>
                    <th><?php _e('Mailgun Username', 'wp-mail-ajk'); ?></th>
                    <td><input type="text" name="wp_mail_ajk_settings[mailgun_user]" value="<?php echo esc_attr($options['mailgun_user']); ?>"></td>
                </tr>
                <tr>
                    <th><?php _e('Mailgun Password', 'wp-mail-ajk'); ?></th>
                    <td><input type="password" name="wp_mail_ajk_settings[mailgun_pass]" value="<?php echo esc_attr($options['mailgun_pass']); ?>"></td>
                </tr>
            </tbody>

        </table>
        <?php submit_button(__('Save Changes', 'wp-mail-ajk')); ?>
    </form>
</div>