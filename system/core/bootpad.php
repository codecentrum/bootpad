<?php  

# Bootpad
# Build with love by Eky Fauzi (2014)
# Currently version 1.4.0
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

if ( $environment === '') { $environment = 'development'; } define( 'ENVIRONMENT', $environment );

# ---------------------------------------------------------------
# ERROR REPORTING
# ---------------------------------------------------------------
# 
# Different environments will require different levels of error reporting.
# By default development will show errors but testing and live will hide them.
if (defined('ENVIRONMENT')){

	switch (ENVIRONMENT){

		case 'development':
			error_reporting(E_ALL);
		break;
	
		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');

	}

}


# Set the basepath of this application
# If basepath not set manualy by user,
# system will generate basepath automatically
if ($basepath === '') {

	# Check the http host
	if (isset($_SERVER['HTTP_HOST'])){

		# Combine them as one url
		$basepath = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
		$basepath .= '://'. $_SERVER['HTTP_HOST'];
		$basepath .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

	} else {

		# By default set to localhost
		$basepath = 'http://localhost/';
	}
}

# Define basepath
# Must include 'http://' before url and '/' (slash) in the end of url
define( 'BASEPATH', $basepath ); 

# Define system path
define( 'SYSTEM_PATH', 'system' );

# Define applicarion path
define( 'APPLICATION_PATH', 'application' );

# Defined first page that opened first time (welcome page)
if ( $controller === '' ) { $controller = 'home'; } define( 'CONTROLLER', 'home' );

# Defined first method that opened when opened page. eg: www.site.com/welcome/index
if ( $method === '') { $controller = 'index'; } define( 'METHOD', 'index' );


class Bootpad {

	protected $controller = CONTROLLER;
	protected $method = METHOD;
	protected $param = array();

	public function __construct() {

		# Checking if basic_helper.php is exist or not
		if ( !file_exists( SYSTEM_PATH .'/helpers/basic_helper.php' ) ) {

			echo "File <code>". SYSTEM_PATH ."/helpers/basic_helper.php</code> not found!" ;

			exit();

		}

		# If basic_helper.php is exsist, include here
		require_once  SYSTEM_PATH .'/helpers/basic_helper.php';

		# Checking if database.php is exist or not
		if ( !file_exists( 'config/database.php' ) ) {

			echo "File <code>config/database.php</code> not found!" ;

			exit();

		}

		# If database.php is exsist, include here
		# Setting up database connection if database is set
		require_once 'config/database.php';

		if ( !empty( $db_host ) && !empty( $db_user ) && !empty( $db_name ) ){

			$db_connect = mysql_connect( $db_host, $db_user, $db_password );

			if ( !$db_connect ){
			    die( "Could not connect: " . mysql_error() );
			}

			$db_selected = mysql_select_db( $db_name , $db_connect );

			if ( !$db_selected ){
			    die( "Can't use ". $database ." : " . mysql_error() );
			}

		}
		
		# Parsing url and store in array
		if( isset( $_GET['url'] ) ) {

			$get_url = $_GET['url'];

			# Clearing $_GET['url']
			unset( $_GET['url'] );

			$url = explode( '/', filter_var( rtrim($get_url, '/' ), FILTER_SANITIZE_URL ) );

		} else {

			$url = false;

		}

		# Checking controller exist or not
		# If exist, controller will replace by controller given by url
		if (file_exists( APPLICATION_PATH .'/controllers/' . $url[0] . '_controller.php' ) ) {

			$this->controller = $url[0];

			# Clearing first array index
			unset( $url[0] );

		} else {

			# If file controller not exist
			# Or controller not same as home
			# By default, will showing error message if environment is development
			if ( !empty( $url[0] ) && $url[0] != $this->controller ) {

				if ( ENVIRONMENT == "development" ) {
					
					echo "File <code>". APPLICATION_PATH ."/controllers/". $url[0] ."_controller.php</code> not found!" ;
					exit();

				} 
				

			} 

		}

		# Calling controller
		require_once  APPLICATION_PATH .'/controllers/' . $this->controller . '_controller.php';

		$this->controller_class_name = preg_replace("/[^a-zA-Z+]/", '', $this->controller.'_controller');
		$this->controller = new $this->controller_class_name;

		if ( isset( $url[1] ) ) {

			if ( method_exists( $this->controller, $url[1] ) ) {

				$this->method = $url[1];

				# Clearing second array index
				unset( $url[1] );
			}
		}

		# Rest of the array that has been cleaned (array[0] dan array[1]), 
		# It will be considered as parameters (array[2] etc.)
		$this->params = $url ? array_values( $url ) : array();

		# Including parameters to function
		call_user_func_array( array( $this->controller, $this->method ), $this->params );

	}

}

# End of file
# Location /system/core/bootpad.php