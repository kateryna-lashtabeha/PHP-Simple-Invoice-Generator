export function filterProjectInfo(id, targetField, idName1, idName2, fieldName1, fieldName2) {
    if (id) {
        // if the field is not filled - get id to fill it
        let fieldVal1 = $(idName1).val() ? undefined  : idName1;
        let fieldVal2 = $(idName2).val() ? undefined : idName2;

        sendFilteringData(id, targetField, [[fieldName1, fieldVal1], [fieldName2, fieldVal2]], 'app/backend/php_scripts/customer-filter.php');
    }
}

export function filterLabours(idsArr, targetField, fieldName, fieldVal, fn) {
    let isValidIDs = true;
    idsArr.map(el => { if (el === undefined) isValidIDs = false });
    if (isValidIDs) {
        sendFilteringData(idsArr, targetField, [[fieldName, fieldVal]], 'app/backend/php_scripts/labour-filter.php', fn);
    }
}

export function filterTrucks(idsArr, targetField, fieldName, fieldVal, fn) {
    let isValidIDs = true;

    idsArr.map(el => { if (el === undefined) isValidIDs = false });
    if (isValidIDs) {
        sendFilteringData(idsArr, targetField, [[fieldName, fieldVal]], 'app/backend/php_scripts/truck-filter.php', fn);
    }

}

export function sendFilteringData(id, targetField, fieldsArr, path, fn) {
    fieldsArr.map((el) => {
        if (el[1]) {
            $.ajax({
            type: "GET",
            data: {
                'fieldName': el[0],
                [targetField]: id,
            },
            url: path,
            async: true,
            success: function(data) {
                $(el[1]).html(data);
                if (fn) fn();
            }
        });
        }
    })
}