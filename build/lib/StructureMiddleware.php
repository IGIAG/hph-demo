<?php
/**
 */

use \php\Boot;

class StructureMiddleware implements \IMiddleware {
	/**
	 * @return void
	 */
	public function __construct () {
	}

	/**
	 * @param string $input
	 * @param string[]|\Array_hx $params
	 * 
	 * @return string
	 */
	public function Output ($input, $params) {
		#src/Middlewares/StructureMiddleware.hx:5: lines 5-10
		$head = "\x0A        <script src=\"https://unpkg.com/htmx.org@1.9.5\"></script>\x0A        <link href=\"https://fonts.cdnfonts.com/css/intelone-display\" rel=\"stylesheet\">\x0A        <link rel=\"stylesheet/less\" type=\"text/css\" href=\"style.less\" />\x0A        <script src=\"https://cdn.jsdelivr.net/npm/less\" ></script>\x0A        ";
		#src/Middlewares/StructureMiddleware.hx:13: lines 13-24
		return "<html>\x0A        <head>\x0A            " . ($head??'null') . "\x0A        </head>\x0A        <body>\x0A            " . (\NavigationComponent::Index()??'null') . "\x0A            <div class=\"page\">\x0A            " . ($input??'null') . "\x0A            <div class=\"overlay\"></div>\x0A            </div>\x0A        </body>\x0A        </html>";
	}
}

Boot::registerClass(StructureMiddleware::class, 'StructureMiddleware');
