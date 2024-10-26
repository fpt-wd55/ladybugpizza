const tableCheckboxItem = (checkboxAllId, checkboxItemClass) => {
    const checkboxTableAll = document.getElementById(checkboxAllId);
    const checkboxTableItem = document.querySelectorAll(
        `.${checkboxItemClass}`
    );
    const selectedItems = document.querySelector("#selectedItems");

    const updateSelectedItems = () => {
        const checkedItems = document.querySelectorAll(
            ".table-item-checkbox:checked"
        ).length;
        selectedItems.textContent = checkedItems
            ? `${checkedItems} mục được chọn`
            : "";
        checkboxTableAll.checked = checkedItems === checkboxTableItem.length;
    };

    checkboxTableAll.addEventListener("change", function () {
        checkboxTableItem.forEach((checkbox) => {
            checkbox.checked = checkboxTableAll.checked;
        });
        updateSelectedItems();
    });

    checkboxTableItem.forEach((checkbox) => {
        checkbox.addEventListener("change", updateSelectedItems);
    });
};

export default { tableCheckboxItem };
