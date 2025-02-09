<?php
if (!defined('ABSPATH')) {
    exit;
}

// Modyfikacja funkcji wp_mail()
function wp_mail_ajk_mailer($phpmailer) {
    $options = get_option('wp_mail_ajk_settings');

    // Logowanie konfiguracji mailera
    wp_mail_ajk_log('Configuring mailer for provider: ' . $options['email_provider']);

    try {
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
        } elseif ($options['email_provider'] === 'google') {
            $phpmailer->Host = 'smtp.gmail.com';
            $phpmailer->Port = 587;
            $phpmailer->Username = $options['google_user'];
            $phpmailer->Password = $options['google_pass'];
            $phpmailer->SMTPSecure = 'tls';
            $phpmailer->SMTPAuth = true;
        } elseif ($options['email_provider'] === 'sendgrid') {
            $phpmailer->isSMTP();
            $phpmailer->Host = 'smtp.sendgrid.net';
            $phpmailer->Port = 587;
            $phpmailer->SMTPAuth = true;
            $phpmailer->Username = 'apikey';
            $phpmailer->Password = $options['sendgrid_api_key'];
            $phpmailer->SMTPSecure = 'tls';
        } elseif ($options['email_provider'] === 'mailgun') {
            $phpmailer->isSMTP();
            $phpmailer->Host = 'smtp.mailgun.org';
            $phpmailer->Port = 587;
            $phpmailer->SMTPAuth = true;
            $phpmailer->Username = $options['mailgun_user'];
            $phpmailer->Password = $options['mailgun_pass'];
            $phpmailer->SMTPSecure = 'tls';
        }
    } catch (Exception $e) {
        wp_mail_ajk_log('Error configuring mailer: ' . $e->getMessage());
    }
}

add_action('phpmailer_init', 'wp_mail_ajk_mailer');
