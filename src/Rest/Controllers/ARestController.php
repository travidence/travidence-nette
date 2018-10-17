<?php

namespace Travidence\Rest\Controllers;


use Nette\Application;
use Travidence\Rest\Application\JsonResponse;
use Travidence\Rest\Application\ResponseCreator;
use Travidence\Rest\Application\RestPresenter;

abstract class ARestController extends RestPresenter
{
    /** @var ResponseCreator @inject */
    public $response;

    /**
     * @return array
     */
    protected function getRequestBody()
    {
        // todo: add more formats?
        return $body = $this->request->getJsonBody();
    }

    public function sendResponse(Application\IResponse $response)
    {
        if ($this->context->getParameters()['debugMode']) {
            if ($response instanceof JsonResponse) {
                $response->putToPayload('_service', get_class($this) . '->' . $this->action);
                $response->putToPayload('_code', $response->getCode());
            }
        }

        parent::sendResponse($response);
    }
}
