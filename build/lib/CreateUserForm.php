<?php
/**
 */

use \php\Boot;

class CreateUserForm {
	/**
	 * @var string
	 */
	public $password;
	/**
	 * @var string[]|\Array_hx
	 */
	public $permissions;
	/**
	 * @var string
	 */
	public $username;

	/**
	 * @param string $username
	 * @param string $password
	 * @param string[]|\Array_hx $permissions
	 * 
	 * @return void
	 */
	public function __construct ($username, $password, $permissions) {
		#src/Libraries/AuthLib.hx:14: characters 9-33
		$this->username = $username;
		#src/Libraries/AuthLib.hx:15: characters 9-33
		$this->password = $password;
		#src/Libraries/AuthLib.hx:16: characters 9-39
		$this->permissions = $permissions;
	}
}

Boot::registerClass(CreateUserForm::class, 'CreateUserForm');
