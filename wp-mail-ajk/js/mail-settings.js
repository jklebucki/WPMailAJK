jQuery(document).ready(function($) {
    function toggleSettings() {
        $('.email-settings').hide();
        let selectedProvider = $('#email_provider').val();
        if (selectedProvider === 'smtp') {
            $('#smtp_settings').show();
        } else if (selectedProvider === 'exchange') {
            $('#exchange_settings').show();
        } else if (selectedProvider === 'exchange_online') {
            $('#exchange_online_settings').show();
        } else if (selectedProvider === 'google') {
            $('#google_settings').show();
        } else if (selectedProvider === 'sendgrid') {
            $('#sendgrid_settings').show();
        } else if (selectedProvider === 'mailgun') {
            $('#mailgun_settings').show();
        }
    }
    
    $('#email_provider').on('change', toggleSettings);
    toggleSettings();
});
