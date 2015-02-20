<?php namespace NorwegianZipCodes\Lib;

use Closure;
use NorwegianZipCodes\Commands\RemoteZipCodeObject;

/**
 * Parses a zip code file on the format
 * zipcode  name  municipality_code municipality_name category
 *
 * @package NorwegianZipCodes\Lib
 */
class RemoteZipCodeFileParser {

	/**
	 * Parse the file and yield $closure for each line
	 * @param callable(RemoteZipCodeObject) $closure
	 */
	public function parse($url, Closure $closure) {
		$handle = fopen($url, 'r');

		stream_filter_append($handle, 'convert.iconv.ISO-8859-15/UTF-8', STREAM_FILTER_READ);

		while(($data = fgetcsv($handle, 0, "\t")) !== false) {
			list( $zip_code, $zip_name, $municipality_code, $municipality_name, $category ) = $data;

			$closure(new RemoteZipCodeObject($zip_code, $zip_name, $municipality_code, $municipality_name, $category));
		}
	}
}
