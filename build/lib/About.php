<?php
/**
 */

use \php\Boot;

class About {
	/**
	 * @return string
	 */
	public static function Index () {
		#src/Pages/About.hx:8: lines 8-13
		return "\x0A        <div id=\"codepage\">\x0A        <h2>About HPH</h2>\x0A        HPH is a cool framework. Why? Because I said so.\x0A        </div>\x0A        ";
	}
}

Boot::registerClass(About::class, 'About');
