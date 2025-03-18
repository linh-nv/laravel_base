import * as format from '../../../../js/helpers/format';

let store = (formData) => {
    formData["amount"] = format.unformatCurrency(formData["amount"])
    return (({shareholder_id, amount, is_in, description}) => ({
        shareholder_id,
        amount,
        is_in,
        description
    }))
    (formData);
}
let search = (formData) => {
    return (({search_key, shareholder_id, in_out, time_from, time_to}) => ({
        search_key,
        shareholder_id,
        in_out,
        time_from,
        time_to
    }))(formData);
}
export {
    store, search
}
