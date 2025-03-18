<?php

namespace App\Repositories\InterestPaidHistory;

use App\Repositories\Base\RepositoryEloquent;
use App\TraitHelpers\ConfigTrait;
use App\TraitHelpers\DateTrait;

class InterestPaidHistoryRepositoryEloquent extends RepositoryEloquent implements InterestPaidHistoryRepository
{
    use DateTrait, ConfigTrait;

    public function getModel()
    {
        return \App\Models\InterestPaidHistory::class;
    }
}
