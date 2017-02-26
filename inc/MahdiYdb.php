<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
	MahdiYdb VER : 1.1	
*/
define( 'OBJECT', 'OBJECT' );
define( 'OBJECT_K', 'OBJECT_K' );
define( 'ARRAY_A', 'ARRAY_A' );
define( 'ARRAY_N', 'ARRAY_N' );
define('DB_CHARSET', 'utf8');
class MahdiYdb {

	var $show_errors = false;
	var $suppress_errors = false;
	var $last_error = '';
	var $num_queries = 0;
	var $num_rows = 0;
	var $rows_affected = 0;
	var $insert_id = 0;
	var $last_query;
	var $last_result;
	protected $result;
	protected $col_info;
	var $queries;
	protected $reconnect_retries = 5;
	var $prefix = '';
	var $ready = false;
	var $field_types = array();
	var $charset;
	var $collate;
	protected $dbuser;
	protected $dbpassword;
	protected $dbname;
	protected $dbhost;
	protected $dbh;
	var $func_call;
	private $has_connected = false;
	
	function __construct( $dbuser, $dbpassword, $dbname, $dbhost ) {
		register_shutdown_function( array( $this, '__destruct' ) );

		if ( $this->show_errors )
			$this->show_errors();

		$this->init_charset();

		$this->dbuser = $dbuser;
		$this->dbpassword = $dbpassword;
		$this->dbname = $dbname;
		$this->dbhost = $dbhost;

		$this->db_connect();
	}

	function __destruct() {
		return true;
	}
	
	function __get( $name ) {
		if ( 'col_info' == $name )
			$this->load_col_info();

		return $this->$name;
	}
	
	function __set( $name, $value ) {
		$this->$name = $value;
	}
	
	function __isset( $name ) {
		return isset( $this->$name );
	}
	
	function __unset( $name ) {
		unset( $this->$name );
	}
	
	function init_charset() {
		if ( defined( 'DB_CHARSET' ) )
			$this->charset = DB_CHARSET;
	}
	
	function set_charset( $dbh, $charset = null, $collate = null ) {
		if ( ! isset( $charset ) )
			$charset = $this->charset;
		if ( ! isset( $collate ) )
			$collate = $this->collate;
		if ( $this->has_cap( 'collation' ) && ! empty( $charset ) ) {

			if ( function_exists( 'mysqli_set_charset' ) && $this->has_cap( 'set_charset' ) ) {
				mysqli_set_charset( $dbh, $charset );
			} else {
				$query = $this->prepare( 'SET NAMES %s', $charset );
				if ( ! empty( $collate ) )
					$query .= $this->prepare( ' COLLATE %s', $collate );
				mysqli_query( $query, $dbh );
			}

		}
	}
	
	function set_prefix( $prefix, $set_table_names = false , $tbname = Array()) {
		
		if($set_table_names){
			foreach($this->tables() as $tb){
				
				if(in_array($tb , $tbname)){
				
					$new_name = $prefix.$tb;
					mysqli_query($this->dbh , "rename table $tb to $new_name");
				
				}
			}
		}
		else
			$this->prefix = $prefix;
		
	}
	
	function prefix( $tbname ) {
		
		return $this->prefix.$tbname;
		
	}
	
	function tables(){
		
		$q = mysqli_query($this->dbh ,'show tables');
		while($tb = mysqli_fetch_array($q)){
		
			$new_array[] = $tb[0];
		
		}
		return $new_array;
	}
	
