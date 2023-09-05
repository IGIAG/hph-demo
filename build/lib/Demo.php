<?php
/**
 */

use \php\Boot;

class Demo {
	/**
	 * @return string
	 */
	public static function Index () {
		#src/Pages/Demo.hx:8: lines 8-22
		return "\x0A        <div id=\"codepage\">\x0A        <h2>Demo:</h2>\x0A        <h3>Dynamic content (Pages):</h3>\x0A        <ul>\x0A        <li>Server time: " . (\Date::now()->getHours()??'null') . ":" . (\Date::now()->getMinutes()??'null') . ":" . (\Date::now()->getSeconds()??'null') . "</li>\x0A        <li>Your IP:" . ($_SERVER["REMOTE_ADDR"]??'null') . "</li>\x0A        </ul>\x0A        <h3>Middleware example (Default variables middleware)</h3>\x0A        <ul>\x0A        <li>Time variable: @&time</li>\x0A        </ul>\x0A\x0A        </div>\x0A        ";
	}
}

Boot::registerClass(Demo::class, 'Demo');
