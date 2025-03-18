<?php


namespace App\TraitHelpers;


trait ConfigTrait
{
    public function findConfig($configs, $key, $value)
    {
        $config = array_filter(config($configs, []), function ($config) use ($key, $value) {
            return $config[$key] == $value;
        });
        return reset($config);
    }

    public function findStatusById($id, $model)
    {
        return $this->findConfig("status.$model", 'id', $id);
    }

    public function findStatusBySlug($slug, $model)
    {
        return $this->findConfig("status.$model", 'slug', $slug);
    }

    public function findTypeById($id, $model)
    {
        return $this->findConfig("type.$model", 'id', $id);
    }

    public function findTypeBySlug($slug, $model)
    {
        return $this->findConfig("type.$model", 'slug', $slug);
    }

    public function getValidValues($config, $attribute = 'id')
    {
        $config = array_map(function ($config) use ($attribute) {
            return $config[$attribute];
        },$config??[] );
        return $config;
    }
}
