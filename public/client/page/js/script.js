import 'bootstrap';
import 'bootstrap-datepicker';
import 'select2';
import 'jquery-autocomplete';
import * as convert from '../../../js/helpers/convert';
import * as validator from './validates'
import * as params from './params'
import * as handleResponse from '../../../js/helpers/handle-response';
import * as formEffect from '../../../js/helpers/handle-form-effect';
import * as handleFormEffect from '../../../js/helpers/handle-form-effect';
import _msg from '../../../js/helpers/show-message';
import trans from '../../../js/helpers/messages';
import * as format from '../../../js/helpers/format';

(function () {
    'use strict';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})();
let months = $(".list-month").find(".month-item");
$(document).on("click", ".list-month .month-item", function(month) {
    month.preventDefault();
    months.find(".month-item-text").removeClass("active");
    let form = $(this).closest('form');
    let monthValue =$(this).find('.month-item-text').data('month');
    form.find('input[name=month]').val(monthValue);
    $(this).find(".month-item-text").addClass("active");
});
$(document).ready(function () {
    initDatepicker();
    initSelect2();
});

function initDatepicker() {
    $('.datepicker').datetimepicker(
        {
            locale: 'vi',
            format: 'DD/MM/YYYY'
        }
    );
    $('.datetimepicker').datetimepicker(
        {
            locale: 'vi',
            format: 'HH:mm:ss DD-MM-YYYY'
        }
    );
}

function initSelect2() {
    $('.js-select-search').select2({
        language: trans.select2,
        allowClear: true
    });
    $('.js-select-search .allow-tags').select2({
        language: trans.select2,
        tags: true,
        createTag: function (params) {
            return {id: "new", text: params.term}
        }
    });
    $('.js-select-search-dynamic').select2({
        language: trans.select2,
        ajax: {
            url: function () {
                return $(this).attr('url');
            },
            dataType: 'json',
            delay: 1000,
            data: function (params) {
                let query = $(this).data();
                delete query['placeholder']
                delete query['allowClear']
                delete query['select2Id']
                delete query['select2']
                query.search = params.term
                return query;
            }, processResults: function (data) {
                return {
                    results: data.items
                };
            }
        }
    });
}

$(document).on('click', '.pagination a', function (event) {
    event.preventDefault();
    let url = $(this).attr('href');
    let container = $(this).attr('to');
    getHtml(url, container);
    window.history.pushState({
        path: url
    }, '', url)
});

function getHtml(url, container) {
    $.ajax({
        async: true,
        url: url,
        success: function (data) {
            $(container).html(data.data);
            initSelect2()
            initDatepicker()
        },
        error: function (data) {
            alert(data.responseJSON.message);
        }
    });
}

$("#js_login_form").on('submit', function (e) {
    e.preventDefault();
    let form = $(this);
    let formData = convert.convertFormDataToObject(form.serializeArray());
    let validate = form.attr("validate");
    let module = form.data("module");
    let action = form.data("action");
    let data = params[module][action](formData);
    if (validate) {
        let validated = validator[module][action](data);
        if (validated.invalid) {
            formEffect.formErrorBinding(form, validated.errors);
            return;
        }
    }
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        data: data,
        beforeSend: function () {
            formEffect.handleFormEffect('submit', form);
        },
        complete: function () {
            formEffect.handleFormEffect('complete', form);
        },
        success: function (response) {
            handleResponse.successResponse(response, form, function (response) {
                response.status ? _msg.alert(trans.login.success, response.message, function () {
                    _msg.success(trans.login.redirect);
                    handleResponse.redirect(response.redirect);
                }) : _msg.alert(trans.login.fail, response.message,);
            });
            grecaptcha.reset();
        },
        error: function (response) {
            handleResponse.exceptionResponse(response, form, true, function (response, moreAction = false) {
                if (moreAction) {
                    _msg.alert(response.message, moreAction);
                } else {
                    _msg.alert(response.message);
                }
            });
            grecaptcha.reset();

        }
    })
});
$('.js-edit-modal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let formData = button.data()
    let modal = $(this)
    if (formData !== undefined) {
        getHtml(formData.action, `#${modal.find('.modal-content').attr('id')}`)
    }
})
$('#js_edit_password_modal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let formData = button.data()
    let modal = $(this)
    let form = modal.find('form')
    form.attr('action', formData.action)
    form.find('.js-username').html(formData.username)
})
$(document).on("click", ".js-btn-export-action", function () {
    window.location = $(this).data('href');
});

