<?php
/**
 */

use \php\Boot;
use \php\Web;
use \redis\Redis;
use \uuid\Uuid;

class AuthLib {
	/**
	 * @param string $permission
	 * 
	 * @return \GenericResponse
	 */
	public static function CheckAuthAuto ($permission) {
		#src/Libraries/AuthLib.hx:113: characters 47-71
		$checkAuthForm = (Web::getCookies()->data["User"] ?? null);
		#src/Libraries/AuthLib.hx:113: characters 9-98
		$checkAuthForm1 = new \CheckAuthForm($checkAuthForm, (Web::getCookies()->data["Auth"] ?? null));
		#src/Libraries/AuthLib.hx:117: lines 117-119
		if ($permission === "default") {
			#src/Libraries/AuthLib.hx:118: characters 13-59
			return new \GenericResponse("Authorized!", true);
		}
		#src/Libraries/AuthLib.hx:121: lines 121-123
		if (($checkAuthForm1->username === null) || ($checkAuthForm1->token === null)) {
			#src/Libraries/AuthLib.hx:122: characters 13-62
			return new \GenericResponse("Unauthorized!", false);
		}
		#src/Libraries/AuthLib.hx:125: characters 9-41
		$db = new Redis("localhost");
		#src/Libraries/AuthLib.hx:127: lines 127-129
		if (!(($db->get("user." . ($checkAuthForm1->username??'null') . ".token") === $checkAuthForm1->token) && ($checkAuthForm1->token !== null))) {
			#src/Libraries/AuthLib.hx:128: characters 13-62
			return new \GenericResponse("Unauthorized!", false);
		}
		#src/Libraries/AuthLib.hx:130: characters 9-55
		return new \GenericResponse("Authorized!", true);
	}

	/**
	 * @param \CreateTokenForm $tokenCreationForm
	 * 
	 * @return \GenericResponse
	 */
	public static function CreateToken ($tokenCreationForm) {
		#src/Libraries/AuthLib.hx:66: characters 9-41
		$db = new Redis("localhost");
		#src/Libraries/AuthLib.hx:69: lines 69-71
		if ($db->get("user." . ($tokenCreationForm->username??'null') . ".password") !== $tokenCreationForm->password) {
			#src/Libraries/AuthLib.hx:70: characters 13-74
			return new \GenericResponse("Bad username or password!", false);
		}
		#src/Libraries/AuthLib.hx:73: characters 9-42
		$token = Uuid::nanoId();
		#src/Libraries/AuthLib.hx:75: characters 9-65
		$db->set("user." . ($tokenCreationForm->username??'null') . ".token", $token);
		#src/Libraries/AuthLib.hx:77: characters 9-47
		return new \GenericResponse($token, true);
	}

	/**
	 * @param \CreateUserForm $userCreationForm
	 * 
	 * @return \GenericResponse
	 */
	public static function CreateUser ($userCreationForm) {
		#src/Libraries/AuthLib.hx:52: characters 9-41
		$db = new Redis("localhost");
		#src/Libraries/AuthLib.hx:54: lines 54-56
		if ($db->exists("user." . ($userCreationForm->username??'null') . ".password")) {
			#src/Libraries/AuthLib.hx:55: characters 13-69
			return new \GenericResponse("User already exists!", false);
		}
		#src/Libraries/AuthLib.hx:58: characters 9-88
		$db->set("user." . ($userCreationForm->username??'null') . ".password", $userCreationForm->password);
		#src/Libraries/AuthLib.hx:60: characters 9-80
		$db->set("user." . ($userCreationForm->username??'null') . ".permissions", "default,user");
		#src/Libraries/AuthLib.hx:62: characters 9-57
		return new \GenericResponse("User created!", true);
	}
}

Boot::registerClass(AuthLib::class, 'AuthLib');
