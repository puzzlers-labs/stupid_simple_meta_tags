<?php
$row_class          = $stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render_config['row_class'] ?? 'inactive';
$index              = $stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render_config['index'] ?? 0;
$default_form_data  = ['order' => 0, 'type'  => 'text', 'key'   => '', 'value' => ''];
$form_data          = $stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render_config['form_data'] ?? $default_form_data;
?>

<tr class="<?php echo $row_class; ?>">
    <th scope="row" class="check-column">
        <input type="checkbox" name="checked[]" class="mt-8" />
    </th>
    <td class="plugin-title column-primary">
        <input class="order-input" type="number" min="0" max="9999" maxlength="4" size="4" value="<?php echo $form_data['order']; ?>" name="stupid_simple_meta_tags_basic_settings_meta_configuration_list[<?php echo $index; ?>][order]" />
    </td>
    <td class="plugin-title column-primary">
        <select class="type-select" name="stupid_simple_meta_tags_basic_settings_meta_configuration_list[<?php echo $index; ?>][type]">
            <option value=" text">Name</option>
            <option value="textarea">Property</option>
        </select>
    </td>
    <td class="column-description desc">
        <input class="regular-text key-input" type="text" list="stupid_simple_meta_tags_basic_settings_meta_configuration_list" name="stupid_simple_meta_tags_basic_settings_meta_configuration_list[<?php echo $index; ?>][key]" placeholder="Type or select an option" value="<?php echo $form_data['key']; ?>" />
    </td>
    <td class="column-auto-updates">
        <input class="regular-text value-input" type="text" name="stupid_simple_meta_tags_basic_settings_meta_configuration_list[<?php echo $index; ?>][value]" value="<?php echo $form_data['value']; ?>" />
    </td>
    <td>
        <p class="mt-4 mb-2"><a href="plugins.php?action=delete-selected&amp;checked%5B0%5D=hello.php&amp;plugin_status=all&amp;paged=1&amp;s&amp;_wpnonce=6ee8644c54" id="delete-hello-dolly" class="delete">
                Delete
            </a></p>
    </td>
</tr>