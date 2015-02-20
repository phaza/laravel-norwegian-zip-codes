<?php

use NorwegianZipCodes\Models\County;
use Orchestra\Testbench\TestCase;

class CountyTest extends TestCase {
	public function testIdIsAlwaysFourDigits() {
		$model = new County(['id' => 1, 'name' => 'Test']);
		$this->assertTrue('01' === $model->id);
	}

	public function testIdSetter() {
		$model = new County(['id' => 1, 'name' => 'Test']);
		$this->assertTrue('01' === $model->getAttributes()['id']);
	}

}
