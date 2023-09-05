<?php
/**
 */

use \php\Boot;
use \php\Web;

class AuthController {
	/**
	 * @return string
	 */
	public static function CreateToken () {
		#src/HTMXControllers/AuthController.hx:34: characters 9-110
		if (Web::getMethod() !== "POST") {
			#src/HTMXControllers/AuthController.hx:34: characters 39-77
			http_response_code(400);
			#src/HTMXControllers/AuthController.hx:34: characters 78-108
			return "Bad request! (Method)";
		}
		#src/HTMXControllers/AuthController.hx:35: characters 9-168
		if (!\HttpUtils::VerifyFields(\Array_hx::wrap([
			"username",
			"password",
		]))) {
			#src/HTMXControllers/AuthController.hx:35: characters 62-100
			http_response_code(400);
			#src/HTMXControllers/AuthController.hx:35: characters 101-166
			return "Bad request! (Parameters! expected:  username, password)";
		}
		#src/HTMXControllers/AuthController.hx:39: characters 9-62
		$form = Web::getMultipart(999);
		#src/HTMXControllers/AuthController.hx:41: characters 80-96
		$response = ($form->data["username"] ?? null);
		#src/HTMXControllers/AuthController.hx:41: characters 9-116
		$response1 = \AuthLib::CreateToken(new \CreateTokenForm($response, ($form->data["password"] ?? null)));
		#src/HTMXControllers/AuthController.hx:43: lines 43-45
		if (!$response1->isSuccess) {
			#src/HTMXControllers/AuthController.hx:44: characters 13-68
			return "<h1>Failure! Reason: " . ($response1->response??'null') . "</h1>";
		}
		#src/HTMXControllers/AuthController.hx:47: characters 9-47
		Web::setCookie("User", ($form->data["username"] ?? null));
		#src/HTMXControllers/AuthController.hx:49: characters 9-48
		Web::setCookie("Auth", $response1->response);
		#src/HTMXControllers/AuthController.hx:51: characters 9-37
		return "<h1>Logged in!</h1>";
	}

	/**
	 * @return string
	 */
	public static function CreateTokenRedirect () {
		#src/HTMXControllers/AuthController.hx:54: characters 9-110
		if (Web::getMethod() !== "POST") {
			#src/HTMXControllers/AuthController.hx:54: characters 39-77
			http_response_code(400);
			#src/HTMXControllers/AuthController.hx:54: characters 78-108
			return "Bad request! (Method)";
		}
		#src/HTMXControllers/AuthController.hx:55: characters 9-168
		if (!\HttpUtils::VerifyFields(\Array_hx::wrap([
			"username",
			"password",
		]))) {
			#src/HTMXControllers/AuthController.hx:55: characters 62-100
			http_response_code(400);
			#src/HTMXControllers/AuthController.hx:55: characters 101-166
			return "Bad request! (Parameters! expected:  username, password)";
		}
		#src/HTMXControllers/AuthController.hx:59: characters 9-62
		$form = Web::getMultipart(999);
		#src/HTMXControllers/AuthController.hx:61: characters 80-96
		$response = ($form->data["username"] ?? null);
		#src/HTMXControllers/AuthController.hx:61: characters 9-116
		$response1 = \AuthLib::CreateToken(new \CreateTokenForm($response, ($form->data["password"] ?? null)));
		#src/HTMXControllers/AuthController.hx:63: lines 63-65
		if (!$response1->isSuccess) {
			#src/HTMXControllers/AuthController.hx:64: characters 13-68
			return "<h1>Failure! Reason: " . ($response1->response??'null') . "</h1>";
		}
		#src/HTMXControllers/AuthController.hx:67: characters 9-47
		Web::setCookie("User", ($form->data["username"] ?? null));
		#src/HTMXControllers/AuthController.hx:69: characters 9-48
		Web::setCookie("Auth", $response1->response);
		#src/HTMXControllers/AuthController.hx:71: characters 9-26
		Web::redirect("/");
		#src/HTMXControllers/AuthController.hx:73: characters 9-37
		return "<h1>Logged in!</h1>";
	}

	/**
	 * @return string
	 */
	public static function CreateUser () {
		#src/HTMXControllers/AuthController.hx:16: characters 9-119
		if (Web::getMethod() !== "POST") {
			#src/HTMXControllers/AuthController.hx:16: characters 39-77
			http_response_code(400);
			#src/HTMXControllers/AuthController.hx:16: characters 78-117
			return "<h1>Bad request! (Method)</h1>";
		}
		#src/HTMXControllers/AuthController.hx:17: characters 9-177
		if (!\HttpUtils::VerifyFields(\Array_hx::wrap([
			"username",
			"password",
		]))) {
			#src/HTMXControllers/AuthController.hx:17: characters 62-100
			http_response_code(400);
			#src/HTMXControllers/AuthController.hx:17: characters 101-175
			return "<h1>Bad request! (Parameters! expected:  username, password)</h1>";
		}
		#src/HTMXControllers/AuthController.hx:21: characters 9-62
		$form = Web::getMultipart(999);
		#src/HTMXControllers/AuthController.hx:23: characters 90-106
		$userCreationResponse = ($form->data["username"] ?? null);
		#src/HTMXControllers/AuthController.hx:23: characters 9-135
		$userCreationResponse1 = \AuthLib::CreateUser(new \CreateUserForm($userCreationResponse, ($form->data["password"] ?? null), \Array_hx::wrap(["user"])));
		#src/HTMXControllers/AuthController.hx:25: lines 25-27
		if ($userCreationResponse1->isSuccess) {
			#src/HTMXControllers/AuthController.hx:26: characters 13-43
			return "<h1>User created</h1>";
		}
		#src/HTMXControllers/AuthController.hx:29: characters 9-76
		return "<h1>Failure! Reason: " . ($userCreationResponse1->response??'null') . "</h1>";
	}

	/**
	 * @return bool
	 */
	public static function RemoveAuth () {
		#src/HTMXControllers/AuthController.hx:80: characters 9-30
		$now = \Date::now();
		#src/HTMXControllers/AuthController.hx:82: characters 9-69
		$oneHourAgo = \Date::fromTime($now->getTime() - 3600000);
		#src/HTMXControllers/AuthController.hx:84: characters 9-65
		$timestamp = (int)(floor($oneHourAgo->getTime() / 1000));
		#src/HTMXControllers/AuthController.hx:86: characters 9-46
		Web::setCookie("User", "", $oneHourAgo);
		#src/HTMXControllers/AuthController.hx:88: characters 9-46
		Web::setCookie("Auth", "", $oneHourAgo);
		#src/HTMXControllers/AuthController.hx:90: characters 9-26
		Web::redirect("/");
		#src/HTMXControllers/AuthController.hx:92: characters 9-20
		return true;
	}
}

Boot::registerClass(AuthController::class, 'AuthController');
