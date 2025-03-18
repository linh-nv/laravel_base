exports.store = (formData) => {
    formData['role'] = formData['role'];
    formData['status_id'] = formData['status'];
    return (({name, phone, email, password, role, status_id}) => ({
        name,
        phone,
        email,
        password,
        role,
        status_id
    }))(formData);
}
exports.update_password = (formData) => {
    return (({old_password, new_password, re_new_password}) => ({
        old_password,
        new_password,
        re_new_password
    }))(formData);
}
exports.search = (formData) => {
    formData['role'] = formData['role'];
    formData['status_id'] = formData['status'];
    return (({role, status_id, search_key}) => ({role, status_id, search_key}))(formData);
}
