import {validate} from '../../../../js/helpers/validation';
import * as login from './login'
import * as register from './register'

let auth = {
    login: function (values) {
        return validate(values, login.messages, login.rules);
    },
    register: function (values) {
        let rules = register.rules;
        return validate(values, register.messages, register.rules(values));
    }
}
export {
    auth,
}
