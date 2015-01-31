<?php  

# This controller is for example
# This is controller that call by default
# You can set deafault controller at index.php ( location in root of this application directory )

class HomeController extends Controller {

	public function index(){

		$data_for_view = array();
		$data_for_model = array();

		# including library if needed
		$this->library('functions');


		# including model if needed
		$this->User = $this->model('User');
		# call the model function
		$hello_world = $this->User->hello_world();


		# send value from model to view
		$data_for_view['hello_world'] = $hello_world;

		# call view and send data for using in view
		$this->view('home', $data_for_view);

	}

}

# End of file