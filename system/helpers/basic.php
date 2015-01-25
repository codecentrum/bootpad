<?php  

# place functions here
# or you can place functions in function.php than you can includeing that

if ( ! function_exists('base_url')){

	function base_url($url=''){

		if ( $url != '' ) {

			return  BASEPATH . $url ;

		} else {

			return  BASEPATH;
			
		}
		
	}

}


if ( ! function_exists('redirect')){

	function redirect($uri = '', $method = 'location', $http_response_code = 302){

		if ( ! preg_match('#^https?://#i', $uri)){

			$uri = site_url($uri);

		}

		switch($method){

			case 'refresh'	: header("Refresh:0;url=".$uri);
				break;
			default			: header("Location: ".$uri, TRUE, $http_response_code);
				break;

		}
		
		exit;
		
	}
}

# End of file