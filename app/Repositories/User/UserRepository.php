<?php

namespace App\Repositories\User;

interface UserRepository
{
    public function handleFilter($select, $keyword = null, $roleName = null, $statusId = null, $userId = null);
}

?>
