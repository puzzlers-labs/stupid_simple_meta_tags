<?php
$is_template        = $stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render_config['is_template'] ?? false;
$row_class          = $stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render_config['row_class'] ?? 'inactive';
if ($is_template) {
    $row_class = "template {$row_class}";
}
$index              = $stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render_config['index'] ?? 0;
$default_form_data  = ['order' => 0, 'type' => 'text', 'key' => '', 'value' => ''];
$form_data          = $stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render_config['form_data'] ?? $default_form_data;
?>

<tr class="meta-tags-list-row <?php echo $row_class; ?>">
    <th scope="row" class="check-column">
        <input type="checkbox" name="checked[]" class="mt-8" <?php if ($is_template): ?>disabled<?php endif; ?> />
    </th>
    <td class="plugin-title column-primary">
        <input class="order-input" type="number" min="-1" max="9999" maxlength="4" size="4" value="<?php echo $form_data['order']; ?>" name="stupid_simple_meta_tags_basic_settings_meta_configuration_list[<?php echo $index; ?>][order]" <?php if ($is_template): ?>disabled<?php endif; ?> />
    </td>
    <td class="plugin-title column-primary">
        <select class="type-select" name="stupid_simple_meta_tags_basic_settings_meta_configuration_list[<?php echo $index; ?>][type]" <?php if ($is_template): ?>disabled<?php endif; ?>>
            <option value="name" <?php if ($form_data['type'] === 'name'): ?>selected<?php endif; ?>>Name</option>
            <option value="property" <?php if ($form_data['type'] === 'property'): ?>selected<?php endif; ?>>Property</option>
            <option value="direct" <?php if ($form_data['type'] === 'direct'): ?>selected<?php endif; ?>>Direct</option>
        </select>
    </td>
    <td class="column-description desc">
        <input class="regular-text key-input" type="text" list="stupid_simple_meta_tags_meta_key_options" name="stupid_simple_meta_tags_basic_settings_meta_configuration_list[<?php echo $index; ?>][key]" placeholder="Type or select an option" value="<?php echo $form_data['key']; ?>" <?php if ($is_template): ?>disabled<?php endif; ?> />
    </td>
    <td class="column-auto-updates">
        <input class="regular-text value-input" type="text" name="stupid_simple_meta_tags_basic_settings_meta_configuration_list[<?php echo $index; ?>][value]" value="<?php echo $form_data['value']; ?>" <?php if ($is_template): ?>disabled<?php endif; ?> />
    </td>
    <td>
        <p class="delete mt-4 mb-2 text-red cursor-pointer" onclick="deleteRow(this);">
            Delete
        </p>
    </td>
</tr>