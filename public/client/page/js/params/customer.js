exports.store = (formData) => {
    return (({name, phone, address, identify_number}) => ({
        name,
        phone,
        address,
        identify_number,
    }))(formData);
}
exports.search = (formData) => {
    return (({search_key}) => ({search_key}))(formData);
}
