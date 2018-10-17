<?php

namespace Travidence\Router;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Travidence\Rest\RestRouter;


final class RouterFactory
{
	use Nette\StaticClass;

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList;

		$router[] = RestRouter::createRouter('rest', 'api/');

		$router[] = new Route('<presenter>/<action>', 'Trip:createNew');
		return $router;
	}
}
