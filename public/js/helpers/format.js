const readDigitsNumbers = ['không', 'một', 'hai', 'ba', 'bốn', 'năm', 'sáu', 'bảy', 'tám', 'chín'];

function readDigitsTens(number, isFull) {
    let digits = "",
        tens = Math.floor(number / 10),
        unit = number % 10;
    if (tens > 1) {
        digits = ` ${readDigitsNumbers[tens]} mươi`;
        if (unit == 1) {
            digits += " mốt";
        }
    } else if (tens == 1) {
        digits = " mười";
        if (unit == 1) {
            digits += " một";
        }
    } else if (isFull && unit > 0) {
        digits = " lẻ";
    }
    if (unit == 5 && tens > 1) {
        digits += " lăm";
    } else if (unit > 1 || (unit == 1 && tens == 0)) {
        digits += ` ${readDigitsNumbers[unit]}`;
    }
    return digits;
}

function readDigitsHundreds(number, isFull) {
    let digits = "",
        hundreds = Math.floor(number / 100);
    number = number % 100;
    if (isFull || hundreds > 0) {
        digits = ` ${readDigitsNumbers[hundreds]} trăm`;
        digits += readDigitsTens(number, true);
    } else {
        digits = readDigitsTens(number, false);
    }
    return digits;
}

function readDigitsMillions(number, isFull) {
    let digits = "",
        millions = Math.floor(number / 1000000);
    number = number % 1000000;
    if (millions > 0) {
        digits = `${readDigitsHundreds(millions, isFull)} triệu`;
        isFull = true;
    }
    let thousands = Math.floor(number / 1000);
    number = number % 1000;
    if (thousands > 0) {
        digits += `${readDigitsHundreds(thousands, isFull)} nghìn`;
        isFull = true;
    }
    if (number > 0) {
        digits += readDigitsHundreds(number, isFull);
    }
    return digits;
}

let readVietnameseDigits = function (number) {
    if (number == 0) return readDigitsNumbers[0];
    let digits = "",
        suffixes = "",
        billions = 0;
    do {
        billions = number % 1000000000;
        number = Math.floor(number / 1000000000);
        if (number > 0) {
            digits = `${readDigitsMillions(billions, true)} ${suffixes} ${digits}`;
        } else {
            digits = `${readDigitsMillions(billions, false)} ${suffixes} ${digits}`;
        }
        suffixes = " tỷ";
    } while (number > 0);
    return digits;
}
let upperCaseFirst = function (str) {
    str = $.trim(str)
    return `${str.charAt(0).toUpperCase()}${str.slice(1)}`
}
let formatCurrency = function (number) {
    number != '' ? number = parseInt(number).toString() : number = '0';
    let n = number.split('').reverse().join("");
    let n2 = n.replace(/\d\d\d(?!$)/g, "$&,");
    return n2.split('').reverse().join('');
}
let number_format = function (number, decimals = 0, dec_point = ".", thousands_sep = ",") {
    let n = number,
        c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    let d = dec_point == undefined ? "," : dec_point;
    let t = thousands_sep == undefined ? "." : thousands_sep,
        s = n < 0 ? "-" : "";
    let i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}
let unformatCurrency = function (currency) {
    currency += "";
    let number = parseFloat(currency.toString().replace(/[^0-9-.]/g, ''));
    return isNaN(number) ? 0 : number
}
export {
    upperCaseFirst, readVietnameseDigits, formatCurrency, number_format, unformatCurrency
}
