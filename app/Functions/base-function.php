<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * Version 3.0
 * copyright 2011 - 2018
*/

use App\Classes\pdate;
use App\Models\Option;

$alloptions = NULL;

function get_option($option, $default = "")
{
	global $alloptions;

	$option = trim($option);
	if (empty($option)) {
		return false;
	}

	if (is_null($alloptions)) {
		/** @var Option[] $options */
		$options = Option::all();

		foreach ($options as $_option) {
			$alloptions[$_option->option_name] = $_option->option_value;
		}
	}

	if (isset($alloptions[$option])) {
		return $alloptions[$option];
	}

	/** @var Option $value */
	$value = Option::where('optiona_name', $option)->first();

	if (is_null($value)) {
		return $default;
	}

	$alloptions[$option] = $value->option_value;

	return $value->option_value;
}

function update_option($option, $value)
{
	global $alloptions;

	$option = trim($option);

	if (empty($option)) {
		return false;
	}

	$option = clean($option);
	$value = clean($value);

	$alloptions[$option] = $value;

	/** @var Option $option */
	$option = Option::where('option_name', $option)->first();

	if ($option) {
		$option->update(['option_value' => $value]);
	} else {
		Option::create([
			'option_name'  => $option,
			'option_value' => $value,
		]);
	}
}

function pdate($format, $timestamp = NULL)
{
	return pdate::pdate($format, $timestamp);
}

function clean($string)
{
	global $capsule;

	$string = trim($string);
	$string = strip_tags($string, '<a><img>');
//	$string = mysqli_real_escape_string($capsule->getConnection(), $string);

	return $string;
}

function db_safe($value)
{
	global $capsule;

	return "'" . mysqli_real_escape_string($capsule->getConnection(), $value) . "'";
}

function version()
{
	global $db;

	return $db->db_version();
}

function theme_dir()
{
	return get_option('site_url') . 'tpl/' . get_option('theme_name') . '/';
}

function backup_tables()
{
	global $db;
	$return = "";
	$table = "_link";

	$result = mysqli_query($db->dbh, 'SELECT * FROM ' . $table);
	$num_fields = mysqli_num_fields($result);

	$return .= 'DROP TABLE ' . $table . ";\n";
	$row2 = mysqli_fetch_row(mysqli_query($db->dbh, 'SHOW CREATE TABLE ' . $table));
	$return .= str_replace("\n", "", $row2[1]) . ";\n";

	for ($i = 0; $i < $num_fields; $i++) {

		while ($row = mysqli_fetch_row($result)) {

			$return .= 'INSERT INTO ' . $table . ' VALUES(';

			for ($j = 0; $j < $num_fields; $j++) {
				$row[$j] = addslashes($row[$j]);
				$row[$j] = preg_replace("#\n#", "\\n", $row[$j]);
				if (isset($row[$j])) {
					$return .= '"' . $row[$j] . '"';
				} else {
					$return .= '""';
				}
				if ($j < ($num_fields - 1)) {
					$return .= ',';
				}
			}

			$return .= ");\n";
		}

	}

	echo $return;
}

function is_admin()
{
	$username = isset($_SESSION['user_login']) ? $_SESSION['user_login'] : "";
	$password = isset($_SESSION['user_passw']) ? $_SESSION['user_passw'] : "";

	return $password == get_option('user_pass') && $username == get_option('user_name');
}

function dbsize()
{
	global $db;

	$dbsize = 0;
	$rows = $db->get_results("SHOW TABLE STATUS");

	foreach ($rows as $row) {
		$dbsize += $row->Data_length + $row->Index_length;
	}

	return 'کیلو بایت<b>' . round(($dbsize / 1024), 1) . "\n\n" . '</b>';
}

function href_link($id)
{
	return get_option('site_url') . sprintf("link-%d.html", $id);
}

function versionplcms()
{
	return '2.2';
}

function versionchecker()
{
	try {

		$url = 'http://www.persianlinkcms.ir/lastversion.txt';
		$version = file_get_contents($url, true);
		return floatval($version);

	} catch (Exception $exception) {
		return versionplcms();
	}
}

function pagination($pages = '', $range = 5, $admin = false)
{
	$showitems = ($range * 2) + 1;
	$before = "";
	global $paged;
	if (empty($paged)) {
		$paged = 1;
	}

	if ($admin) {
		$before = "act=links&";
	}

	if ($pages !== 1) {

		echo "<div class=\"pagination\"><span>صفحه " . $paged . " از " . $pages . "</span>";
		if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
			echo "<a href='?" . $before . "page=1'>&laquo; اولین</a>";
		}
		if ($paged > 1 && $showitems < $pages) {
			echo "<a href='?" . $before . "page=" . ($paged - 1) . "'>&lsaquo; قبلی</a>";
		}

		for ($i = 1; $i <= $pages; $i++) {
			if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
				echo ($paged == $i) ? "<span class=\"current\">" . $i . "</span>" : "<a href='?" . $before . "page=" . $i . "' class=\"inactive\">" . $i . "</a>";
			}
		}

		if ($paged < $pages && $showitems < $pages) {
			echo "<a href=\"?" . $before . "page=" . ($paged + 1) . "\">بعدی &rsaquo;</a>";
		}
		if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) {
			echo "<a href='?" . $before . "page=" . $pages . "'>آخرین &raquo;</a>";
		}
		echo "</div>\n";
	}
}
