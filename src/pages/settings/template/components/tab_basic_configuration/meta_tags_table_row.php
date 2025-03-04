<?php
$is_template        = $ssmt_settings_tab_basic_configuration_meta_tags_table_row_render_config['is_template'] ?? false;
$row_class          = $ssmt_settings_tab_basic_configuration_meta_tags_table_row_render_config['row_class'] ?? 'inactive';
if ($is_template) {
    $row_class = "template {$row_class}";
}
$index              = $ssmt_settings_tab_basic_configuration_meta_tags_table_row_render_config['index'] ?? 0;
$form_data          = $ssmt_settings_tab_basic_configuration_meta_tags_table_row_render_config['form_data'] ?? [];
$meta_types         = ['name', 'property', 'direct'];
$meta_value         = str_replace(["\'", "'", '\"', '\\"', '\\\"', '\\\\"', '\\\\\"'], '"', $form_data['value'] ?? '');;
?>

<tr class="meta-tags-list-row <?php echo esc_attr($row_class); ?>">
    <th scope="row" class="check-column">
        <input type="checkbox" name="checked[]" class="mt-8" <?php if ($is_template): ?>disabled<?php endif; ?> />
    </th>
    <td class="column-order">
        <input class="order-input" type="number" min="-1" max="9999" maxlength="4" size="4" value="<?php echo esc_attr($form_data['order'] ?? '0'); ?>" name="ssmt_basic_configuration_meta_configuration_list[<?php echo esc_attr($index); ?>][order]" <?php if ($is_template): ?>disabled<?php endif; ?> />
    </td>
    <td class="column-type">
        <select class="type-select" name="ssmt_basic_configuration_meta_configuration_list[<?php echo esc_attr($index); ?>][type]" <?php if ($is_template): ?>disabled<?php endif; ?> onChange="metaTypeChange(this);">
            <?php foreach ($meta_types as $single_meta_type): ?>
                <option value="<?php echo esc_attr($single_meta_type); ?>" <?php if (($form_data['type'] ?? '') === $single_meta_type): ?>selected<?php endif; ?>>
                    <?php echo esc_attr(ucfirst($single_meta_type)); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </td>
    <td class="column-key">
        <input class="regular-text key-input w-100" type="text" list="ssmt_meta_key_options" name="ssmt_basic_configuration_meta_configuration_list[<?php echo esc_attr($index); ?>][key]" placeholder="Type or select an option" value="<?php echo esc_attr($form_data['key'] ?? ''); ?>" <?php if ($is_template): ?>disabled<?php endif; ?> />
        <input class="regular-text direct-value-input d-none w-100" type="text" name="ssmt_basic_configuration_meta_configuration_list[<?php echo esc_attr($index); ?>][value]" value='<?php echo esc_attr($meta_value ?? ''); ?>' disabled />
    </td>
    <td class="column-value">
        <input class="regular-text value-input w-100" type="text" name="ssmt_basic_configuration_meta_configuration_list[<?php echo esc_attr($index); ?>][value]" value='<?php echo esc_attr($meta_value ?? ''); ?>' <?php if ($is_template): ?>disabled<?php endif; ?> />
    </td>
    <td class="column-spacer" colspan="2"></td>
    <td class="column-action">
        <p class="delete mt-4 mb-2 text-red cursor-pointer" onclick="deleteRow(this);">
            Delete
        </p>
    </td>
</tr>