export default {
    message: {
        required: function (param, action = 'nhập') {
            return `Vui lòng ${action} ${param}.`;
        },
        invalid: function (param, error = 'không hợp lệ') {
            return `${param} ${error}.`;
        },
        same: function (param, error = 'không khớp') {
            return `${param} ${error}.`;
        },
        min: function (param, error = 'quá ngắn') {
            return `${param} ${error}.`;
        },
        max: function (param, error = 'quá dài') {
            return `${param} ${error}.`;
        },
    },
    login: {
        redirect: "Đang chuyển hướng.",
        fail: "Đăng nhập thất bại.",
        success: "Đăng nhập thành công.",
    },
    server: {
        token_expired: "Hết phiên làm việc.",
        bug: "Lỗi rồi người ơi.",
        default_message_title: "Application said:",
        default_confirm_title: "Đồng ý hay không nói 1 lời?",
        ok: "Đồng ý",
        cancel: "Huỷ",
    },
    select2: {
        errorLoading: function () {
            return "Tải dữ liệu bị lỗi";
        },
        inputTooLong: function (args) {
            return "Dữ liệu quá dài";
        },
        inputTooShort: function (args) {
            return "Dữ liệu quá ngắn";
        },
        loadingMore: function () {
            return "Xem thêm...";
        },
        noResults: function () {
            return "Không có dữ liệu";
        },
        searching: function () {
            return "Đang tìm...";
        }

    }


}
