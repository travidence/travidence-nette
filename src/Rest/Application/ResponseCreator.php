<?php

namespace Travidence\Rest\Application;


use Nette\Http\IResponse;

class ResponseCreator
{
    /** @var JsonStatusResponder */
    private $responseFactory;

    public function __construct(JsonStatusResponder $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function error($message = null, $code = null, $data = [])
    {
        if ($message) {
            $data['message'] = $message;
        }
        $code = $code ?: IResponse::S400_BAD_REQUEST;

        return $this->responseFactory->create($data, $code, JsonStatusResponder::JSON_STATUS_ERR);
    }

    public function badRequest($message = 'bad_request', $data = []) {
        return $this->error($message, IResponse::S400_BAD_REQUEST, $data);
    }

    public function forbidden($message = 'forbidden', $data = [])
    {
        return $this->error($message, IResponse::S403_FORBIDDEN, $data);
    }

    public function notFound($message = 'not_found', $data = [])
    {
        return $this->error($message, IResponse::S404_NOT_FOUND, $data);
    }

    public function alreadyExists($message = null, $data = [])
    {
        return $this->error($message, IResponse::S409_CONFLICT, $data);
    }

    public function unauthorized($message = null, $data = [])
    {
        return $this->error($message, IResponse::S401_UNAUTHORIZED, $data);
    }
}
