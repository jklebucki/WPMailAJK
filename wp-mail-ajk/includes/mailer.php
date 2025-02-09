<?php
if (!defined('ABSPATH')) {
    exit;
}

// Modyfikacja funkcji wp_mail()
function wp_mail_ajk_mailer($phpmailer) {
    $options = get_option('wp_mail_ajk_settings');

    if ($options['email_provider'] === 'smtp') {
        $phpmailer->isSMTP();
        $phpmailer->Host = $options['smtp_host'];
        $phpmailer->Port = $options['smtp_port'];
        $phpmailer->SMTPAuth = true;
        $phpmailer->Username = $options['smtp_user'];
        $phpmailer->Password = $options['smtp_pass'];
        
        // Obsługa różnych opcji szyfrowania
        if (!empty($options['smtp_encryption'])) {
            $phpmailer->SMTPSecure = $options['smtp_encryption'];
        } else {
            $phpmailer->SMTPSecure = '';
        }
    } elseif ($options['email_provider'] === 'exchange') {
        $phpmailer->Host = $options['exchange_host'];
        $phpmailer->Port = $options['exchange_port'];
        $phpmailer->Username = $options['exchange_user'];
        $phpmailer->Password = $options['exchange_pass'];
        $phpmailer->SMTPSecure = 'tls';
        $phpmailer->SMTPAuth = true;
    } elseif ($options['email_provider'] === 'exchange_online') {
        $phpmailer->Host = 'smtp.office365.com';
        $phpmailer->Port = 587;
        $phpmailer->Username = $options['exchange_online_user'];
        $phpmailer->Password = $options['exchange_online_pass'];
        $phpmailer->SMTPSecure = 'tls';
        $phpmailer->SMTPAuth = true;
    }
}

add_action('phpmailer_init', 'wp_mail_ajk_mailer');
