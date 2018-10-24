<?php

namespace Travidence\Exceptions;

use Nette\Http\Response;
use Throwable;

class NotFoundException extends \Exception
{
    public function __construct(string $unfoundSubject = "", Throwable $previous = null)
    {
        // todo: consider rightfulness of HTTP code usage
        parent::__construct("error.not_found $unfoundSubject", Response::S404_NOT_FOUND, $previous);
    }
}