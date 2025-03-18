<?php

namespace App\Repositories\System;

use App\Repositories\Base\RepositoryEloquent;

class SystemRepositoryEloquent extends RepositoryEloquent implements SystemRepository
{
    public function getModel()
    {
        return \App\Models\System::class;
    }
}
