exports.store = (formData) => {
    return (({name}) => ({
        name,
    }))(formData);
}
exports.search = (formData) => {
    return (({search_key}) => ({search_key}))(formData);
}
