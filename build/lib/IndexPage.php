<?php
/**
 */

use \php\Boot;
use \redis\Redis;

class IndexPage {
	/**
	 * @return string
	 */
	public static function GetViews () {
		#src/Pages/IndexPage.hx:39: characters 9-41
		$db = new Redis("localhost");
		#src/Pages/IndexPage.hx:41: characters 9-31
		return $db->get("views");
	}

	/**
	 * @return string
	 */
	public static function Index () {
		#src/Pages/IndexPage.hx:9: lines 9-36
		return "\x0A        <div id=\"gridFullPage\">\x0A            <div id=\"introGridElement\">\x0A                <h2>Hi!</h2>\x0A                <p>Something about the framework.</p>\x0A                </div>\x0A            <div id=\"statusGridElement\">\x0A                <h2>Statistics (not working yet)</h2>\x0A                <p>Wyświetlenia: " . (IndexPage::GetViews()??'null') . "</p>\x0A                <p>Konta: 38</p>\x0A                <p>Dni online: 40</p>\x0A            </div>\x0A            <div id=\"pidGridElement\">\x0A                <h2>Features:</h2>\x0A                <p>Language: HAXE</p>\x0A                <p>Features:</p>\x0A                <ul>\x0A                <li>Feature</li>\x0A                <li>Feature</li>\x0A                <li>Feature</li>\x0A                <li>Feature</li>\x0A                <li>Feature</li>\x0A                <li>Feature</li>\x0A                </ul>\x0A            </div>\x0A            \x0A        </div>\x0A        ";
	}
}

Boot::registerClass(IndexPage::class, 'IndexPage');
