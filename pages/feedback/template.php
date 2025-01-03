<?php
$meta_configuration_list = $_POST['stupid_simple_meta_tags_basic_settings_meta_configuration_list'] ?? get_option('stupid_simple_meta_tags_basic_settings_meta_configuration_list', []);
?>
<div class="wrap">
    <h1>Developed By:</h1>
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="https://puzzlers-labs.com" target="_blank">
            <img src="<?php echo STUPID_SIMPLE_META_TAGS_PLUGIN_URL . 'assets/images/puzzlers_labs_logo.png'; ?>" alt="Puzzlers Labs Logo" style="max-width: 200px;">
        </a>
    </div>

    <!-- Links Section -->
    <div style="text-align: center; margin-bottom: 30px;">
        <p>
            <a href="https://example.com/contact" target="_blank">Contact</a> |
            <a href="https://example.com/privacy-policy" target="_blank">Privacy Policy</a> |
            <a href="https://github.com/example/repo" target="_blank">GitHub Repository</a>
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
                <td>1.0.0</td>
            </tr>
            <tr>
                <td><strong>SHA:</strong></td>
                <td>
                    <?php echo esc_html(stupid_simple_meta_tags_feedback_compute_plugin_sha()); ?>
                    <span style="color: green; margin-left: 5px;">
                        &#10003;
                    </span>
                </td>
            </tr>
            <tr>
                <td><strong>License Status:</strong></td>
                <td>
                    <?php echo esc_html(get_option('my_plugin_license_status', 'Inactive')); ?>
                    <span style="color: red; margin-left: 5px;">
                        &times;
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Rating Form -->
    <div style="margin-top: 40px;">
        <h2>Rate This Plugin</h2>
        <form method="post" action="">
            <?php wp_nonce_field('plugin_feedback_nonce', '_wpnonce'); ?>
            <table class="form-table">
                <tr>
                    <th><label for="rating">Your Rating:</label></th>
                    <td>
                        <select name="rating" id="rating" required>
                            <option value="">Select Rating</option>
                            <option value="5">★★★★★ (5 - Excellent)</option>
                            <option value="4">★★★★☆ (4 - Very Good)</option>
                            <option value="3">★★★☆☆ (3 - Good)</option>
                            <option value="2">★★☆☆☆ (2 - Fair)</option>
                            <option value="1">★☆☆☆☆ (1 - Poor)</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="feedback">Your Feedback:</label></th>
                    <td>
                        <textarea name="feedback" id="feedback" rows="5" cols="50" placeholder="Share your thoughts about the plugin..."></textarea>
                    </td>
                </tr>
            </table>
            <p>
                <button type="submit" class="button button-primary">Submit Feedback</button>
            </p>
        </form>
    </div>
</div>