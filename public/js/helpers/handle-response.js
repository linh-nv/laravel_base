import * as handleFormEffect from './handle-form-effect';
import trans from './messages';
/*{formErrorBinding, resetErrorBlock, handleFormEffect.resetForm}*/
let exceptionResponse = function (data, form, isResetForm = true, handleFn = function (response) {
    return alert(response.message);
}, inputClass = 'form-control', errorClass = 'invalid-feedback', inputErrorClass = 'is-invalid') {
    let status = data.status;
    let response = data.responseJSON;
    handleFormEffect.resetErrorBlock(form, inputClass);
    switch (parseInt(status)) {
        case 422:
            handleFormEffect.formErrorBinding(form, response.errors);
            break;
        case 401:
        case 403:
            handleFormEffect.resetForm(form, isResetForm);
            handleFn(response, function () {
                redirect(response.redirect);
            });
            break;
        case 419:
            response.message = trans.server.token_expired;
            handleFn(response, function () {
                location.reload(true);
            });
            break;
        case 500:
        default:
            handleFormEffect.resetForm(form, isResetForm);
            response.error_title = trans.server.bug;
            handleFn(response);
            break;
    }
}

let successResponse = function (response, form, handleFn = function (response) {
    alert(response.message);
}) {
    if (response) {
        handleFn(response,);
    }
}

let redirect = function (href) {
    location.href = href;
}


let exceptionBtnActionClick = function (data, handleFn = function (response) {
    return alert(response.message);
}) {
    let status = parseInt(data.status);
    let response = data.responseJSON;
    switch (status) {
        case 401:
        case 403:
            handleFn(response, function () {
                redirect(response.redirect)
            });
            break;
        case 419:
            response.message = trans.server.token_expired;
            handleFn(response, function () {
                location.reload(true);
            });

            break;
        case 500:
        case 422:
        case 400:
        default:
            handleFn(response);
            break;
    }
}

let successBtnActionClick = function (response, handleFn = function (response) {
    alert(response.message);
}) {
    handleFn(response);
}

export {
    successBtnActionClick,
    exceptionBtnActionClick,
    redirect,
    successResponse,
    exceptionResponse,
}
