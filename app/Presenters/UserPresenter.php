<?php

namespace App\Presenters;

use App\TraitHelpers\ConfigTrait;
use Robbo\Presenter\Presenter;


class UserPresenter extends Presenter
{
    use ConfigTrait;

    public function presentUserEmail()
    {

        return $this->object->email;
    }

    public function presentStatusName()
    {
        return $this->object->status()->name;
    }

    public function presentStatusSwitch()
    {
        return view('client.share.iporn-switch', ['attributes' => ['action' => route('clients.users.update_status', ['id' => $this->object->id]), 'type' => 'patch', 'class' => 'js-switch-status'], 'name' => 'status_id', 'checked' => $this->object->status_id])->render();
    }

    public function presentAction()
    {
        $editUrl = route('clients.users.edit', ['user' => $this->object->id]);
        $editPasswordUrl = route('clients.users.edit_password', ['id' => $this->object->id]);
        $deleteAttributes = ['container' => '#js_list_users', 'action' => route('clients.users.destroy', ['user' => $this->object->id])];
        return view('client.share.default-action', compact('deleteAttributes', 'editUrl'))->render() . view('client.user.user.button.edit-password', compact('editPasswordUrl'))->render();
    }

    public function presentRowId()
    {
        return "js_user_record_{$this->object->id}";
    }

    public function presentRoleName()
    {
        return $this->object->getRoleNames()->first();
    }

}
