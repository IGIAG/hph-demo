<?php
/**
 */

use \php\_Boot\HxAnon;
use \php\Boot;
use \haxe\Log;
use \sys\io\File;
use \php\_Boot\HxString;
use \haxe\Exception as HaxeException;
use \haxe\ds\StringMap;
use \sys\FileSystem;

class Router {
	/**
	 * @var StringMap
	 */
	public $routes;

	/**
	 * @param string $fileName
	 * 
	 * @return string
	 */
	public static function getContentType ($fileName) {
		#src/Router.hx:60: characters 9-75
		$extension = HxString::substring($fileName, HxString::lastIndexOf($fileName, ".") + 1);
		#src/Router.hx:62: characters 17-40
		$__hx__switch = (mb_strtolower($extension));
		if ($__hx__switch === "css") {
			#src/Router.hx:64: characters 25-42
			return "text/css";
		} else if ($__hx__switch === "gif") {
			#src/Router.hx:70: characters 25-43
			return "image/gif";
		} else if ($__hx__switch === "html") {
			#src/Router.hx:63: characters 26-44
			return "text/html";
		} else if ($__hx__switch === "jpeg") {
			#src/Router.hx:69: characters 26-45
			return "image/jpeg";
		} else if ($__hx__switch === "jpg") {
			#src/Router.hx:68: characters 25-44
			return "image/jpeg";
		} else if ($__hx__switch === "js") {
			#src/Router.hx:65: characters 24-55
			return "application/javascript";
		} else if ($__hx__switch === "json") {
			#src/Router.hx:66: characters 26-51
			return "application/json";
		} else if ($__hx__switch === "less") {
			#src/Router.hx:73: characters 26-44
			return "text/less";
		} else if ($__hx__switch === "pdf") {
			#src/Router.hx:71: characters 25-49
			return "application/pdf";
		} else if ($__hx__switch === "png") {
			#src/Router.hx:67: characters 25-43
			return "image/png";
		} else if ($__hx__switch === "txt") {
			#src/Router.hx:72: characters 25-44
			return "text/plain";
		} else {
			#src/Router.hx:74: characters 22-55
			return "application/octet-stream";
		}
	}

	/**
	 * @return void
	 */
	public function __construct () {
		#src/Router.hx:9: characters 56-58
		$this->routes = new StringMap();
	}

	/**
	 * @param string $route
	 * @param \Closure $work
	 * @param string $permission
	 * @param \IMiddleware[]|\Array_hx $middlewares
	 * 
	 * @return void
	 */
	public function addRoute ($route, $work, $permission, $middlewares) {
		#src/Router.hx:11: characters 9-75
		$this1 = $this->routes;
		$value = new \RouteDefinition($work, $permission, $middlewares);
		$this1->data[$route] = $value;
	}

	/**
	 * @param string $route
	 * @param string[]|\Array_hx $permissions
	 * 
	 * @return \RouteDefinition
	 */
	public function getRoute ($route, $permissions) {
		#src/Router.hx:14: characters 9-65
		$routeDefinition = ($this->routes->data[$route] ?? null);
		#src/Router.hx:16: lines 16-18
		if ($permissions->indexOf($routeDefinition->Permission) !== -1) {
			#src/Router.hx:17: characters 20-37
			return ($this->routes->data[$route] ?? null);
		}
		#src/Router.hx:19: lines 19-21
		return new \RouteDefinition(function () {
			#src/Router.hx:20: characters 13-32
			return "Forbidden!";
		}, "default", new \Array_hx());
	}

	/**
	 * @return string
	 */
	public function getRouteList () {
		#src/Router.hx:25: characters 47-60
		$data = array_values(array_map("strval", array_keys($this->routes->data)));
		$routesIterator_current = 0;
		$routesIterator_length = count($data);
		$routesIterator_data = $data;
		#src/Router.hx:26: characters 9-77
		$outputString = "<h2>Here are the registered paths:</h2>";
		#src/Router.hx:27: lines 27-29
		while ($routesIterator_current < $routesIterator_length) {
			#src/Router.hx:28: characters 13-62
			$outputString = ($outputString??'null') . "<p>" . ($routesIterator_data[$routesIterator_current++]??'null') . "</p>";
		}
		#src/Router.hx:30: characters 9-28
		return $outputString;
	}

	/**
	 * @return void
	 */
	public function mapStaticFiles () {
		#src/Router.hx:37: characters 9-73
		$files = FileSystem::readDirectory("./wwwroot");
		#src/Router.hx:38: characters 9-23
		$i = 0;
		#src/Router.hx:40: lines 40-54
		$_g = 0;
		while ($_g < $files->length) {
			unset($file);
			#src/Router.hx:40: characters 13-17
			$file = ($files->arr[$_g] ?? null);
			#src/Router.hx:40: lines 40-54
			++$_g;
			#src/Router.hx:41: characters 13-67
			$applyHtml = Router::getContentType($file) === "text/html";
			#src/Router.hx:43: lines 43-53
			$this->addRoute("/" . ($file??'null'), function () use (&$file) {
				#src/Router.hx:44: lines 44-52
				try {
					#src/Router.hx:45: characters 21-81
					$fileContent = File::getContent("./wwwroot/" . ($file??'null'));
					#src/Router.hx:47: characters 21-71
					header("Content-Type" . ": " . (Router::getContentType($file)??'null'));
					#src/Router.hx:48: characters 21-39
					return $fileContent;
				} catch(\Throwable $_g) {
					#src/Router.hx:49: characters 26-27
					$e = HaxeException::caught($_g)->unwrap();
					#src/Router.hx:50: characters 21-26
					(Log::$trace)("Error reading file: " . \Std::string($e), new _HxAnon_Router0("src/Router.hx", 50, "Router", "mapStaticFiles"));
					#src/Router.hx:51: characters 21-32
					return null;
				}
			}, "default", new \Array_hx());
		}
	}
}

class _HxAnon_Router0 extends HxAnon {
	function __construct($fileName, $lineNumber, $className, $methodName) {
		$this->fileName = $fileName;
		$this->lineNumber = $lineNumber;
		$this->className = $className;
		$this->methodName = $methodName;
	}
}

Boot::registerClass(Router::class, 'Router');
