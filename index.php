<?php 
/**
 * Bootseed
 * Copyright © 2014 The Bootseed Project
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 */


session_start();
ob_start();

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */

define('ENVIRONMENT', 'development');

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */

if (defined('ENVIRONMENT')){
	switch (ENVIRONMENT){
		case 'development':
			error_reporting(E_ALL);
		break;
	
		case 'testing':
		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}


//must included / in end of url
define( 'BASEPATH', "http://localhost/ekyfauzi/bootseed/" );
define( 'SYSTEM_PATH', "system" );
define( 'APPLICATION_PATH', "application" );


define( 'BOOTSTRAP_VERSION', "3.2.0" );
define( 'JQUERY_VERSION', "1.11.1" );


//defined first page that opened first time (welcome page)
define( 'CONTROLLER', "home" );

//defined first method that opened when opened page. eg: www.site.com/welcome/index
define( 'METHOD', "index" );

require_once SYSTEM_PATH .'/autoload.php';

$bootseed = new bootseed;

?>