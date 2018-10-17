<?php

namespace Travidence\Rest\Application;


use Nette;
use Nette\Application;
use Nette\Application\UI\ComponentReflection;
use Nette\Http;

/**
 * This is a sliced down version of Application\Presenter which provides basic functionality and
 * simpler API for sending API responses
 *
 * @package Travidence\Rest\Application\Controllers
 * @property-read AResponseFactory $responseFactory
 * @property-read Nette\DI\Container $context
 * @property-read Nette\Security\User $user
 * @property-read Http\Session $session
 */
abstract class RestPresenter implements Application\IPresenter
{
    use Nette\SmartObject;

    private $startupCheck = false;
    /** @var AResponseFactory */
    protected $responseFactory;
    /** @var Request */
    protected $request;
    /** @var Application\IResponse */
    protected $response;
    /** @var array */
    protected $params = [];

    protected $name;
    protected $action;

    protected $context;
    protected $httpRequest;
    protected $httpResponse;
    protected $session;
    protected $user;

    /**
     * @param Application\Request $request
     * @return void
     * @throws Application\BadRequestException
     * @throws Application\ForbiddenRequestException
     */
    public function run(Application\Request $request)
    {
        try {
            // STARTUP
            $this->request = $request;
            $this->params = $this->request->getParameters();

            if (!isset($this->params['action'])) {
//                throw new Nette\InvalidStateException("Request must have parameter action");
                $this->params['action'] = Nette\Utils\Strings::lower($this->request->getMethod());
            }
            $this->name = $request->getPresenterName();
            $this->action = $this->params['action'];

//            $this->initGlobalParameters();
            $this->checkRequirements($this->getReflection());
//            $this->onStartup($this);
            $this->startup();
            if (!$this->startupCheck) {
                $class = $this->getReflection()->getMethod('startup')->getDeclaringClass()->getName();
                throw new Nette\InvalidStateException("Method $class::startup() or its descendant doesn't call parent::startup().");
            }

            // calls $this->action<Action>()
            $response = $this->tryCall('action' . Nette\Utils\Strings::capitalize($this->action), $this->params);
            if (!$response && !is_array($response)) {
                $action = $this->getAction(true);
                throw new Nette\InvalidStateException("Action $action did not either send a response or return a truthy value");
            }
            if ($response instanceof Application\IResponse) {
                $this->sendResponse($response);
            } else {
                $response = $this->responseFactory->create($response);
                $this->sendResponse($response);
            }
        } catch (Application\AbortException $e) {
            // SHUTDOWN
//            $this->onShutdown($this, $this->response);
            $this->shutdown($this->response);

            return $this->response;
        }
    }

    /**
     * @return void
     */
    protected function startup()
    {
        $this->startupCheck = true;
    }

    protected function tryCall($method, array $params)
    {
        $rc = $this->getReflection();
        if (!$rc->hasMethod($method)) {
            throw new Nette\NotImplementedException("Method '$method' is not implemented");
        }

        $rm = $rc->getMethod($method);
        $this->checkRequirements($rm);
        if ($rm->isPublic() && !$rm->isAbstract() && !$rm->isStatic()) {
            $this->checkRequirements($rm);

            return $result = $rm->invokeArgs($this, $rc->combineArgs($rm, $params));
        }

        return false;
    }

    /**
     * Checks for requirements such as authorization.
     *
     * @return void
     */
    public function checkRequirements($element)
    {
    }

    /**
     * Sends response and terminates presenter.
     *
     * @param Application\IResponse $response
     * @return void
     * @throws Application\AbortException
     */
    public function sendResponse(Application\IResponse $response)
    {
        $this->response = $response;
        $this->terminate();
    }


    /**
     * Correctly terminates presenter.
     *
     * @return void
     * @throws Nette\Application\AbortException
     */
    public function terminate()
    {
        throw new Application\AbortException;
    }

    public function shutdown(Application\IResponse $response)
    {

    }

    /**
     * Returns current action name.
     *
     * @param bool $fullyQualified
     * @return string
     */
    public function getAction($fullyQualified = false)
    {
        return $fullyQualified ? ':' . $this->name . ':' . $this->action : $this->action;
    }

    public function injectPrimary(
        Nette\DI\Container $context = null,
        Http\IRequest $httpRequest,
        Http\IResponse $httpResponse,
        Http\Session $session = null,
        Nette\Security\User $user = null,
        AResponseFactory $responseFactory = null
    )
    {
        if ($this->context !== null) {
            throw new Nette\InvalidStateException('Method ' . __METHOD__ . ' is intended for initialization and should not be called more than once.');
        }

        $this->context = $context;
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
        $this->session = $session;
        $this->user = $user;
        $this->responseFactory = $responseFactory;
    }

    /**
     * Access to reflection.
     *
     * @return ComponentReflection
     */
    public static function getReflection()
    {
        return new ComponentReflection(get_called_class());
    }
}
