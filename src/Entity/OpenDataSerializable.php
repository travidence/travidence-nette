<?php

namespace Travidence\Entity;


trait OpenDataSerializable
{
    public function asArray()
    {
        $data = [];
        foreach ($this as $property => $value) {
            if (is_object($value) && method_exists($value, 'asArray')) {
                $value = $value->asArray();
            }
            $data[$property] = $value;
        }

        return $data;
    }
}