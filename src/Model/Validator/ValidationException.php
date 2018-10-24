<?php

namespace Travidence\Model\Validator;


use Throwable;

class ValidationException extends \InvalidArgumentException
{
    /** @var string[] */
    private $errors;

    public function __construct(array $errors, string $message = "")
    {
        parent::__construct($message);
        $this->errors = $errors;
    }

    /** @return string[] */
    public function getErrors(): array
    {
        return $this->errors;
    }


}