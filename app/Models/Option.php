<?php
/**
 * Developer : MahdiY
 * Web Site  : MahdiY.IR
 * E-Mail    : M@hdiY.IR
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Option
 * @package App\Models
 * @property integer $option_id
 * @property string $option_name
 * @property string $option_value
 */
class Option extends Model {

	protected $table = '_options';

}