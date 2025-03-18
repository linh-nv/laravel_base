exports.store = (formData) => {
    return (({code, name, recommend_amount, payment_day, liquided_day, description}) => ({
        code,
        name,
        recommend_amount,
        payment_day,
        liquided_day,
        description
    }))(formData);
}
exports.search = (formData) => {
    return (({search_key, status_id}) => ({search_key, status_id}))(formData);
}
