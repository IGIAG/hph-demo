<?php
/**
 */

use \php\Boot;

class Portfolio {
	/**
	 * @return string
	 */
	public static function Index () {
		#src/Pages/Portfolio.hx:8: lines 8-19
		return "\x0A        <div id=\"codepage\">\x0A        <h2>Moje portfolio</h2>\x0A\x0A        <ul>\x0A        <li>MindPro - Strona główna gabinetu psychologicznego.</li>\x0A        <li>AiLuvU - Strona główna aplikacji randkowej AI ORAZ cała aplikacja AiLuvU</li>\x0A        <li>Mój Github</li>\x0A        </ul>\x0A\x0A        </div>\x0A        ";
	}
}

Boot::registerClass(Portfolio::class, 'Portfolio');
