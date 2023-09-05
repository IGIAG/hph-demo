<?php
/**
 */

namespace sys\io;

use \php\Boot;

/**
 * API for reading and writing files.
 * See `sys.FileSystem` for the complementary file system API.
 */
class File {
	/**
	 * Retrieves the content of the file specified by `path` as a String.
	 * If the file does not exist or can not be read, an exception is thrown.
	 * `sys.FileSystem.exists` can be used to check for existence.
	 * If `path` is null, the result is unspecified.
	 * 
	 * @param string $path
	 * 
	 * @return string
	 */
	public static function getContent ($path) {
		#/usr/share/haxe/std/php/_std/sys/io/File.hx:30: characters 3-33
		return \file_get_contents($path);
	}
}

Boot::registerClass(File::class, 'sys.io.File');
