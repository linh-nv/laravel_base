let convertFormDataToObject = function (formData) {
    let data = {};
    formData.forEach(function (param) {
        data[param.name] = $.trim(param.value);
    });
    return data;
}
export {
    convertFormDataToObject
}
