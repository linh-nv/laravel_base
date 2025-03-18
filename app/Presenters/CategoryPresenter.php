<?php

namespace App\Presenters;

use App\TraitHelpers\ConfigTrait;
use Carbon\Carbon;
use Robbo\Presenter\Presenter;


class CategoryPresenter extends Presenter
{
    use ConfigTrait;

    public function presentAction()
    {
        $editUrl = route('clients.categories.edit', ['category' => $this->object->id]);
        $deleteAttributes = ['container' => '#js_list_categories', 'action' => route('clients.categories.destroy', ['category' => $this->object->id])];
        return view('client.share.default-action', compact('deleteAttributes', 'editUrl'))->render();
    }

    public function presentStatusSwitch()
    {
        return view('client.share.iporn-switch', ['attributes' => ['action' => route('clients.categories.update_status', ['id' => $this->object->id]), 'type' => 'patch', 'class' => 'js-switch-status'], 'name' => 'status_id', 'checked' => $this->object->status_id])->render();
    }

    public function presentRowId()
    {
        return "js_category_record_{$this->object->id}";
    }
    public function presentDeadlineText()
    {
        $deadline =  Carbon::now();
        $deadline->addDays($this->object->payment_day);
        return $deadline->format('H:i:s d-m-Y');
    }

}
