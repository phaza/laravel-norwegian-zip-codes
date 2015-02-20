<?php namespace NorwegianZipCodes\Models;

use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model {

	protected $fillable = [
		'id',
	  'name'
	];

	public function setIdAttribute($value) {
		$this->attributes['id'] = str_pad($value, 4, '0', STR_PAD_LEFT);
	}

	public function municipalities() {
		return $this->belongsTo(Municipality::class);
	}
}
