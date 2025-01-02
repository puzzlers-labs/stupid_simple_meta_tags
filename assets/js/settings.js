const addRow = () => {
    const inputList = document.querySelector('#dynamic-inputs-list');
    const rowCount  = inputList.children.length;
    const newCount  = rowCount + 1;

    const template = document.querySelector('.template');
    const newRow = template.cloneNode(true);
    newRow.classList.remove('template');
    newRow.classList.remove('d-none');
    newRow.querySelector('.order-input').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${newCount}][order]`;
    newRow.querySelector('.type-select').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${newCount}][type]`;
    newRow.querySelector('.key-input').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${newCount}][key]`;
    newRow.querySelector('.value-input').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${newCount}][value]`;    


    inputList.appendChild(newRow);
}