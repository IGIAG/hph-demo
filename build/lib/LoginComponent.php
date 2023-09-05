<?php
/**
 */

use \php\Boot;

class LoginComponent {
	/**
	 * @return string
	 */
	public static function Index () {
		#src/Components/LoginComponent.hx:6: lines 6-13
		if (\AuthLib::CheckAuthAuto("user")->isSuccess) {
			#src/Components/LoginComponent.hx:7: lines 7-12
			return "<div class=\"loginComponent\">\x0A            \x0A            <h1>You are already logged in!</h1>\x0A            \x0A            </div>\x0A            ";
		}
		#src/Components/LoginComponent.hx:16: lines 16-26
		return "<div class=\"loginComponent\"><h1>Login component</h1>\x0A        <form action=\"/api/login-r\" method=\"post\">\x0A        <label for=\"username\">Username:</label>\x0A        <input type=\"text\" id=\"username\" name=\"username\" required>\x0A        <br>\x0A        <label for=\"password\">Password:</label>\x0A        <input type=\"text\" id=\"password\" name=\"password\" required>\x0A        <br>\x0A        <input type=\"submit\" value=\"Submit\">\x0A        </form></div>\x0A        ";
	}
}

Boot::registerClass(LoginComponent::class, 'LoginComponent');
