let getErrors = function (values, messages, rules) {
    let errors = {};
    for (let key in rules) {
        if (typeof values[key] === 'undefined' && rules[key]['required'] === 'undefined')
            continue;
        let value = values[key];
        let rule = rules[key];
        for (let constraint in rule) {
            if (typeof rule[constraint] !== 'undefined' && rule[constraint](value)) {
                errors[key] =(typeof messages[key] !== 'undefined' && typeof messages[key][constraint] !== 'undefined') ?messages[key][constraint]:`Error message not found for ${constraint}`;
                break;
            }
        }
    }
    return errors;
}
let validate = function (values, messages, rules) {
    let errors = getErrors(values, messages, rules);
    if ($.isEmptyObject(errors)) {
        return {
            invalid: false,
        };
    }
    return {
        invalid: true,
        errors: errors
    }
}
export {
    validate
}