$('.js-add-modal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let modal = $(this)
    let form = modal.find('form')
    form.attr('action', button.data('form-action'))
    form.attr('method', button.data('form-method'))
    form.attr('class', button.data('form-class'))

})
$('.js-add-modal').on('hidden.bs.modal', function (e) {
    handleFormEffect.resetErrorBlock($(this).find('form'));
})
$(document).on("submit", ".js-search-form", function (e) {
    e.preventDefault();
    let form = $(this);
    let formData = convert.convertFormDataToObject(form.serializeArray());
    let validate = form.attr("validate");
    let module = form.data("module");
    let url = form.attr('action')
    let action = form.data("action");
    let data = params[module][action](formData);
    if (validate) {
        let validated = validator[module][action](data);
        if (validated.invalid) {
            formEffect.formErrorBinding(form, validated.errors);
            return;
        }
    }
    let formParams = Object.keys(data).map(key => `${key}=${data[key]}`);
    let urlParamString = formParams.join('&');
    $.ajax({
        url: url,
        type: form.attr('method'),
        dataType: 'json',
        data: data,
        beforeSend: function () {
            formEffect.handleFormEffect('submit', form);
        },
        complete: function (jqXHR, status) {
            formEffect.handleFormEffect('complete', form);
        },
        success: function (data) {
            window.history.pushState({
                path: `${url}?${urlParamString}`
            }, '', `${url}?${urlParamString}`)
            handleResponse.successResponse(data, form, function () {
                $(form.data('container')).html(data.data);
            });
        },
        error: function (data) {
            handleResponse.exceptionResponse(data, form, true, function (data, execute = function () {
            }) {
                _msg.alert(data.error_title, data.message, function () {
                    execute();
                })
            });
        }
    })
});

function appendAttachedProducts(formData) {
    let attachedProducts = []
    $.each($('.js-attached-product-element'), function (index, val) {
        let errorMessageBox = $(this).find('.invalid-feedback')
        $.each(errorMessageBox, function () {
            let errorModule = $(this).attr('error-module')
            let errorField = $(this).attr('error-field')
            $(this).attr('error-for', `${errorModule}.${index}.${errorField}`)
        })
        let attachedProductName = $(this).find('input[name=attached_product_name]').val();
        let attachedProductDescription = $(this).find('input[name=attached_product_description]').val();
        console.log(attachedProductName)
        let attachedProduct = {
            name: attachedProductName,
            description: attachedProductDescription
        }
        attachedProducts.push(attachedProduct)
        /* iterate through array or object */
    });
    formData.attached_products = attachedProducts;
    return formData
}

$(document).on("submit", ".js-store-form", function (e) {
    e.preventDefault();
    let form = $(this);
    let validate = form.attr("validate");
    let module = form.data("module");
    let action = form.data("action");
    //let resetForm = form.data("search-form")
    let formData = convert.convertFormDataToObject(form.serializeArray());
    if (module === 'pawn_receipt') {
        formData = appendAttachedProducts(formData);
    }
    let data = params[module][action](formData);
    if (validate) {
        let validated = validator[module][action](data);
        if (validated.invalid) {
            formEffect.formErrorBinding(form, validated.errors);
            return;
        }
    }
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        data: data,
        beforeSend: function () {
            formEffect.handleFormEffect('submit', form);
        },
        complete: function () {
            formEffect.handleFormEffect('complete', form);
        },
        success: function (response) {
            handleResponse.successResponse(response, form, function (response) {
                beforeStoreHandler(response, form)
                form[0].reset();
            });
        },
        error: function (response) {
            handleResponse.exceptionResponse(response, form, true, function (response) {
                _msg.alert(response.message);
            });
        }
    })
});
$(document).on("submit", ".js-update-form", function (e) {
    e.preventDefault();
    let form = $(this);
    let formData = convert.convertFormDataToObject(form.serializeArray());
    let validate = form.attr("validate");
    let module = form.data("module");
    let action = form.data("action");
    let data = params[module][action](formData);
    if (validate) {
        let validated = validator[module][action](data);
        if (validated.invalid) {
            formEffect.formErrorBinding(form, validated.errors);
            return;
        }
    }
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        data: data,
        beforeSend: function () {
            formEffect.handleFormEffect('submit', form);
        },
        complete: function () {
            formEffect.handleFormEffect('complete', form);
        },
        success: function (response) {
            handleResponse.successResponse(response, form, function (response) {
                beforeStoreHandler(response, form)
            });
        },
        error: function (response) {
            handleResponse.exceptionResponse(response, form, true, function (response) {
                _msg.alert(response.message);
            });
        }
    })
});
$(document).on("submit", ".js-update-password-form", function (e) {
    e.preventDefault();
    let form = $(this);
    let formData = convert.convertFormDataToObject(form.serializeArray());
    let validate = form.attr("validate");
    let module = form.data("module");
    let action = form.data("action");
    let data = params[module][action](formData);
    if (validate) {
        let validated = validator[module][action](data);
        if (validated.invalid) {
            formEffect.formErrorBinding(form, validated.errors);
            return;
        }
    }
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        dataType: 'json',
        data: data,
        beforeSend: function () {
            formEffect.handleFormEffect('submit', form);
        },
        complete: function () {
            formEffect.handleFormEffect('complete', form);
        },
        success: function (response) {
            handleResponse.successResponse(response, form, function (response) {
                if (response.status) {
                    _msg.success(response.message)
                } else {
                    _msg.error(response.message)
                }
                form[0].reset()
                let redirectUrl = form.data('redirect')
                if (redirectUrl != undefined) {
                    delayRedirect(redirectUrl, 1)
                }
            });
        },
        error: function (response) {
            handleResponse.exceptionResponse(response, form, true, function (response) {
                _msg.alert(response.message);
            });
        }
    })
});
$(document).on("change", ".js-change-autocomplete", function (e) {
    let selectedElement = $(this).find("option:selected");
    let autocompleteTarget = $(this).data("autocomplete-target");
    let autocompleteValue = selectedElement.attr('data-autocomplete-value');
    $(autocompleteTarget).val(autocompleteValue)
})
$(document).on("change", "#js_pawn_interest_percent, #js_pawn_origin_amount", function (e) {
    calculatePawnInterest()
})
$(document).on("change", "#js_pawn_category_id", function (e) {
    //
    let selectedElement = $(this).find("option:selected");
    let liquidatedDay = selectedElement.attr('data-liquidated-day')
    let interestPercent = selectedElement.attr('data-interest-percent');
    let paymentDay = selectedElement.attr('data-payment-day');
    $("#js_pawn_interest_percent").val(interestPercent)
    $("#js_pawn_payment_day").val(paymentDay)
    $("#js_pawn_liquidated_day").val(liquidatedDay)
    calculatePawnInterest()
})
$(document).on("change", "#js_interest_payment_round", function (e) {
    //
    let round = $(this).val();
    let interestAmount = $(this).data("interest_amount")
    $("#js_interest_amount").val(interestAmount * round)
    updateVndInput("#js_interest_amount")

})

