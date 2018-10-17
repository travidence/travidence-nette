<?php

namespace Travidence\Rest\Application;


use Nette;

class JsonResponse implements Nette\Application\IResponse
{
    use Nette\SmartObject;

    /** @var mixed */
    private $payload = [];

    /** @var int */
    protected $code;

    /** @var string */
    private $contentType;
    /** @var int */
    private $options;


    /**
     * @param mixed $payload
     * @param int   $code
     * @param string ?$contentType
     */
    public function __construct($payload, $code = null, $options = 0)
    {
        $this->payload = $payload;
        $this->contentType = 'application/json';
        $this->code = is_int($code) ? $code : Nette\Http\Response::S200_OK;
        $this->options = $options;
    }

    /** @return mixed */
    public function getPayload()
    {
        return $this->payload;
    }

    public function putToPayload($key, $value) {
        $this->payload[$key] = $value;
    }


    /**
     * Returns the MIME content type of a downloaded file.
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /** @return int */
    public function getCode()
    {
        return $this->code;
    }


    /**
     * Sends response to output.
     *
     * @param Nette\Http\IRequest  $httpRequest
     * @param Nette\Http\IResponse $httpResponse
     * @return void
     *
     * @throws Nette\Utils\JsonException
     */
    public function send(Nette\Http\IRequest $httpRequest, Nette\Http\IResponse $httpResponse)
    {
        $httpResponse->setContentType($this->getContentType(), 'utf-8');
        $httpResponse->addHeader("Access-Control-Allow-Origin", "*");

        if ($this->code != Nette\Http\Response::S200_OK) {
            $httpResponse->setCode($this->code);
        }

        echo Nette\Utils\Json::encode($this->getPayload(), $this->options);
    }
}
