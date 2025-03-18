exports.login = (formData) => {
    formData['g_recaptcha'] = formData['g-recaptcha-response'];
    return (({username, g_recaptcha, password}) => ({username, g_recaptcha, password}))(formData);
}
