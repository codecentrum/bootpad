<?php 

# Bootpad
# Build with love by Eky Fauzi
# Please set your application configuration here
# If you do not have any configuration, please leave the 
# following variables blank

session_start();
ob_start();

# ---------------------------------------------------------------
# APPLICATION ENVIRONMENT
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


# ---------------------------------------------------------------
# PATH
# ---------------------------------------------------------------

# Directory where you install bootpad (root)
# eg: 'http://yoursite.com/' or 'http://localhost/bootpad/'
# You can set your basepath or you can leave it blank
# By default basepath will automaticaly set

$basepath = '';


# Controller/page that you want to open first time
# By default set to 'home'

$controller = '';


# Method that you want to open firt time
# By default set to 'index'

$method = '';


# ---------------------------------------------------------------
# START ENGINE
# ---------------------------------------------------------------

# Include core file of this application
# IMPORTANT! Do not remove the following lines

require_once 'system/core/bootpad.php';
require_once 'system/core/controller.php';


# Start the application

new Bootpad;

# End of file index.php
# Location: /index.php