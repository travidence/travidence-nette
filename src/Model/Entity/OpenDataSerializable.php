<?php

namespace Travidence\Model\Entity;


trait OpenDataSerializable
{
    public function asArray()
    {
        $data = [];
        foreach ($this as $property => $value) {
            $data[$property] = $this->mapValue($value);
        }

        return $data;
    }

    private function mapValue($value)
    {
        if (is_array($value)) {
            return array_map([$this, 'mapValue'], $value);
        }

        if (is_object($value) && method_exists($value, 'asArray')) {
            return $value->asArray();
        }
        if ($value instanceof \DateTime) {
            return $value->format(\DateTime::W3C);
        }

        return $value;
    }
}