<?php  

/**
 * bootpad
 * Build with love by Eky Fauzi (2014)
 * Currently version 1.0.0
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

class bootpad {

	protected $controller = CONTROLLER;
	protected $method = METHOD;
	protected $param = array();

	public function __construct() {

		/*
		 * checking if basic_functions.php is exist or not
		 */
		if ( !file_exists( SYSTEM_PATH .'/helpers/basic_functions.php' ) ) {

			echo "File <code>". SYSTEM_PATH ."/helpers/basic_functions.php</code> not found!" ;

			exit();

		}

		/*
		 * if basic_function is exsist, include here
		 */
		require_once  SYSTEM_PATH .'/helpers/basic_functions.php';


		/*
		 * checking if database.php is exist or not
		 */
		if ( !file_exists( APPLICATION_PATH .'/config/database.php' ) ) {

			echo "File <code>". APPLICATION_PATH ."/config/database.php</code> not found!" ;

			exit();

		}

		/*
		 * if database.php is exsist, include here
		 * setting up database connection if database is set
		 */
		require_once  APPLICATION_PATH .'/config/database.php';

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
		

		/*
		 * parsing url and store in array
		 */
		if( isset( $_GET['url'] ) ) {

			$get_url = $_GET['url'];

			/*
			 * clearing $_GET['url']
			 */
			unset( $_GET['url'] );

			$url = explode( '/', filter_var( rtrim($get_url, '/' ), FILTER_SANITIZE_URL ) );

		} else {

			$url = false;

		}


		/*
		 * checking controller exist or not
		 * if exist, controller will replace by controller given by url
		 */
		if (file_exists( APPLICATION_PATH .'/controllers/' . $url[0] . '.php' ) ) {

			$this->controller = $url[0];

			/*
			 * clearing first array index
			 */
			unset( $url[0] );

		} else {

			/*
			 * if file controller not exist
			 * or controller not same as home
			 * by default, will showing error message if environment is development
			 */
			if ( !empty( $url[0] ) && $url[0] != $this->controller ) {

				if ( ENVIRONMENT == "development" ) {
					
					echo "File <code>". APPLICATION_PATH ."/controllers/". $url[0] .".php</code> not found!" ;
					exit();

				} 
				

			} 

		}


		/*
		 * calling controller
		 */
		require_once  APPLICATION_PATH .'/controllers/' . $this->controller . '.php';

		$this->controller = new $this->controller;

		if ( isset( $url[1] ) ) {

			if ( method_exists( $this->controller, $url[1] ) ) {

				$this->method = $url[1];

				/*
				 * clearing second array index
				 */
				unset( $url[1] );
			}
		}

		/*
		 * rest of the array that has been cleaned (array[0] dan array[1]), it will be considered as parameters (array[2] etc.)
		 */
		$this->params = $url ? array_values( $url ) : array();

		/*
		 * including parameters to function
		 */
		call_user_func_array( array( $this->controller, $this->method ), $this->params );

	}

}
?>