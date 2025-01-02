jQuery(document).ready(function ($) {
    const inputList = $('#dynamic-inputs-list');

    $('#add-input').on('click', function () {
        const newRow = `
            <div class="dynamic-input-row">
                <input type="text" name="my_plugin_dynamic_inputs[]" class="regular-text" />
                <button type="button" class="button remove-input">Remove</button>
            </div>`;
        inputList.append(newRow);
    });

    inputList.on('click', '.remove-input', function () {
        $(this).closest('.dynamic-input-row').remove();
    });
});