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
            $serialized = array_map([$this, 'mapValue'], $value);
        }

        if (is_object($value) && method_exists($value, 'asArray')) {
            $serialized = $value->asArray();
        }
        if ($value instanceof \DateTime) {
            $serialized = $value->format(\DateTime::W3C);
        }

        return $serialized ?? $value;
    }
}