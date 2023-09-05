<?php
/**
 */

use \php\Boot;

class RouteDefinition {
	/**
	 * @var \Closure
	 */
	public $Function;
	/**
	 * @var \IMiddleware[]|\Array_hx
	 */
	public $MiddleWares;
	/**
	 * @var string
	 */
	public $Permission;

	/**
	 * @param \Closure $Function
	 * @param string $Permission
	 * @param \IMiddleware[]|\Array_hx $MiddleWares
	 * 
	 * @return void
	 */
	public function __construct ($Function, $Permission, $MiddleWares) {
		#src/Router.hx:88: characters 9-33
		$this->Function = $Function;
		#src/Router.hx:89: characters 9-37
		$this->Permission = $Permission;
		#src/Router.hx:90: characters 9-39
		$this->MiddleWares = $MiddleWares;
	}
}

Boot::registerClass(RouteDefinition::class, 'RouteDefinition');
