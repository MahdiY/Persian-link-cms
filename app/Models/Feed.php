<?php
/**
 * Developer : MahdiY
 * Web Site  : MahdiY.IR
 * E-Mail    : M@hdiY.IR
 */

namespace App\Models;

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

}