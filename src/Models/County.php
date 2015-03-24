<?php namespace NorwegianZipCodes\Models;

use Illuminate\Database\Eloquent\Model;

class County extends Model {

	public $incrementing = false;

	protected $fillable = [
		'id',
		'name'
	];

	public static function find( $id, $columns = [ '*' ] ) {
		return parent::find( static::pad_id($id), $columns );
	}


	public function setIdAttribute($value) {
		$this->attributes['id'] = static::pad_id($value);
	}

	private static function pad_id($value) {
		return str_pad($value, 2, '0', STR_PAD_LEFT);
	}

	public function municipalities() {
		return $this->hasMany(Municipality::class);
	}
}
