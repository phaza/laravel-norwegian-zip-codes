<?php namespace NorwegianZipCodes\Events;

/**
 * Data transfer object sent in an event when the update script has run
 *
 * @package NorwegianZipCodes\Events
 */
class ZipCodesUpdated {
	/**
	 * How many new objects were added to the database
	 * @var int
	 */
	public $added;

	/**
	 * How many objects were changed in the database
	 * @var integer
	 */
	public $changed;

	public function __construct($added, $changed) {

		$this->added   = $added;
		$this->changed = $changed;
	}
}
