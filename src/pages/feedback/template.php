<?php
if (!defined('ABSPATH')) exit;

$plugins_page_url = admin_url('plugins.php');
?>
<div class="wrap">
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="https://ssmt.app" target="_blank">
            <img src="<?php echo esc_url(SSMT_PLUGIN_URL . 'assets/images/ssmt_mini_banner.png'); ?>" alt="Puzzlers Labs Logo" style="max-width: 600px;">
        </a>
    </div>

    <!-- Links Section -->
    <div style="text-align: center; margin-bottom: 30px;">
        <p>
            <a href="mailto:hello@ssmt.app">Contact</a> |
            <a href="https://ssmt.app/privacy-policy" target="_blank">Privacy Policy</a> |
            <a href="https://ssmt.app/terms-and-conditions" target="_blank">Terms and Conditions</a> |
            <a href="https://github.com/puzzlers-labs/stupid_simple_meta_tags" target="_blank">GitHub Repository</a>
        </p>
    </div>

    <!-- Technical Information -->
    <table class="widefat striped">
        <thead>
            <tr>
                <th colspan="2">Technical Information</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Plugin Version:</strong></td>
                <td><?php echo esc_html(SSMT_VERSION); ?></td>
            </tr>
            <tr>
                <td><strong>License Status:</strong></td>
                <td>
                    <span style="color: green;">Active (Free)</span>
                    <span style="color: green; margin-left: 5px;">&#10003;</span>
                </td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 40px;">
        <h2>Contact</h2>
        <p>
            You can contact us at <a href="mailto:hello@puzzlers-labs.com">Puzzlers Labs</a> for any queries or feedback.
            <br />
            Please share the technical information above when contacting us for a faster response.
        </p>
        <p>
            Alternatively, you can also raise an issue on the <a href="https://github.com/puzzlers-labs/stupid_simple_meta_tags" target="_blank">GitHub Repository</a>.
        </p>
    </div>
</div>