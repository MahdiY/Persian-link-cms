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
 * Class Link
 *
 * @package App\Models
 * @property integer $id
 * @property string  $title
 * @property string  $url
 * @property integer $time
 * @property string  $date
 * @property integer $counter
 * @property boolean $status
 */
class Link extends Model
{

	protected $table = '_link';

	// Function

	public function date($format)
	{
		return pdate($format, strtotime($this->date));
	}

	public function time($format)
	{
		return pdate($format, $this->time);
	}

	// Scopes

	public function scopeActive(Builder $query)
	{
		return $query->where('status', 1);
	}

}