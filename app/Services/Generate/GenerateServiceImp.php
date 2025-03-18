<?php

namespace App\Services\Generate;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Keygen;
use App\TraitHelpers\StringTrait;

class GenerateServiceImp implements GenerateService
{
    use StringTrait;
    private $generate;

    public function __construct(Keygen $generate)
    {
        $this->generate = $generate;
    }

    public function generateCode44()
    {
        return $this->generate->bytes()->generate(
            function ($key) {
                // Generate a random numeric key
                $random = $this->generate->numeric()->generate();

                // Manipulate the random bytes with the numeric key
                return substr(md5($key . $random . strrev($key)), mt_rand(0, 8), 20);
            },
            function ($key) {
                // Add a (-) after every fourth character in the key
                return join('-', str_split($key, 4));
            },
            'strtoupper'
        );
    }

    public function generateCode($length = 20)
    {
        return $this->generate->bytes()->generate(
            function ($key) use ($length) {
                $random = $this->generate->numeric()->generate();
                return substr(md5($key . $random . strrev($key)), mt_rand(0, 8), $length);
            },
            function ($key) {
                return $key;
            },
            'strtolower'
        );
    }

    protected function generateWordCode($limit)
    {
        $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ');
        shuffle($seed);
        $rand = '';
        $randArr = array_rand($seed, $limit);
        if (!is_array($randArr)) {
            $randArr = [$randArr];
        }
        foreach ($randArr as $k) $rand .= $seed[$k];
        return $rand;
        foreach (array_rand($seed, $limit) as $k) $rand .= $seed[$k];
        return $rand;
    }

    protected function generateNumberCode($limit)
    {
        $seed = str_split('012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789');
        shuffle($seed);
        $rand = '';
        foreach (array_rand($seed, $limit) as $k) $rand .= $seed[$k];
        return $rand;
    }

    protected function generateNumericKey($length)
    {
        // prefixes the key with a random integer between 1 - 9 (inclusive)
        return $this->generate->numeric($length)->prefix(mt_rand(1, 9))->generate(true);
    }

    public function generateID()
    {
        $id = $this->generateNumericKey(5);

        // Ensure ID does not exist
        // Generate new one if ID already exists

        return $id;
    }

    public function generateModelCode($model)
    {

        try {
            // Ensure ID does not exist
            // Generate new one if ID already exists
            // $modelName = "\\App\\Models\\{$model}";
            $model = new $model;
            $column = $model->code->column;
            do{
                $code = $this->generateCode($model->code->length);
            }
            while ($model->where($column, $code)->count() > 0);
            $format =$model->code->format;
            return $format($code);
        } catch (\Exception $exception) {
            return null;

        }
    }


    public function getFirstCharOfArrElement($words)
    {
        $firstCharWord = array_map(function ($word) {
            return $word[0];
        }, $words);
        return Str::upper(implode('', $firstCharWord));
    }


    public function convertNameToArray($name)
    {
        $string = Str::slug($name);
        $words = explode('-', $string);
        return $words;
    }

    public function getCharsWordString($stringRanType, $string, $limit)
    {
        $string = Str::slug($string);
        $words = explode('-', $string);

    }

    public function getMoreCharWordString($words, $limit)
    {
        $string = array_map(function ($word) use ($limit) {
            return Str::substr($word, 0, $limit);
        }, $words);
        return implode('', $string);
    }

    public function generateLogicCode($limit, $type = 'string', $stringRanType = 'random', $words = null)
    {
        if ($type == 'number') {
            return $this->generateNumericKey($limit);
        }
        if ($stringRanType == 'random') {
            return $this->generateWordCode($limit);
        }


        $code = $this->getFirstCharOfArrElement($words);
        $stringLen = Str::length($code);
        if ($limit > $stringLen) {
            $randomLength = $limit - $stringLen;
            $code .= $this->generateWordCode($randomLength);
        }
        return Str::limit($code, $limit, '');
    }

    public function generateLogicCodeForModel($model, $limit, $prefix = null, $type = 'number', $name = null)
    {
        $name = ucfirst(Str::lower($name));
        $names = $this->convertNameToArray($name);
        $code = $this->generateLogicCode($limit, $type, 'first', $names);
        $code = Str::upper($prefix . $code);
        $model = $this->convertToModelName($model);
        $modelUrl = $this->makeStandardModelUrl($model,"\\");
        $model = new $modelUrl;
        $column = $model->getCodeColumn();
        if ($type == 'string') {
            if ($model->where($column, $code)->count() == 0) {
                return $code;
            }
            $wordsLength = count($names);
            $shortestWord = min(array_map('strlen', $names));
            if ($shortestWord * $wordsLength >= $limit) {
                $code = Str::upper($prefix . Str::substr($this->getMoreCharWordString($names, $shortestWord), 0, $limit));
                if ($model->where($column, $code)->count() == 0) {
                    return $code;
                }
            }
            $code = Str::upper($prefix . $this->generateLogicCode($limit, $type, 'random', $names));
        }
        while ($model->where($column, $code)->count() > 0) {
            $code = Str::upper($prefix . $this->generateLogicCode($limit, $type, 'random', $names));
        }
        return $code;
    }

}
