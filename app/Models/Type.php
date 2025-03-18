<?php


namespace App\Models;


use App\TraitHelpers\ConfigTrait;

class Type
{
    use ConfigTrait;

    public $id, $name, $slug, $label;

    public function __construct($modelSlug, $id)
    {
        $type = $this->findTypeById($id, $modelSlug);
        if ($type==null) return;
        foreach ($type as $key => $value) {
            $this->$key = $value;
        }
    }
}
