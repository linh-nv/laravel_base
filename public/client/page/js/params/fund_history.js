import * as format from '../../../../js/helpers/format';
let store = (formData) => {
    formData["amount"]=format.unformatCurrency(formData["amount"])
    return (({amount, date, description, invoice_type_id,is_in}) => ({amount, date, description, invoice_type_id,is_in}))
    (formData);
}
let search = (formData) => {
    return (({search_key, invoice_type_id, time_from, time_to}) => ({search_key, invoice_type_id, time_from, time_to}))(formData);
}
export {
    store, search
}

