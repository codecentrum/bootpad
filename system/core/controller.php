<?php  

/**
* 
*/
class controller extends bootseed{
	
	function __construct()
	{
		# code...

	}

	public function model($model){

		require_once APPLICATION_PATH .'/models/'. $model .'.php';
		
		$this->model = new $model;

		return $this->model;

	}

	public function view($view, $data_from_controller = array() ){

		require_once APPLICATION_PATH .'/views/'. $view .'.php';
		
	}

	public function library($library){

		require_once APPLICATION_PATH .'/libraries/'. $library .'.php';

	}

}

?>