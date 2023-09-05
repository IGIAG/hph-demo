<?php
/**
 */

use \php\Boot;

class CreateTokenForm {
	/**
	 * @var string
	 */
	public $password;
	/**
	 * @var string
	 */
	public $username;

	/**
	 * @param string $username
	 * @param string $password
	 * 
	 * @return void
	 */
	public function __construct ($username, $password) {
		#src/Libraries/AuthLib.hx:34: characters 9-33
		$this->username = $username;
		#src/Libraries/AuthLib.hx:35: characters 9-33
		$this->password = $password;
	}
}

Boot::registerClass(CreateTokenForm::class, 'CreateTokenForm');
