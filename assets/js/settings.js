const addRow = () => {
    const inputList = document.querySelector('#dynamic-inputs-list');
    const template = document.querySelector('.template');
    const newRow = template.cloneNode(true);
    newRow.classList.remove('template');
    newRow.classList.remove('d-none');
    inputList.appendChild(newRow);
}