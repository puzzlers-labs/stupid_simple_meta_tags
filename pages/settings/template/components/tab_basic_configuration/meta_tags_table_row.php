<?php
$is_template        = $stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render_config['is_template'] ?? false;
$row_class          = $stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render_config['row_class'] ?? 'inactive';
if ($is_template) {
    $row_class = "template {$row_class}";
}
$index              = $stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render_config['index'] ?? 0;
$default_form_data  = ['order' => 0, 'type' => 'text', 'key' => '', 'value' => ''];
$form_data          = $stupid_simple_meta_tags_settings_tab_basic_configuration_meta_tags_table_row_render_config['form_data'] ?? $default_form_data;
$meta_types         = ['name', 'property', 'direct'];
?>

<tr class="meta-tags-list-row <?php echo $row_class; ?>">
    <th scope="row" class="check-column">
        <input type="checkbox" name="checked[]" class="mt-8" <?php if ($is_template): ?>disabled<?php endif; ?> />
    </th>
    <td class="column-order">
        <input class="order-input" type="number" min="-1" max="9999" maxlength="4" size="4" value="<?php echo $form_data['order']; ?>" name="stupid_simple_meta_tags_basic_settings_meta_configuration_list[<?php echo $index; ?>][order]" <?php if ($is_template): ?>disabled<?php endif; ?> />
    </td>
    <td class="column-type">
        <select class="type-select" name="stupid_simple_meta_tags_basic_settings_meta_configuration_list[<?php echo $index; ?>][type]" <?php if ($is_template): ?>disabled<?php endif; ?> onChange="metaTypeChange(this);">
            <?php foreach ($meta_types as $single_meta_type): ?>
                <option value="<?php echo $single_meta_type; ?>" <?php if ($form_data['type'] === $single_meta_type): ?>selected<?php endif; ?>>
                    <?php echo ucfirst($single_meta_type); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </td>
    <td class="column-key">
        <input class="regular-text key-input w-100" type="text" list="stupid_simple_meta_tags_meta_key_options" name="stupid_simple_meta_tags_basic_settings_meta_configuration_list[<?php echo $index; ?>][key]" placeholder="Type or select an option" value="<?php echo $form_data['key']; ?>" <?php if ($is_template): ?>disabled<?php endif; ?> required />
        <input class="regular-text direct-value-input d-none w-100" type="text" name="stupid_simple_meta_tags_basic_settings_meta_configuration_list[<?php echo $index; ?>][value]" value="<?php echo $form_data['value']; ?>" disabled required />
    </td>
    <td class="column-value">
        <input class="regular-text value-input w-100" type="text" name="stupid_simple_meta_tags_basic_settings_meta_configuration_list[<?php echo $index; ?>][value]" value="<?php echo $form_data['value']; ?>" <?php if ($is_template): ?>disabled<?php endif; ?> />
    </td>
    <td class="column-spacer" colspan="2"></td>
    <td class="column-action">
        <p class="delete mt-4 mb-2 text-red cursor-pointer" onclick="deleteRow(this);">
            Delete
        </p>
    </td>
</tr>