<?php

namespace Travidence\Rest\Application;


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
     * // todo: remove support for json, use getJsonBody() instead - it's weird when function has variable return type
     */
    public function getBody($type = self::BODY_READ_RAW)
    {
        if (!$this->body) {
            $this->body = call_user_func($this->rawBodyCallback);
        }

        switch ($type) {
            default:
            case self::BODY_READ_RAW:
                return $this->body;
            case self::BODY_READ_JSON:
                $json = json_decode($this->body, true);

                return $json ?: [];
        }
    }

    /**
     *
     * @return array
     */
    public function getJsonBody() {
        $body = $this->getBody();

        return json_decode($body, true) ?: [];
    }
}
