<?php  

# Basic helper

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

# Render view files
# Can be access on view
if ( ! function_exists('render')){
	function render( $type = 'layout', $name = null ) {

		# You can define render type like json, html, or php to your view
		if ( $type == 'layout' ) {
			
			if ( $name != '' ) {
	            
				require_once  APPLICATION_PATH .'/views/'. $name .'.php';

	        } 

		}

	}
}

# End of file
# Location /system/helpers/basic_helper.php