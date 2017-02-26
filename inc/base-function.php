<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
	
	function option($update = false){
		global $db;
		$q = $db->get_results("SELECT * FROM `_options`" , ARRAY_A);
		foreach($q as $opt){
			if(!$update){
				$func = "
				function get_{$opt['option_name']}() {
					if(!function_exists('get_new_{$opt['option_name']}'))
						return '{$opt['option_value']}';
					else
						return get_new_{$opt['option_name']}();
				}
				function _{$opt['option_name']}() {
					if(!function_exists('_new_{$opt['option_name']}'))
						echo '{$opt['option_value']}';
					else
						echo _new_{$opt['option_name']}();
				}
				";
				eval($func);
			}
			else {
				$func = "
				function get_new_{$opt['option_name']}() {
					return '{$opt['option_value']}';
				}
				function _new_{$opt['option_name']}() {
					echo '{$opt['option_value']}';
				}
				";
				eval($func);
			}
		}
	}
	
	function up_option($name , $value){
		global $db;
		$name = clean($name);
		$value = clean($value);
		$q = $db->get_results("SELECT option_value FROM `_options` WHERE `option_name` = '$name' LIMIT 1" , ARRAY_N);
		if($db->num_rows == 1){
			$db->update('_options' , array('option_value'=>$value) , array('option_name'=>$name));
		}
		else
			$db->insert('_options' , array('option_name'=>$name ,'option_value'=>$value));
		
	}
	
	function clean($string){
		global $db;
		$string = trim($string);
		$string = strip_tags($string , '<a><img>');	
		$string = mysqli_real_escape_string($db->dbh, $string);
		return $string;
	}
	
	function version(){
		global $db;
		return $db->db_version();
	}
	
	
	function theme_dir(){
		return get_site_url().'tpl/'.get_theme_name().'/';
	}
	
	function backup_tables()
	{
		global $db;
		$return = "";
		$table = "_link";
		
		$result = mysqli_query($db->dbh , 'SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);
		
		$return .= 'DROP TABLE '.$table.";\n";
		$row2 = mysqli_fetch_row(mysqli_query($db->dbh , 'SHOW CREATE TABLE '.$table));
		$return.= str_replace("\n" , "" , $row2[1]).";\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysqli_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("#\n#","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		
		echo $return;
	}
	
	function is_admin(){
		global $_SESSION;
		$username = isset($_SESSION['user_login']) ? $_SESSION['user_login'] : "";
		$password = isset($_SESSION['user_password']) ? $_SESSION['user_password'] : "";
		if($password == get_user_pass() && $username == get_user_name()){
			return true;
		}
			return false;
	}
	
	function dbsize(){
		global $db;
		$dbsize = 0;
		$result = $db->query( "SHOW TABLE STATUS" );
		while ( $row = mysql_fetch_array ( $result ) )
		{
			$dbsize += $row['Data_length'] + $row['Index_length'];	
		}
		return 'کیلو بایت<b>' . round(($dbsize/1024), 1) ."\n\n".'</b>';
	}
	
	function href_link($id){
		return get_site_url()."link-$id.html";
	}
	
	function versionplcms()
	{
		return '2.1';
	}
	
	function versionchecker()
	{
		return 'http://www.persianlinkcms.ir/lastversion.txt';
	}
	
		function pagination($pages = '', $range = 5 , $admin = false)
	{ 
		$showitems = ($range * 2)+1; 
		$before = "";
		global $paged;
		if(empty($paged)) $paged = 1;
		
		if($admin){
			$before = "act=links&";
		}
		
		if($pages !== 1)
		{
			echo "<div class=\"pagination\"><span>صفحه ".$paged." از ".$pages."</span>";
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='?".$before."page=1'>&laquo; اولین</a>";
			if($paged > 1 && $showitems < $pages) echo "<a href='?".$before."page=".($paged - 1)."'>&lsaquo; قبلی</a>";
	 
			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='?".$before."page=".$i."' class=\"inactive\">".$i."</a>";
				}
			}
	 
			if ($paged < $pages && $showitems < $pages) echo "<a href=\"?".$before."page=".($paged + 1)."\">بعدی &rsaquo;</a>"; 
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='?".$before."page=".$pages."'>آخرین &raquo;</a>";
			echo "</div>\n";
		}
	}	
	
	option();
?>