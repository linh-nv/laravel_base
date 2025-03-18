<?php


namespace App\Models;


use App\TraitHelpers\ConfigTrait;

class Status
{
    use ConfigTrait;

    public function __construct($modelSlug, $id)
    {
        $status = $this->findStatusById($id, $modelSlug);
        if ($status==null) return;
        foreach ($status as $key => $value) {
            $this->$key = $value;
        }
    }
}
