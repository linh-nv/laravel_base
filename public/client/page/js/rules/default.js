let required = function (value) {
        return value == '';
    };
let email = function (email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email) == false;
};
let username = function (username) {
    const re = /^([a-zA-Z0-9])+$/;
    return re.test(username) == false;
};
export {
    required,
    email,
    username
}
