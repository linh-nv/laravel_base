let formErrorBinding = function (form, errors, inputClass = 'form-control', errorClass = 'invalid-feedback', inputErrorClass = 'is-invalid', errorForAttribute = 'error-for') {
    resetErrorBlock(form, inputClass, errorClass, inputErrorClass);
    $(form).find(`.${errorClass}`).each(function () {
        if (errors[$(this).attr(errorForAttribute)]) {
            $(this).parent().find(`.${inputClass}`).addClass(inputErrorClass);
            $(this).html(errors[$(this).attr(errorForAttribute)].toString());
            $(this).css('display', 'block');
        }
    });
}
let resetErrorBlock = function (form, inputClass = 'form-control', errorClass = 'invalid-feedback', inputErrorClass = 'is-invalid') {
    form.find(`.${errorClass}`).css('display', 'none');
    form.find(`.${inputClass}`).removeClass(inputErrorClass);
}
let resetForm = function (form) {
    $(form)[0].reset();
}
let handleFormEffect = function (type = 'submit', form, mainIconIdent = ".main-icon-btn", loadingIconIdent = ".fa-spinner") {
    let btn = $(form).find(':submit');
    switch (type) {
        case 'submit':
            resetErrorBlock(form);
            btn.find(loadingIconIdent).removeClass('hidden');
            btn.find(mainIconIdent).addClass('hidden');
            btn.attr("disabled", true);
            break;
        case 'complete':
            btn.find(loadingIconIdent).addClass('hidden');
            btn.find(mainIconIdent).removeClass('hidden');
            btn.attr("disabled", false);
            break;
    }
}
export {
    handleFormEffect,
    resetErrorBlock,
    resetForm,
    formErrorBinding
}
