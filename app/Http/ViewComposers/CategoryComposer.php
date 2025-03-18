<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use Robbo\Presenter\View\View;

class CategoryComposer
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function compose(View $view)
    {
        $view->with('categories', $this->categoryRepository->getActiveCategories());
    }
}
