<?php

namespace Travidence\Rest\Application;


use Nette\InvalidStateException;

class Request extends \Nette\Application\Request
{
    const BODY_READ_RAW = 'raw';
    const BODY_READ_JSON = 'json';

    /** @var string */
    private $body;
    /** @var callback */
    private $rawBodyCallback;


    function setRawBodyCallback($rawBodyCallback)
    {
        $this->rawBodyCallback = $rawBodyCallback;
    }


    /**
     * Reads the php://input
     */
    public function getBody()
    {
        if (!$this->body) {
            $this->body = call_user_func($this->rawBodyCallback);
        }
        return $this->body;
    }

    /**
     *
     * @param bool $assoc - whether to
     * @return array|\stdClass
     */
    public function getJsonBody($assoc = true)
    {
        $body = $this->getBody();

        $data = json_decode($body, $assoc);
        if (!$data) {
            throw new InvalidStateException("Body contains malformed json");
        }

        return $data;
    }
}
