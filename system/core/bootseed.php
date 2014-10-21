<?php  

/**
* 
*/
class bootseed {

	protected $controller = CONTROLLER;
	protected $method = METHOD;
	protected $param = array();

	public function __construct(){


		if ( !file_exists( SYSTEM_PATH .'/helpers/basic_functions.php') ) {

			echo "File <code>". SYSTEM_PATH ."/helpers/basic_functions.php</code> not found!" ;

			exit();

		}

		// setting up basic function
		require_once  SYSTEM_PATH .'/helpers/basic_functions.php';



		if ( !file_exists( APPLICATION_PATH .'/config/database.php') ) {

			echo "File <code>". APPLICATION_PATH ."/config/database.php</code> not found!" ;

			exit();

		}

		// setting up database configuration
		require_once  APPLICATION_PATH .'/config/database.php';

		if ( !empty( $db_host ) && !empty( $db_user ) && !empty( $db_password ) && !empty( $db_name ) ) {

			$db_connect = mysql_connect( $db_host, $db_user, $db_password );

			if (!$db_connect) {
			    die("Could not connect: " . mysql_error());
			}

			$db_selected = mysql_select_db( $db_name , $db_connect);

			if (!$db_selected) {
			    die ("Can't use ". $database ." : " . mysql_error());
			}

		}
		

		if( isset( $_GET['url'] ) ) {

			$get_url = $_GET['url'];
			unset($_GET['url']);
			$url = explode( '/', filter_var(rtrim($get_url, '/'), FILTER_SANITIZE_URL));

		} else {

			$url = false;

		}

		if (file_exists( APPLICATION_PATH .'/controllers/' . $url[0] . '.php' )) {

			# code...
			$this->controller = $url[0];
			//clear first array value
			unset($url[0]);

		} else {

			if ( !empty($url[0]) && $url[0] != $this->controller ) {

				echo "File <code>". APPLICATION_PATH ."/controllers/". $url[0] .".php</code> not found!" ;
				exit();

			} 

		}

		require_once  APPLICATION_PATH .'/controllers/' . $this->controller . '.php';

		$this->controller = new $this->controller;

		if (isset($url[1])) {
			# code...
			if (method_exists($this->controller, $url[1])) {
				# code...
				$this->method = $url[1];
				//clear second array value
				unset($url[1]);
			}
		}

		// sisa array yang telah dibersihkan (array[0] dan array[1]) yauitu array[2] dst. dianggap sebagai parameter
		$this->params = $url ? array_values($url) : array();

		//memasukan array sisa tadi ke dalam fungsi pada method
		call_user_func_array( array($this->controller, $this->method), $this->params );

	}

}
?>