<?php


namespace App\Services\User;


interface UserService
{
    public function store($user, $roleName);
    public function update($id,$newUserInfo, $roleName);

}
