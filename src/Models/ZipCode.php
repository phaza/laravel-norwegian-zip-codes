<?php namespace NorwegianZipCodes\Models;

use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model {

	public $incrementing = false;

	protected $fillable = [
		'id',
		'name'
	];

	public static function find( $id, $columns = [ '*' ] ) {
		$id = is_array( $id ) ? array_map( 'static::pad_id', (array) $id ) : static::pad_id( $id );

		return static::query()->find( $id, $columns );
	}

	private static function pad_id( $value ) {
		return str_pad( $value, 4, '0', STR_PAD_LEFT );
	}

	public function setIdAttribute( $value ) {
		$this->attributes['id'] = static::pad_id( $value );
	}

	public function municipalities() {
		return $this->belongsTo( Municipality::class );
	}
}
