<?php

namespace App\Repositories\LoanPaidHistory;

use App\Repositories\Base\RepositoryEloquent;
use App\TraitHelpers\ConfigTrait;
use App\TraitHelpers\DateTrait;

class LoanPaidHistoryRepositoryEloquent extends RepositoryEloquent implements LoanPaidHistoryRepository
{
    use DateTrait, ConfigTrait;

    public function getModel()
    {
        return \App\Models\LoanPaidHistory::class;
    }
}
