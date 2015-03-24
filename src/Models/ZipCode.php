<?php namespace NorwegianZipCodes\Models;

use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model {

	public $incrementing = false;

	protected $fillable = [
		'id',
	  'name'
	];

	public static function find( $id, $columns = [ '*' ] ) {
		return parent::find( static::pad_id($id), $columns );
	}

	private static function pad_id($value) {
		return str_pad($value, 4, '0', STR_PAD_LEFT);
	}

	public function setIdAttribute($value) {
		$this->attributes['id'] = static::pad_id($value);
	}

	public function municipalities() {
		return $this->belongsTo(Municipality::class);
	}
}
