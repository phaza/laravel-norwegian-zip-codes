<?php namespace NorwegianZipCodes\Models;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model {

	protected $fillable = [
		'id',
		'name'
	];

	public function setIdAttribute($value) {
		$this->attributes['id'] = str_pad($value, 4, '0', STR_PAD_LEFT);
	}

	public function county() {
		return $this->belongsTo(County::class);
	}

	public function zip_codes() {
		return $this->hasMany(ZipCode::class);
	}
}
