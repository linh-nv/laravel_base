exports.store = (formData) => {
    return (({name, invoice_type_id, user_id, amount, date, description}) => ({
        name,
        invoice_type_id,
        user_id,
        amount,
        date,
        description,
    }))(formData);
}
exports.search = (formData) => {
    return (({search_key, invoice_type_id, user_id, status_id, time_from, time_to}) => ({search_key, invoice_type_id, user_id, status_id, time_from, time_to}))(formData);
}
