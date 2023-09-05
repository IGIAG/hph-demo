<?php
/**
 */

use \php\Boot;
use \php\Lib;
use \php\Web;

class Main {
	/**
	 * @return void
	 */
	public static function main () {
		#Main.hx:10: characters 5-38
		$router = new \Router();
		#Main.hx:12: characters 5-77
		$variablesMiddleware = new \VariablesMiddleware();
		#Main.hx:14: characters 5-77
		$structureMiddleware = new \StructureMiddleware();
		#Main.hx:16: characters 5-80
		$statisticsMiddleware = new \StatisticsMiddleware();
		#Main.hx:20: characters 5-117
		$variablesMiddleware->AddVariable("time", "The string @&time will always be replaced with this explaining string.");
		#Main.hx:24: characters 5-28
		$router->mapStaticFiles();
		#Main.hx:28: lines 28-30
		$router->addRoute("/dr/hi", function () {
			#Main.hx:29: characters 7-19
			return "Hi!";
		}, "user", \Array_hx::wrap([$structureMiddleware]));
		#Main.hx:32: characters 5-79
		$router->addRoute("/api/create-user", Boot::getStaticClosure(\AuthController::class, 'CreateUser'), "default", new \Array_hx());
		#Main.hx:34: characters 5-74
		$router->addRoute("/api/login", Boot::getStaticClosure(\AuthController::class, 'CreateToken'), "default", new \Array_hx());
		#Main.hx:36: characters 5-84
		$router->addRoute("/api/login-r", Boot::getStaticClosure(\AuthController::class, 'CreateTokenRedirect'), "default", new \Array_hx());
		#Main.hx:38: characters 5-74
		$router->addRoute("/api/logout", Boot::getStaticClosure(\AuthController::class, 'RemoveAuth'), "default", new \Array_hx());
		#Main.hx:40: characters 5-68
		$router->addRoute("/api/routes", Boot::getInstanceClosure($router, 'getRouteList'), "default", new \Array_hx());
		#Main.hx:44: characters 5-94
		$router->addRoute("/", Boot::getStaticClosure(\IndexPage::class, 'Index'), "default", \Array_hx::wrap([
			$structureMiddleware,
			$statisticsMiddleware,
		]));
		#Main.hx:45: characters 5-94
		$router->addRoute("/about", Boot::getStaticClosure(\About::class, 'Index'), "default", \Array_hx::wrap([
			$structureMiddleware,
			$variablesMiddleware,
		]));
		#Main.hx:46: characters 5-92
		$router->addRoute("/demo", Boot::getStaticClosure(\Demo::class, 'Index'), "default", \Array_hx::wrap([
			$structureMiddleware,
			$variablesMiddleware,
		]));
		#Main.hx:50: characters 5-75
		$router->addRoute("/components/login", Boot::getStaticClosure(\LoginComponent::class, 'Index'), "default", new \Array_hx());
		#Main.hx:52: characters 5-81
		$router->addRoute("/components/register", Boot::getStaticClosure(\RegisterComponent::class, 'Index'), "default", new \Array_hx());
		#Main.hx:58: characters 5-75
		$route = $router->getRoute(Web::getURI(), \Array_hx::wrap(["default"]));
		#Main.hx:60: characters 5-47
		$routeOutput = ($route->Function)();
		#Main.hx:63: lines 63-66
		if ($route->MiddleWares === null) {
			#Main.hx:64: characters 7-31
			Lib::println($routeOutput);
			#Main.hx:65: characters 7-13
			return;
		}
		#Main.hx:68: lines 68-70
		$_g = 0;
		$_g1 = $route->MiddleWares;
		while ($_g < $_g1->length) {
			#Main.hx:68: characters 9-11
			$mw = ($_g1->arr[$_g] ?? null);
			#Main.hx:68: lines 68-70
			++$_g;
			#Main.hx:69: characters 7-46
			$routeOutput = $mw->Output($routeOutput, new \Array_hx());
		}
		#Main.hx:76: characters 5-29
		Lib::println($routeOutput);
	}

	/**
	 * @return void
	 */
	public function __construct () {
	}
}

Boot::registerClass(Main::class, 'Main');
