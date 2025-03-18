import * as default_rule from '../rules/default';
import trans from '../../../../js/helpers/messages'
import config from '../config'

let messages = {
    name: {
        required: trans.message.required("tên"),
        min: trans.message.min("Tên","không hợp lệ"),
        max: trans.message.max("Tên","không hợp lệ"),
        regex: trans.message.invalid("Tên"),
    },
    email: {
        required: trans.message.required("email"),
        email: trans.message.invalid("Email"),
    },
    password: {
        required: trans.message.required("mật khẩu"),
        min: trans.message.invalid("Mật khẩu","phải chứa ít nhất 6 ký tự"),
        max: trans.message.invalid("Mật khẩu","tối đa 16 ký tự"),
    },
    re_password: {
        required: trans.message.required("lại mật khẩu"),
        same: trans.message.same("Nhập lại mật khẩu"),
    },
    g_recaptcha: {
        required: trans.message.required("bạn không phải là máy", "xác nhận"),
    },
    approve: {
        required: trans.message.required("với các điều khoản của chúng tôi", "đồng ý"),
    },
    affiliate_key: {
        valid: trans.message.invalid("Mã giới thiệu"),
    }
}
let rules = function (values) {
    return {
        name: {
            required: default_rule.required,
            min: function (value){
                return value.length<config.username.min;
            },
            max: function (value){
                return value.length>config.username.max;
            },
            regex: function (value) {
                return (/^[a-zA-Z ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀẾỂưăạảấầẩẫậắằẳẵặẹẻẽềềếểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\\s]+$/.test(value) == false);
            },
        },
        email: {
            required: default_rule.required,
            email: default_rule.email,
        },
        password: {
            required: default_rule.required,
            min: function (value){
                return value.length<config.password.min;
            },
            max: function (value){
                return value.length>config.password.max;
            },
        },
        re_password: {
            required: default_rule.required,
            same: function (value) {
                return value !== values["password"];
            }
        },
        g_recaptcha: {
            required: default_rule.required,
        },
        affiliate_key: {
            valid: function(value){
                return value!=''&&((/^[a-zA-Z0-9]+$/.test(value) == false)||value.length!=config.affiliate_key.length)
            },
        },
        approve:
            {
                required: function (value) {
                    return value !=='yes';
                }
            }
    }
};
export {
    messages,
    rules
}

