<?php

namespace App\Repositories\Customer;

interface CustomerRepository
{
    public function handleFilter($select, $keyword = null);
}

?>
