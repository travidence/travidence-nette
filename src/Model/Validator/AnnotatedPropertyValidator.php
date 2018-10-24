<?php

namespace Travidence\Model\Validator;


use ReflectionClass;
use Travidence\Model\Entity\BaseEntity;

class AnnotatedPropertyValidator
{
    private static $REQUIRED = '@required';

    private $refClasses = [];

    private $propertySpecs = [];

    public function validate(BaseEntity $entity): array
    {
        $errors = [];

        $this->validateObject($entity, $errors);

        return $errors;
    }

    private function validateObject($object, array &$errors, $parentPath = "")
    {
        $rc = $this->getReflectionClass(get_class($object));
        $currentPath = "$parentPath." . $rc->getShortName();
        $propertySpecs = $this->getPropertySpecs($rc);

        foreach ($propertySpecs as $spec) {
            $property = $spec['name'];
            $value = $object->$property;

            if (strstr($spec['rest'], self::$REQUIRED)) {
                if (!$value) {
                    $errors[] = ["required.missing", "$currentPath.$property"];
                    continue;
                }
            }

            if (is_object($value)) {
                $this->validateObject($value, $errors, "$currentPath.$property");
            }

            if (is_array($value)) {
                $this->validateArray($value, $errors, "$currentPath.$property");
                continue;
            }
        }

    }

    private function validateArray($array, &$errors, $parentPath = "")
    {
        foreach ($array as $i => $item) {
            if (is_object($item)) {
                $this->validateObject($item, $errors, $parentPath . "[$i]");
                continue;
            }
        }
    }


    private function getPropertySpecs(ReflectionClass $class): array
    {
        if (!isset($this->propertySpecs[$class->getName()])) {
            $docComment = $class->getDocComment();
            $this->propertySpecs[$class->getName()] = $this->parseClassDocCommentProperties($docComment);
        }

        return $this->propertySpecs[$class->getName()];
    }

    private function parseClassDocCommentProperties(string $docComment): array
    {
        $properties = [];
        $matches = [];
        $re = '/@property[ \t]+(?P<type>[A-Za-z_\-\[\]]+)[ \t]+\$(?P<name>[^\s]*)[ \t]*(?P<rest>.*?)?\r?\n?$/m';
        if (preg_match_all($re, $docComment, $matches)) {
            $numMatches = count($matches[0]);

            for ($i = 0; $i < $numMatches; ++$i) {
                $properties[$matches['name'][$i]] = [
                    'name' => $matches['name'][$i],
                    'type' => $matches['type'][$i],
                    'rest' => $matches['rest'][$i],
                ];
            }
        }

        return $properties;
    }

    private function getReflectionClass($class): ReflectionClass
    {
        if (!isset($this->refClasses[$class])) {
            /** @noinspection PhpUnhandledExceptionInspection - class always exists at this point */
            $this->refClasses[$class] = new ReflectionClass($class);
        }
        return $this->refClasses[$class];
    }

}