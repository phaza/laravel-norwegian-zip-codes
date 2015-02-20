<?php namespace NorwegianZipCodes\Commands;

class RemoteZipCodeObject {
	public $id;
	public $name;
	public $municipality_id;
	public $municipality_name;
	public $category;

	public function __construct($id, $name, $municipality_id, $municipality_name, $category) {
		$this->id                = $id;
		$this->name              = $name;
		$this->municipality_id   = $municipality_id;
		$this->municipality_name = $municipality_name;
		$this->category          = $category;
	}
}