	function select( $db, $dbh = null ) {
		if ( is_null($dbh) )
			$dbh = $this->dbh;

		$success = @mysqli_select_db( $dbh, $db );

		if ( ! $success ) {
			$this->ready = false;
				$this->bail( sprintf('<h1>Can&#8217;t select database</h1>
<p>We were able to connect to the database server (which means your username and password is okay) but not able to select the <code>%1$s</code> database.</p>
<ul>
<li>Are you sure it exists?</li>
<li>Does the user <code>%2$s</code> have permission to use the <code>%1$s</code> database?</li>
<li>On some systems the name of your database is prefixed with your username, so it would be like <code>username_%1$s</code>. Could that be the problem?</li>
</ul>', htmlspecialchars( $db, ENT_QUOTES ), htmlspecialchars( $this->dbuser, ENT_QUOTES ) ), 'db_select_fail' );
			
			return;
		}
	}
	
	function prepare( $query, $args ) {
		if ( is_null( $query ) )
			return;

		$args = func_get_args();
		array_shift( $args );
		
		if ( isset( $args[0] ) && is_array($args[0]) )
			$args = $args[0];
		$query = str_replace( "'%s'", '%s', $query ); 
		$query = str_replace( '"%s"', '%s', $query ); 
		$query = preg_replace( '|(?<!%)%f|' , '%F', $query ); 
		$query = preg_replace( '|(?<!%)%s|', "'%s'", $query ); 
		array_walk( $args, array( $this, 'escape_by_ref' ) );
		return @vsprintf( $query, $args );
	}
	
	function print_error( $str = '' ) {
		global $EZSQL_ERROR;

		if ( !$str ) {
		
			$str = mysqli_error( $this->dbh );

		}
		$EZSQL_ERROR[] = array( 'query' => $this->last_query, 'error_str' => $str );

		if ( $this->suppress_errors )
			return false;

		$error_str = sprintf( 'database error %1$s for query %2$s' , $str, $this->last_query );

		error_log( $error_str );

		if ( ! $this->show_errors )
			return false;

		$str   = htmlspecialchars( $str, ENT_QUOTES );
		$query = htmlspecialchars( $this->last_query, ENT_QUOTES );

		print "<div id='error'>
		<p class='MahdiYdberror'><strong>database error:</strong> [$str]<br />
		<code>$query</code></p>
		</div>";
		
	}
	
	function show_errors( $show = true ) {
		$errors = $this->show_errors;
		$this->show_errors = $show;
		return $errors;
	}
	
	function hide_errors() {
		$show = $this->show_errors;
		$this->show_errors = false;
		return $show;
	}
	
	function suppress_errors( $suppress = true ) {
		$errors = $this->suppress_errors;
		$this->suppress_errors = (bool) $suppress;
		return $errors;
	}
	
	function flush() {
		$this->last_result = array();
		$this->col_info    = null;
		$this->last_query  = null;
		$this->rows_affected = $this->num_rows = 0;
		$this->last_error  = '';

		if ( is_resource( $this->result ) ) {

			mysqli_free_result( $this->result );

		}
	}
	
	function db_connect( $allow_bail = true ) {

		$this->is_mysql = true;

		$new_link = defined( 'MYSQL_NEW_LINK' ) ? MYSQL_NEW_LINK : true;
		$client_flags = defined( 'MYSQL_CLIENT_FLAGS' ) ? MYSQL_CLIENT_FLAGS : 0;

			$this->dbh = mysqli_init();

			$port = null;
			$socket = null;
			$host = $this->dbhost;
			$port_or_socket = strstr( $host, ':' );
			if ( ! empty( $port_or_socket ) ) {
				$host = substr( $host, 0, strpos( $host, ':' ) );
				$port_or_socket = substr( $port_or_socket, 1 );
				if ( 0 !== strpos( $port_or_socket, '/' ) ) {
					$port = intval( $port_or_socket );
					$maybe_socket = strstr( $port_or_socket, ':' );
					if ( ! empty( $maybe_socket ) ) {
						$socket = substr( $maybe_socket, 1 );
					}
				} else {
					$socket = $port_or_socket;
				}
			}

			if ( $this->show_errors ) {
				mysqli_real_connect( $this->dbh, $host, $this->dbuser, $this->dbpassword, null, $port, $socket, $client_flags );
			} else {
				@mysqli_real_connect( $this->dbh, $host, $this->dbuser, $this->dbpassword, null, $port, $socket, $client_flags );
			}

			if ( $this->dbh->connect_errno ) {
				$this->dbh = null;

				$attempt_fallback = true;

				if ( $this->has_connected ) {
					$attempt_fallback = false;
				} else if ( ! function_exists( 'mysql_connect' ) ) {
					$attempt_fallback = false;
				}

				if ( $attempt_fallback ) {
					$this->use_mysqli = false;
					$this->db_connect();
				}
			}
			
			
		if ( ! $this->dbh && $allow_bail ) {


			$this->bail( sprintf( __( "
<h1>Error establishing a database connection</h1>
<p>This either means that the username and password information in your <code>wp-config.php</code> file is incorrect or we can't contact the database server at <code>%s</code>. This could mean your host's database server is down.</p>
<ul>
	<li>Are you sure you have the correct username and password?</li>
	<li>Are you sure that you have typed the correct hostname?</li>
	<li>Are you sure that the database server is running?</li>
</ul>
" ), htmlspecialchars( $this->dbhost, ENT_QUOTES ) ), 'db_connect_fail' );

			return false;
		} else if ( $this->dbh ) {
			$this->has_connected = true;
			$this->set_charset( $this->dbh );
			$this->ready = true;
			$this->select( $this->dbname, $this->dbh );

			return true;
		}

		return false;
	}
	
	function check_connection( $allow_bail = true ) {

		if ( @mysqli_ping( $this->dbh ) ) {
				return true;
		}


		$error_reporting = false;

		if ( $this->show_errors ) {
			$error_reporting = error_reporting();
			error_reporting( $error_reporting & ~E_WARNING );
		}

		for ( $tries = 1; $tries <= $this->reconnect_retries; $tries++ ) {
		
			if ( $this->reconnect_retries === $tries && $this->show_errors ) {
				error_reporting( $error_reporting );
			}

			if ( $this->db_connect( false ) ) {
				if ( $error_reporting ) {
					error_reporting( $error_reporting );
				}

				return true;
			}

			sleep( 1 );
		}

		if ( did_action( 'template_redirect' ) ) {
			return false;
		}

		if ( ! $allow_bail ) {
			return false;
		}

		$this->bail( sprintf( ( "
<h1>Error reconnecting to the database</h1>
<p>This means that we lost contact with the database server at <code>%s</code>. This could mean your host's database server is down.</p>
<ul>
	<li>Are you sure that the database server is running?</li>
	<li>Are you sure that the database server is not under particularly heavy load?</li>
</ul>
<p>If you're unsure what these terms mean you should probably contact your host. If you still need help you can always visit the <a href='https://wordpress.org/support/'>WordPress Support Forums</a>.</p>
" ), htmlspecialchars( $this->dbhost, ENT_QUOTES ) ), 'db_connect_fail' );

		dead_db();
	}
	
	function query( $query ) {
		if ( ! $this->ready ){
			return false;
		}
			
		$return_val = 0;
		$this->flush();

		$this->func_call = "\$db->query(\"$query\")";

		$this->last_query = $query;

		$this->_do_query( $query );

		$mysql_errno = 0;
		if ( ! empty( $this->dbh ) ) {
		
			$mysql_errno = mysqli_errno( $this->dbh );

		}

		if ( empty( $this->dbh ) || 2006 == $mysql_errno ) {
			if ( $this->check_connection() ) {
				$this->_do_query( $query );
			} else {
				$this->insert_id = 0;
				return false;
			}
		}

		$this->last_error = mysqli_error( $this->dbh );


		if ( $this->last_error ) {
		
			if ( $this->insert_id && preg_match( '/^\s*(insert|replace)\s/i', $query ) )
				$this->insert_id = 0;

			$this->print_error();
			return false;
		}

		if ( preg_match( '/^\s*(create|alter|truncate|drop)\s/i', $query ) ) {
			$return_val = $this->result;
		} elseif ( preg_match( '/^\s*(insert|delete|update|replace)\s/i', $query ) ) {
			
			$this->rows_affected = mysqli_affected_rows( $this->dbh );

			if ( preg_match( '/^\s*(insert|replace)\s/i', $query ) ) {

				$this->insert_id = mysqli_insert_id( $this->dbh );
			}
			
			$return_val = $this->rows_affected;
		} else {
			$num_rows = 0;
			
			while ( $row = @mysqli_fetch_object( $this->result ) ) {
				$this->last_result[$num_rows] = $row;
				$num_rows++;
			}
			
			$this->num_rows = $num_rows;
			$return_val     = $num_rows;
		}

		return $return_val;
	}
	
	private function _do_query( $query ) {
		if ( defined( 'SAVEQUERIES' ) && SAVEQUERIES ) {
			$this->timer_start();
		}

		$this->result = @mysqli_query( $this->dbh, $query );

		$this->num_queries++;

		if ( defined( 'SAVEQUERIES' ) && SAVEQUERIES ) {
			$this->queries[] = array( $query, $this->timer_stop(), $this->get_caller() );
		}
	}
	
	function insert( $table, $data, $format = null ) {
		return $this->_insert_replace_helper( $table, $data, $format, 'INSERT' );
	}
	
	function replace( $table, $data, $format = null ) {
		return $this->_insert_replace_helper( $table, $data, $format, 'REPLACE' );
	}
	
	function _insert_replace_helper( $table, $data, $format = null, $type = 'INSERT' ) {
		if ( ! in_array( strtoupper( $type ), array( 'REPLACE', 'INSERT' ) ) )
			return false;
		$this->insert_id = 0;
		$formats = $format = (array) $format;
		$fields = array_keys( $data );
		$formatted_fields = array();
		foreach ( $fields as $field ) {
			if ( !empty( $format ) )
				$form = ( $form = array_shift( $formats ) ) ? $form : $format[0];
			elseif ( isset( $this->field_types[$field] ) )
				$form = $this->field_types[$field];
			else
				$form = '%s';
			$formatted_fields[] = $form;
		}
		$sql = "{$type} INTO `$table` (`" . implode( '`,`', $fields ) . "`) VALUES (" . implode( ",", $formatted_fields ) . ")";
		return $this->query( $this->prepare( $sql, $data ) );
	}
	
	function update( $table, $data, $where, $format = null, $where_format = null ) {
		if ( ! is_array( $data ) || ! is_array( $where ) )
			return false;

		$formats = $format = (array) $format;
		$bits = $wheres = array();
		foreach ( (array) array_keys( $data ) as $field ) {
			if ( !empty( $format ) )
				$form = ( $form = array_shift( $formats ) ) ? $form : $format[0];
			elseif ( isset($this->field_types[$field]) )
				$form = $this->field_types[$field];
			else
				$form = '%s';
			$bits[] = "`$field` = {$form}";
		}

		$where_formats = $where_format = (array) $where_format;
		foreach ( (array) array_keys( $where ) as $field ) {
			if ( !empty( $where_format ) )
				$form = ( $form = array_shift( $where_formats ) ) ? $form : $where_format[0];
			elseif ( isset( $this->field_types[$field] ) )
				$form = $this->field_types[$field];
			else
				$form = '%s';
			$wheres[] = "`$field` = {$form}";
		}

		$sql = "UPDATE `$table` SET " . implode( ', ', $bits ) . ' WHERE ' . implode( ' AND ', $wheres );
		return $this->query( $this->prepare( $sql, array_merge( array_values( $data ), array_values( $where ) ) ) );
	}
	
	function delete( $table, $where, $where_format = null ) {
		if ( ! is_array( $where ) )
			return false;

		$bits = $wheres = array();

		$where_formats = $where_format = (array) $where_format;

		foreach ( array_keys( $where ) as $field ) {
			if ( !empty( $where_format ) ) {
				$form = ( $form = array_shift( $where_formats ) ) ? $form : $where_format[0];
			} elseif ( isset( $this->field_types[ $field ] ) ) {
				$form = $this->field_types[ $field ];
			} else {
				$form = '%s';
			}

			$wheres[] = "$field = $form";
		}

		$sql = "DELETE FROM $table WHERE " . implode( ' AND ', $wheres );
		return $this->query( $this->prepare( $sql, $where ) );
	}
	
	function get_var( $query = null, $x = 0, $y = 0 ) {
		$this->func_call = "\$db->get_var(\"$query\", $x, $y)";
		if ( $query )
			$this->query( $query );

		if ( !empty( $this->last_result[$y] ) ) {
			$values = array_values( get_object_vars( $this->last_result[$y] ) );
		}
		
		return ( isset( $values[$x] ) && $values[$x] !== '' ) ? $values[$x] : null;
	}
	
	function get_row( $query = null, $output = OBJECT, $y = 0 ) {
		$this->func_call = "\$db->get_row(\"$query\",$output,$y)";
		if ( $query )
			$this->query( $query );
		else
			return null;

		if ( !isset( $this->last_result[$y] ) )
			return null;

		if ( $output == OBJECT ) {
			return $this->last_result[$y] ? $this->last_result[$y] : null;
		} elseif ( $output == ARRAY_A ) {
			return $this->last_result[$y] ? get_object_vars( $this->last_result[$y] ) : null;
		} elseif ( $output == ARRAY_N ) {
			return $this->last_result[$y] ? array_values( get_object_vars( $this->last_result[$y] ) ) : null;
		} elseif ( strtoupper( $output ) === OBJECT ) {
		
			return $this->last_result[$y] ? $this->last_result[$y] : null;
		} else {
			$this->print_error( " \$db->get_row(string query, output type, int offset) -- Output type must be one of: OBJECT, ARRAY_A, ARRAY_N" );
		}
	}
	
	function get_col( $query = null , $x = 0 ) {
		if ( $query )
			$this->query( $query );

		$new_array = array();
		
		for ( $i = 0, $j = count( $this->last_result ); $i < $j; $i++ ) {
			$new_array[$i] = $this->get_var( null, $x, $i );
		}
		return $new_array;
	}
	
	function get_results( $query = null, $output = OBJECT ) {
		$this->func_call = "\$db->get_results(\"$query\", $output)";

		if ( $query )
			$this->query( $query );
		else
			return null;
		
		$new_array = array();
		if ( $output == OBJECT ) {
		
			return $this->last_result;
		} elseif ( $output == OBJECT_K ) {
		
			foreach ( $this->last_result as $row ) {
				$var_by_ref = get_object_vars( $row );
				$key = array_shift( $var_by_ref );
				if ( ! isset( $new_array[ $key ] ) )
					$new_array[ $key ] = $row;
			}
			return $new_array;
		} elseif ( $output == ARRAY_A || $output == ARRAY_N ) {
			if ( $this->last_result ) {
				foreach( (array) $this->last_result as $row ) {
					if ( $output == ARRAY_N ) {
						$new_array[] = array_values( get_object_vars( $row ) );
					} else {
						$new_array[] = get_object_vars( $row );
					}
				}
			}
			return $new_array;
		} elseif ( strtoupper( $output ) === OBJECT ) {
			return $this->last_result;
		}
		return null;
	}
	
	protected function load_col_info() {
		if ( $this->col_info )
			return;

		for ( $i = 0; $i < @mysqli_num_fields( $this->result ); $i++ ) {
			$this->col_info[ $i ] = @mysqli_fetch_field( $this->result );
		}

	}
	
	function get_col_info( $info_type = 'name', $col_offset = -1 ) {
		$this->load_col_info();

		if ( $this->col_info ) {
			if ( $col_offset == -1 ) {
				$i = 0;
				$new_array = array();
				foreach( (array) $this->col_info as $col ) {
					$new_array[$i] = $col->{$info_type};
					$i++;
				}
				return $new_array;
			} else {
				return $this->col_info[$col_offset]->{$info_type};
			}
		}
	}
	
	function bail( $message, $error_code = '500' ) {
		if ( !$this->show_errors ) {
			$this->error = $message;
			return false;
		}
		die($message);
	}
	
	public function get_charset_collate() {
		$charset_collate = '';

		if ( ! empty( $this->charset ) )
			$charset_collate = "DEFAULT CHARACTER SET $this->charset";
		if ( ! empty( $this->collate ) )
			$charset_collate .= " COLLATE $this->collate";

		return $charset_collate;
	}
	
	function has_cap( $db_cap ) {
		$version = $this->db_version();

		switch ( strtolower( $db_cap ) ) {
			case 'collation' :    
			case 'group_concat' : 
			case 'subqueries' :  
				return version_compare( $version, '4.1', '>=' );
			case 'set_charset' :
				return version_compare( $version, '5.0.7', '>=' );
		};

		return false;
	}
	
	function db_version() {
	
		$server_info = mysqli_get_server_info( $this->dbh );

		return preg_replace( '/[^0-9.].*/', '', $server_info );
	}
}
$db = new MahdiYdb($dbuser, $dbpassword, $dbname, $dbhost);
?>