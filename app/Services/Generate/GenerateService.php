<?php

namespace App\Services\Generate;

interface GenerateService
{
    public function generateCode44();

    public function generateCode($length =20);

    public function generateID();

    public function generateModelCode($model);

    public function generateLogicCodeForModel($model, $limit, $prefix = null, $type = 'number', $name = null);
}

?>
