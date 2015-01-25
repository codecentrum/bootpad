<?php 
#
# bootpad
# Build with love by Eky Fauzi
# Currently version 1.0.1
#


session_start();
ob_start();

# 
# ---------------------------------------------------------------
#  APPLICATION ENVIRONMENT
# ---------------------------------------------------------------
# 
#  You can load different configurations depending on your
#  current environment. Setting the environment also influences
#  things like logging and error reporting.
# 
#  This can be set to:
# 
#      development
#      production
# 
#
# By default set to 'development'
$environment = '';


# 
# ---------------------------------------------------------------
#  PATH
# ---------------------------------------------------------------

# Directory where you install bootpad (root)
# eg: 'http://yoursite.com/' or 'http://localhost/bootpad/'
# You can set your basepath or you can leave it blank
# By default basepath will automaticaly set
$basepath = '';

# First controller that you want to open first
# By default set to 'home'
$controller = '';

# Method that you want to open firt time
# By default set to 'index'
$method = '';

# including the autoload and start the application
require_once 'autoload.php';

new Bootpad;

# End of file index.php
# Location: ./index.php