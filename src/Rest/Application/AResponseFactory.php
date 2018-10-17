<?php

namespace Travidence\Rest\Application;


use Nette\Application\IResponse;

abstract class AResponseFactory
{
    /**
     * @param mixed $data
     * @param int   $code
     * @return IResponse
     */
    public abstract function create($data, $code = null);
}
