<?php
/**
 */

use \php\Boot;

class GenericResponse {
	/**
	 * @var bool
	 */
	public $isSuccess;
	/**
	 * @var string
	 */
	public $response;

	/**
	 * @param string $response
	 * @param bool $isSuccess
	 * 
	 * @return void
	 */
	public function __construct ($response, $isSuccess) {
		#src/Libraries/AuthLib.hx:24: characters 9-33
		$this->response = $response;
		#src/Libraries/AuthLib.hx:25: characters 9-35
		$this->isSuccess = $isSuccess;
	}
}

Boot::registerClass(GenericResponse::class, 'GenericResponse');
