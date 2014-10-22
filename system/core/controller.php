<?php  

/*
 *---------------------------------------------------------------
 * CONTROLLER
 *---------------------------------------------------------------
 *
 * this class handle model, view, and library
 */
class controller extends bootpad{
	
	function __construct(){
		

	}


	/*
	 *---------------------------------------------------------------
	 * MODEL
	 *---------------------------------------------------------------
	 *
	 * calling model that you needed
	 */
	public function model( $model ){

		require_once APPLICATION_PATH .'/models/'. $model .'.php';
		
		$this->model = new $model;

		return $this->model;

	}

	/*
	 *---------------------------------------------------------------
	 * VIEW
	 *---------------------------------------------------------------
	 *
	 * calling view that you needed
	 */
	public function view( $view, $data_from_controller = array() ){

		require_once APPLICATION_PATH .'/views/'. $view .'.php';
		
	}

	/*
	 *---------------------------------------------------------------
	 * LIBRARY
	 *---------------------------------------------------------------
	 *
	 * calling library that you needed
	 */
	public function library( $library ){

		require_once APPLICATION_PATH .'/libraries/'. $library .'.php';

	}

}

?>