<?php

namespace App\Http\ViewComposers;

use App\Repositories\PawnReceipt\PawnReceiptRepository;
use Carbon\Carbon;
use Robbo\Presenter\View\View;

class PawnNoticeComposer
{
    private $pawnReceiptRepository;

    public function __construct(PawnReceiptRepository $pawnReceiptRepository)
    {
        $this->pawnReceiptRepository = $pawnReceiptRepository;
    }

    public function compose(View $view)
    {
        $today = Carbon::now();
        $interestIsDueCount = $this->pawnReceiptRepository->filterInterestIsDue($today->copy()->format('Y-m-d'))->count();
        $interestIsAboutDueCount = $this->pawnReceiptRepository->filterInterestIsDue($today->copy()->addDay()->format('Y-m-d'))->count();
        $interestIsOverDueCount = $this->pawnReceiptRepository->filterInterestOverDue($today->copy()->format('Y-m-d'))->count();
        $liquidationIsDueCount = $this->pawnReceiptRepository->filterLiquidationIsDue($today->copy()->format('Y-m-d'))->count();
        $view->with(['interestIsDueCount'=>$interestIsDueCount,'interestIsAboutDueCount'=>$interestIsAboutDueCount,'interestIsOverDueCount'=>$interestIsOverDueCount,'liquidationIsDueCount'=>$liquidationIsDueCount]);
    }
}
