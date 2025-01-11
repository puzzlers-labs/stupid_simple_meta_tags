<?php
$meta_configuration_list = $_POST['ssmt_basic_configuration_meta_configuration_list'] ?? get_option('ssmt_basic_configuration_meta_configuration_list', []);
$current_page_url = 'admin.php?page=ssmt_settings_feedback';
$current_page_url = urlencode($current_page_url);
$plugins_page_url = admin_url('plugins.php');
$public_sha       = get_sha_for_version('v' . SSMT_VERSION);
$current_sha      = ssmt_feedback_compute_plugin_sha();
?>
<div class="wrap">
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="https://ssmt.app" target="_blank">
            <img src="<?php echo SSMT_PLUGIN_URL . 'assets/images/ssmt_mini_banner.png'; ?>" alt="Puzzlers Labs Logo" style="max-width: 600px;">
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
                <td>
                    <?php echo esc_html(SSMT_VERSION); ?>
                    <span class="loader-container d-none" id=license-status>
                        &emsp;
                        <div class="loader" title="0">
                            <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="20px" height="20px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
                                <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
                    s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
                    c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z" />
                                <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
                    C22.32,8.481,24.301,9.057,26.013,10.047z">
                                    <animateTransform attributeType="xml"
                                        attributeName="transform"
                                        type="rotate"
                                        from="0 20 20"
                                        to="360 20 20"
                                        dur="0.75s"
                                        repeatCount="indefinite" />
                                </path>
                            </svg>
                        </div>
                    </span>
                    <span id="update-available-status-container" style="margin-left: 5px;">
                        <span id="update-available" class="d-none">
                            <span style="color: red;">
                                &times;
                            </span>
                            <a href="<?php echo $plugins_page_url; ?>">Update available</a>
                        </span>
                        <span id="update-not-available" class="d-none">
                            <span style="color: green;">
                                &#10003;
                            </span>
                            <span>(You have the latest version)</span>
                        </span>
                        
                        <a href="#" id="update-check" onClick="checkVersionUpdate();"><i>(Check again)</i></a>    
                    </span>
                </td>
            </tr>
            <tr>
                <td><strong>SHA:</strong></td>
                <td>
                    <?php echo esc_html($current_sha); ?>
                    <?php if ($current_sha === $public_sha) : ?>
                        <span style="color: green; margin-left: 5px;">
                            &#10003;
                        </span>
                    <?php else: ?>
                        <span style="color: red; margin-left: 5px;">
                            &times;
                        </span>
                    <?php endif; ?>
                    <a href="https://raw.githubusercontent.com/puzzlers-labs/stupid_simple_meta_tags/refs/heads/main/checksums.txt" target="_blank"><i>(Verify manually)</i></a>
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
                        <a href="<?php echo esc_url(admin_url('admin.php?page=ssmt_register_license&return_url=' . $current_page_url)); ?>"><i>(Register for free)</i></a>
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