<?php

namespace Travidence\Rest;


use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Travidence\Rest\Application\Router;

class RestRouter extends RouteList
{
    // todo: map HTTP method to controller action names somehow
    public static function createRouter($module, $urlPrefix = '')
    {
        $router = new Router($module);

        $router[] = new Route($urlPrefix . "trip", [
            'presenter' => 'Trip'
        ]);

        return $router;
    }
}