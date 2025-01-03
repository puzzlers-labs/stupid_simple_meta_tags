<div class="alignleft actions bulkactions">
    <label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
    <select name="select-action" id="bulk-action-selector-bottom">
        <option value="-1">Bulk actions</option>
        <option value="hide-selected">Hide</option>
        <option value="show-selected">Show</option>
        <option value="delete-selected">Delete</option>
    </select>
    <input type="button" name="bulk_action" id="doaction" class="button action" value="Apply">
    <button type="button" id="add-input" onclick="addRow();" class="button">Add Row</button>
</div>