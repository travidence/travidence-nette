<?php

namespace Travidence\Rest\Application;


use Nette\Application\IResponse;
use Nette\Http\Response;
use Nette\SmartObject;
use Nette\Utils\Json;

/**
 * Class JsonResponder
 *
 * @method onSend(IResponse $response)
 */
class JsonStatusResponder extends AResponseFactory
{
    const JSON_STATUS_OK = 'ok';
    const JSON_STATUS_ERR = 'err';

    const DEFAULT_FORMAT_DEPTH = 1;

    use SmartObject;

    /** @var callback[] */
    public $onSend = [];

    private $options = 0;

    public function __construct($prettyPrint = false)
    {
        if ($prettyPrint) {
            $this->options |= Json::PRETTY;
        }
    }

    /**
     * @param array $data
     */
    public function success($data = null)
    {
        $this->onSend($this->create($data, Response::S200_OK, self::JSON_STATUS_OK));
    }

    /**
     * @param string                    $message
     * @param int|null                  $code
     * @param array                     $data
     */
    public function error($message, $code = null, $data = [])
    {
        if (!$code) {
            $code = Response::S400_BAD_REQUEST;
        }

        $response = [
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        $this->onSend($this->create($data, $code, self::JSON_STATUS_ERR));
    }

    /**
     * @param mixed  $data
     * @param int    $code
     * @param string $status
     * @return \Nette\Application\IResponse
     */
    public function create($data, $code = null, $status = null)
    {
        $code = is_int($code) ? $code : Response::S200_OK;
        $status = $status ?: ($code < Response::S400_BAD_REQUEST ? self::JSON_STATUS_OK : self::JSON_STATUS_ERR);

        $response = [
            'data' => $data,
            'status' => $status,
        ];

        return new JsonResponse($response, $code, $this->options);
    }
}
