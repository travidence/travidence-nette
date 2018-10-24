<?php

namespace Travidence\Model\Validator;


use Throwable;

class ValidationException extends \InvalidArgumentException
{
    /** @var string[] */
    private $errors;

    public function __construct(array $errors, string $message = "", Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->errors = $errors;
    }

    /** @return string[] */
    public function getErrors(): array
    {
        return $this->errors;
    }


}