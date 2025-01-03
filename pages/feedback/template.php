<?php
$meta_configuration_list = $_POST['ssmt_basic_configuration_meta_configuration_list'] ?? get_option('ssmt_basic_configuration_meta_configuration_list', []);
?>
<div class="wrap">
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="https://puzzlers-labs.com" target="_blank">
            <?php if (ssmt_is_licensed()): ?>
                <img src="<?php echo SSMT_PLUGIN_URL . 'assets/images/ssmt_licensed_mini_banner.png'; ?>" alt="Puzzlers Labs Logo" style="max-width: 600px;">
            <?php else: ?>
                <img src="<?php echo SSMT_PLUGIN_URL . 'assets/images/ssmt_mini_banner.png'; ?>" alt="Puzzlers Labs Logo" style="max-width: 600px;">
            <?php endif; ?>
        </a>
    </div>

    <!-- Links Section -->
    <div style="text-align: center; margin-bottom: 30px;">
        <p>
            <!-- <a href="https://example.com/contact" target="_blank">Contact</a> | -->
            <a href="https://example.com/privacy-policy" target="_blank">Privacy Policy</a> |
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
                <td>
                    <?php echo esc_html(SSMT_VERSION); ?>
                    <span style="color: green; margin-left: 5px;">
                        &#10003;
                    </span>
                    <a href="puzzlers-labs.com"><i>(Check for updates)</i></a>
                </td>
            </tr>
            <tr>
                <td><strong>SHA:</strong></td>
                <td>
                    <?php echo esc_html(ssmt_feedback_compute_plugin_sha()); ?>
                    <span style="color: green; margin-left: 5px;">
                        &#10003;
                    </span>
                    <a href="puzzlers-labs.com"><i>(Verify manually)</i></a>
                </td>
            </tr>
            <tr>
                <td><strong>License Status:</strong></td>
                <td>
                    <?php if (ssmt_is_licensed()): ?>
                        <span style="color: green;">
                            Licensed
                        </span>
                        <span style="color: green; margin-left: 5px;">
                            &#10003;
                        </span>
                    <?php else: ?>
                        <span style="color: red;">
                            Unlicensed
                        </span>
                        <span style="color: red; margin-left: 5px;">
                            &times;
                        </span>
                        <a href="puzzlers-labs.com"><i>(Register for free)</i></a>
                    <?php endif; ?>
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

    <!-- <div style="margin-top: 40px;">
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
    </div> -->
</div>