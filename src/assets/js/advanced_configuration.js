const addRow = (namePrefix) => {
  const inputList = document.querySelector("#dynamic-inputs-list");
  const rowCount = inputList.children.length;
  const newRowIndex = rowCount + 1;

  const template = document.querySelector(".template");
  const newRow = template.cloneNode(true);
  newRow.classList.remove("template");
  newRow.classList.remove("d-none");
  newRow.querySelector(
    ".order-input"
  ).name = `ssmt_basic_configuration_meta_configuration_list[${newRowIndex}][order]`;
  newRow.querySelector(
    ".type-select"
  ).name = `ssmt_basic_configuration_meta_configuration_list[${newRowIndex}][type]`;
  newRow.querySelector(
    ".key-input"
  ).name = `ssmt_basic_configuration_meta_configuration_list[${newRowIndex}][key]`;
  newRow.querySelector(
    ".value-input"
  ).name = `ssmt_basic_configuration_meta_configuration_list[${newRowIndex}][value]`;
  newRow.querySelector(
    ".direct-value-input"
  ).name = `ssmt_basic_configuration_meta_configuration_list[${newRowIndex}][value]`;

  newRow.querySelector(".order-input").removeAttribute("disabled");
  newRow.querySelector(".type-select").removeAttribute("disabled");
  newRow.querySelector(".key-input").removeAttribute("disabled");
  newRow.querySelector(".value-input").removeAttribute("disabled");

  inputList.appendChild(newRow);

  metaTypeChange(newRow.querySelector(".type-select"));
  updateTotalCount();
};

const deleteRow = (element) => {
  const row = element.closest(".meta-tags-list-row");
  row.remove();
  reIndexRows();
  updateTotalCount();
};

const reIndexRows = () => {
  const inputList = document.querySelector(
    "#dynamic-inputs-list:not(.template)"
  );
  const rows = inputList.children;
  for (let i = 1; i < rows.length; i++) {
    const row = rows[i];
    row.querySelector(
      ".order-input"
    ).name = `ssmt_basic_configuration_meta_configuration_list[${i}][order]`;
    row.querySelector(
      ".type-select"
    ).name = `ssmt_basic_configuration_meta_configuration_list[${i}][type]`;
    row.querySelector(
      ".key-input"
    ).name = `ssmt_basic_configuration_meta_configuration_list[${i}][key]`;
    row.querySelector(
      ".value-input"
    ).name = `ssmt_basic_configuration_meta_configuration_list[${i}][value]`;
    row.querySelector(
      ".direct-value-input"
    ).name = `ssmt_basic_configuration_meta_configuration_list[${i}][value]`;
  }
};

const updateTotalCount = () => {
  const inputList = document.querySelector("#dynamic-inputs-list");

  const rowCount = inputList.children.length;
  document
    .querySelectorAll(".displaying-num > .total-row-count")
    .forEach((element) => {
      element.innerText = rowCount - 1;
    });
};

const metaTypeChange = (element) => {
  const row = element.closest(".meta-tags-list-row");

  const keyInput = row.querySelector(".key-input");
  const valueInput = row.querySelector(".value-input");
  const directValueInput = row.querySelector(".direct-value-input");

  const keyDataCell = row.querySelector(".column-key");
  const valueDataCell = row.querySelector(".column-value");
  const spacerDataCell = row.querySelector(".column-spacer");
  if (element.value === "direct") {
    keyInput.setAttribute("disabled", "disabled");
    keyInput.setAttribute("required", false);
    keyInput.classList.add("d-none");

    valueInput.setAttribute("disabled", "disabled");
    valueInput.classList.add("d-none");

    directValueInput.setAttribute("required", "required");
    directValueInput.removeAttribute("disabled");
    directValueInput.classList.remove("d-none");

    keyDataCell.setAttribute("colSpan", "2");
    valueDataCell.width = "0px";
    spacerDataCell.setAttribute("colSpan", "1");
  } else {
    keyInput.setAttribute("required", "required");
    keyInput.removeAttribute("disabled");
    keyInput.classList.remove("d-none");

    valueInput.removeAttribute("disabled");
    valueInput.classList.remove("d-none");

    directValueInput.setAttribute("disabled", "disabled");
    directValueInput.setAttribute("required", false);
    directValueInput.classList.add("d-none");

    keyDataCell.setAttribute("colSpan", "1");
    valueDataCell.width = "initial";
    spacerDataCell.setAttribute("colSpan", "2");
  }
};

const init = () => {
  const typeSelects = document.querySelectorAll(".type-select");
  typeSelects.forEach((element, idx) => {
    if (idx === 0) {
      return;
    }
    metaTypeChange(element);
  });
};

window.onload = init;
