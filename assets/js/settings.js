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

const deleteRow = (element) => {
    const row = element.closest('.meta-tags-list-row');
    row.remove();
    reIndexRows();
}

const reIndexRows = () => {
    const inputList = document.querySelector('#dynamic-inputs-list');
    const rows = inputList.children;
    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        row.querySelector('.order-input').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${i}][order]`;
        row.querySelector('.type-select').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${i}][type]`;
        row.querySelector('.key-input').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${i}][key]`;
        row.querySelector('.value-input').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${i}][value]`;
    }
}