import * as format from '../../../../js/helpers/format';
let store = (formData) => {
    formData["origin_amount"]=format.unformatCurrency(formData["origin_amount"])
    formData["interest_amount"]=format.unformatCurrency(formData["interest_amount"])
    return (({ name, phone,address,identify_number,identify_date,identify_region,category_id,product_name,product_description,attached_products,origin_amount,interest_percent,interest_amount,pawn_date,payment_day,liquidated_day,note}) => ({ name, phone,address,identify_number,identify_date,identify_region,category_id,product_name,product_description,attached_products,origin_amount,interest_percent,interest_amount,pawn_date,payment_day,liquidated_day,note}))
    (formData);
}
let search = (formData) => {
    return (({search_key, status_id,month}) => ({search_key, status_id,month}))(formData);
}
let pay_interest = (formData) => {
    formData["interest_amount"]=format.unformatCurrency(formData["interest_amount"])
    return (({interest_amount, payment_round, interest_pay_date}) => ({interest_amount, payment_round, interest_pay_date}))(formData);
}
let pay_loan = (formData) => {
    formData["loan"]=format.unformatCurrency(formData["loan"])
    return (({loan, loan_payment_date}) => ({loan, loan_payment_date}))(formData);
}
export {
    store, search,pay_interest,pay_loan
}
