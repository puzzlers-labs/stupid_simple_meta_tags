<div class="wrap">
    <h1>Stupid Simple Meta Tags (SSMT) Settings</h1>
    <h2 class="nav-tab-wrapper">
        <a href="?page=dynamic-inputs-settings&tab=tab1" class="nav-tab nav-tab-active <?php echo $active_tab === 'tab1' ? 'nav-tab-active' : ''; ?>">Basic Configuration</a>
        <a href="?page=dynamic-inputs-settings&tab=tab2" class="nav-tab <?php echo $active_tab === 'tab2' ? 'nav-tab-active' : ''; ?>">Advanced Configuration</a>
    </h2>
    <div class="section-description">
        <p>
            This section allows you to manage and customize the settings for dynamic inputs. You can add, remove, or edit entries as needed, ensuring flexibility and ease of use. Each tab stores its own unique list of inputs, giving you complete control over your configuration.
        </p>
    </div>
    <h1>Dynamic Inputs Settings</h1>
    <form method="post" action="options.php" id="dynamic-inputs-form">
        <?php
        settings_fields('my_plugin_settings_group');
        $inputs = get_option('my_plugin_dynamic_inputs', []);
        ?>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="dynamic-inputs">
                        Inputs
                        <div class="help-icon">
                            <span class="tooltip-text">This is the help text explaining the feature or section.</span>
                            ?
                        </div>
                    </label>
                </th>
                <td>
                    <div id="dynamic-inputs-list">
                        <?php if (!empty($inputs)) : ?>
                            <?php foreach ($inputs as $key => $value) : ?>
                                <div class="dynamic-input-row">
                                    <input
                                        type="text"
                                        name="my_plugin_dynamic_inputs[]"
                                        value="<?php echo esc_attr($value); ?>"
                                        class="regular-text" />
                                    <button type="button" class="button remove-input">Remove</button>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="dynamic-input-row">
                                <input type="text" name="my_plugin_dynamic_inputs[]" class="regular-text" />
                                <button type="button" class="button remove-input">Remove</button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="button" id="add-input" class="button">Add Input</button>
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>