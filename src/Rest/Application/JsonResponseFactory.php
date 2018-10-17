<?php

namespace Travidence\Rest\Application;


use Nette\Application\IResponse;
use Nette\Utils\Json;

final class JsonResponseFactory extends AResponseFactory
{
    private $options = 0;

    public function __construct($prettyPrint)
    {
        if ($prettyPrint) {
            $this->options |= Json::PRETTY;
        }
    }


    /**
     * @param mixed $data
     * @param int $code
     * @return IResponse
     */
    public function create($data, $code = null)
    {
        return new JsonResponse($data, $code, $this->options);
    }
}
