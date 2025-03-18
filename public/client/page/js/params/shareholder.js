exports.store = (formData) => {
    return (({name, phone, email, password}) => ({
        name,
        phone,
        email,
        password,
    }))(formData);
}
exports.search = (formData) => {
    return (({search_key}) => ({search_key}))(formData);
}
