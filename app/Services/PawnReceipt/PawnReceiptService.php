<?php


namespace App\Services\PawnReceipt;


interface PawnReceiptService
{
    public function store($customerInfo,$pawnReceiptInfo,$pawnProducts,$userId);
    public function payInterest($pawnReceiptId,$interestPaymentInfo,$userId);
    public function payLoan($pawnReceiptId,$loanInfo,$userId);
    public function getStatisticToday();
}
