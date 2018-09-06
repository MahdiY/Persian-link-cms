<?php
/**
 * Developer : MahdiY
 * Web Site  : MahdiY.IR
 * E-Mail    : M@hdiY.IR
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Feed
 *
 * @package App\Models
 * @property integer $id
 * @property string  $title
 * @property string  $link
 * @property bool    $status
 * @property integer $time
 */
class Feed extends Model
{

	protected $table = '_feeds';

	protected $fillable = [
		'title',
		'link',
		'status',
		'time',
	];

	public $timestamps = NULL;

	// Scopes

	public function scopeActive(Builder $query)
	{
		return $query->where('status', 1);
	}
}