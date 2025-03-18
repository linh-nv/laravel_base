import * as default_rule from '../rules/default';
import trans from '../../../../js/helpers/messages'

let messages = {
    username: {
        required: trans.message.required("tên đăng nhập"),
        username: trans.message.invalid("Tên đăng nhập"),
    },
    password: {
        required: trans.message.required("mật khẩu"),
    },
    g_recaptcha: {
        required: trans.message.required("bạn không phải là máy","xác nhận"),
    }
}
let rules =
    {
        username: {
            required: default_rule.required,
            username: default_rule.username,
        },
        password: {
            required: default_rule.required,
        },
        g_recaptcha: {
            required: default_rule.required,
        }
    };
export {
    messages,
    rules
}

