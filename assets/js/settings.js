const addRow = () => {
    const inputList = document.querySelector('#dynamic-inputs-list');
    const rowCount = inputList.children.length;
    const newRowIndex  = rowCount + 1;

    const template = document.querySelector('.template');
    const newRow = template.cloneNode(true);
    newRow.classList.remove('template');
    newRow.classList.remove('d-none');
    newRow.querySelector('.order-input').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${newRowIndex}][order]`;
    newRow.querySelector('.type-select').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${newRowIndex}][type]`;
    newRow.querySelector('.key-input').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${newRowIndex}][key]`;
    newRow.querySelector('.value-input').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${newRowIndex}][value]`;    

    newRow.querySelector('.order-input').removeAttribute('disabled');
    newRow.querySelector('.type-select').removeAttribute('disabled');
    newRow.querySelector('.key-input').removeAttribute('disabled');
    newRow.querySelector('.value-input').removeAttribute('disabled');

    inputList.appendChild(newRow);
    updateTotalCount();
}

const deleteRow = (element) => {
    const row = element.closest('.meta-tags-list-row');
    row.remove();
    reIndexRows();
    updateTotalCount();
}

const reIndexRows = () => {
    const inputList = document.querySelector('#dynamic-inputs-list:not(.template)');
    const rows = inputList.children;
    for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
        row.querySelector('.order-input').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${i}][order]`;
        row.querySelector('.type-select').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${i}][type]`;
        row.querySelector('.key-input').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${i}][key]`;
        row.querySelector('.value-input').name = `stupid_simple_meta_tags_basic_settings_meta_configuration_list[${i}][value]`;
    }
}

const updateTotalCount = () => {
    const inputList = document.querySelector('#dynamic-inputs-list');

    const rowCount = inputList.children.length;
    document.querySelectorAll('.displaying-num > .total-row-count').forEach((element) => {
        element.innerText = rowCount - 1;
    });
}