$(document).on("click", ".js-remove-parent", function (e) {
    let parent = $(this).closest('.js-parent-remove')
    parent.prev('hr').remove()
    parent.remove()
});
$(document).on("click", ".js-before-append", function (e) {
    let data = $(this).data("before-append")
    $(this).before(data)
});
$(document).on('keyup', '.js-vnd-input', function (e) {
    updateVndInput(this, 'show')
});
$(document).on("change", ".js-switch-status", function (e) {
    let status = this.checked ? 1 : 0
    let button = $(this)
    let action = button.attr("action")
    $.ajax({
        url: action,
        type: 'patch',
        dataType: 'json',
        data: {status: status},
        success: function (response) {
            handleResponse.successBtnActionClick(response, function (response) {
                if (response.status) {
                    _msg.success(response.message)
                } else {
                    button.prop('checked', !status);
                    _msg.error(response.message)
                }
            });
        },
        error: function (response) {
            button.prop('checked', !status);
            handleResponse.exceptionBtnActionClick(response, function (response) {
                _msg.alert(response.message);
            });
        }
    })

})
$(document).on("click", ".js-btn-delete-action", function (e) {
    let button = $(this)
    let action = button.attr("action")
    let confirmTitle = button.attr("title")
    let container = button.attr("container")
    let url = $(container).find('ul.pagination').find('li.active').data('url')
    _msg.confirm(confirmTitle, function () {
        $.ajax({
            url: action,
            type: 'delete',
            dataType: 'json',
            success: function (response) {
                handleResponse.successBtnActionClick(response, function (response) {
                    if (response.status) {
                        getHtml(window.location.href, container)
                        _msg.success(response.message)
                    } else {
                        _msg.error(response.message)
                    }
                });
            },
            error: function (response) {
                handleResponse.exceptionBtnActionClick(response, function (response) {
                    _msg.alert(response.message);
                });
            }
        })

    })

})

function delayRedirect(url, timeout = 1) {
    setTimeout(function () {
        handleResponse.redirect(url);
    }, timeout * 1000);
}

function checkValidateForm(form) {
    form.addClass('was-validated');
    return form.validate();
}

function calculatePawnInterest() {
    let percent = $("#js_pawn_interest_percent").val();
    let origin = format.unformatCurrency($("#js_pawn_origin_amount").val());
    let amount = origin > 0 ? origin / 100 * percent : 0;
    $("#js_pawn_interest_amount").val(format.formatCurrency(amount))
    updateVndInput("#js_pawn_interest_amount")

}

function beforeStoreHandler(response, form) {
    if (response.status) {
        //let rowId = form.data("row-id")
        //$(rowId).replaceWith(response.data);
        _msg.success(response.message)
        let redirectUrl = form.data("list-url")
        if (typeof redirectUrl !== 'undefined') {
            delayRedirect(redirectUrl, 1)
        }

        if (typeof response.redirect !== 'undefined') {
            delayRedirect(response.redirect, 1)
        }
    } else {
        _msg.error(response.message)
    }
    return;
}

function updateVndInput(inputId, tooltip = 'enable') {
    let amount = format.unformatCurrency($(inputId).val())
    let unit = $(inputId).data("unit");
    let valueDigits = format.readVietnameseDigits(amount)
    $(inputId).val(format.formatCurrency(amount))
    $(inputId).attr("data-original-title", `${format.upperCaseFirst(valueDigits)} ${unit}`).tooltip(tooltip);
}
