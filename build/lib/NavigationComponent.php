<?php
/**
 */

use \php\Boot;
use \php\Web;

class NavigationComponent {
	/**
	 * @return string
	 */
	public static function ApplyAccounting () {
		#src/Components/NavigationComponent.hx:17: lines 17-24
		if (\AuthLib::CheckAuthAuto("user")->isSuccess) {
			#src/Components/NavigationComponent.hx:18: lines 18-19
			return "<div class=\"Element\">Hi " . ((Web::getCookies()->data["User"] ?? null)??'null') . "</div>\x0A            <div class=\"Element\"><form method=\"post\" action=\"/api/logout\"><button type=\"submit\">Log out</button></form></div>";
		} else {
			#src/Components/NavigationComponent.hx:22: lines 22-23
			return "<div class=\"Element\" hx-target=\".page\" hx-get=\"/components/login\" hx-swap=\"innerHTML\">Login</div>\x0A            <div class=\"Element\" hx-target=\".page\" hx-get=\"/components/register\" hx-swap=\"innerHTML\">Register</div>";
		}
	}

	/**
	 * @return string
	 */
	public static function Index () {
		#src/Components/NavigationComponent.hx:5: lines 5-13
		return "\x0A        <div class=\"NavigationContainer\">\x0A            <a class=\"Logo\" href=\"/\" >HPH</a>\x0A            <div class=\"Grow\"></div>\x0A            " . (NavigationComponent::ApplyAccounting()??'null') . "\x0A            <a class=\"Element\" href=\"/about\">About</a>\x0A            <a class=\"Element\" href=\"/demo\">Demo</a>\x0A        </div>\x0A        ";
	}
}

Boot::registerClass(NavigationComponent::class, 'NavigationComponent');
