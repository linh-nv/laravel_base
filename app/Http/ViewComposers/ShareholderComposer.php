<?php

namespace App\Http\ViewComposers;

use App\Repositories\Shareholder\ShareholderRepository;
use Robbo\Presenter\View\View;

class ShareholderComposer
{

    protected $shareholderRepository;

    public function __construct(ShareholderRepository $shareholderRepository)
    {
        $this->shareholderRepository = $shareholderRepository;
    }

    public function compose(View $view)
    {
        $view->with('shareholders', $this->shareholderRepository->getAll());
    }
}
