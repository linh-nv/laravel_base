<?php

namespace App\Presenters;

use App\TraitHelpers\ConfigTrait;
use Robbo\Presenter\Presenter;


class ProductPresenter extends Presenter
{
    use ConfigTrait;

    public function presentAction()
    {
        $editUrl = route('clients.products.edit', ['product' => $this->object->id]);
        $deleteAttributes = ['container' => '#js_list_products', 'action' => route('clients.products.destroy', ['product' => $this->object->id])];
        return view('client.share.default-action', compact('deleteAttributes', 'editUrl'))->render();
    }

    public function presentCategoryName()
    {
        return $this->category->name;
    }

    public function presentRowId()
    {
        return "js_product_record_{$this->object->id}";
    }


}
