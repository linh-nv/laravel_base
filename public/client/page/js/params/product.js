exports.store = (formData) => {
    return (({name, category_id}) => ({
        name,
        category_id
    }))(formData);
}
exports.search = (formData) => {
    return (({search_key, category_id}) => ({search_key, category_id}))(formData);
}
