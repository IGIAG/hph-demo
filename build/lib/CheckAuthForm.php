<?php
/**
 */

use \php\Boot;

class CheckAuthForm {
	/**
	 * @var string
	 */
	public $token;
	/**
	 * @var string
	 */
	public $username;

	/**
	 * @param string $username
	 * @param string $token
	 * 
	 * @return void
	 */
	public function __construct ($username, $token) {
		#src/Libraries/AuthLib.hx:44: characters 9-33
		$this->username = $username;
		#src/Libraries/AuthLib.hx:45: characters 9-27
		$this->token = $token;
	}
}

Boot::registerClass(CheckAuthForm::class, 'CheckAuthForm');
