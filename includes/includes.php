<?php 
//THESE ALSO WORK from perspective of files from admin/
//require_once('../../includes/config.php');
//require_once('../../includes/functions.php');
//require_once('../../includes/session.php');
//require_once('../../includes/user.php');
//require_once('../../includes/mysqldatabase.php');
//require_once('../../includes/databaseobject.php');


/*
 * because now include_admin will load them and 
 * so path relative to includes_admin.php will aply 
 */
//require_once('config.php');
//require_once('functions.php');
//require_once('session.php');
//require_once('user.php');
//require_once('mysqldatabase.php');
//require_once('databaseobject.php');

//USING PATH CONSTANTS TO PROVIDE DEFINITIVE PATH(absolute path)
defined('DS')?null:define('DS',DIRECTORY_SEPARATOR);
//DS will be changed according to OS automatically

defined('SITE_ROOT')?null://path for photo_gallery function
                define('SITE_ROOT', 'C:'.DS.'wamp'.DS.'www'.DS.'photo_gallery');//path to this folder
defined('LIB_PATH')?null://path for include folder as we use it very often
                  define('LIB_PATH',SITE_ROOT.DS.'includes');//path to includes folder
        
//USING ABSOLUTE PATH
/*
 * IMPORTANT- order is important here because
 * file coming after may use the previous one
 * so if previous was not defined before the next 
 * error will come out
 */
//1- load config file
require_once(LIB_PATH.DS.'config.php');

//2- basic function which may be used by other files
require_once(LIB_PATH.DS.'functions.php');

//3- load core objects
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'mysqldatabase.php');

//4- database related classses
require_once(LIB_PATH.DS.'databaseobject.php');
/*
 * here as 'user' class uses database object 'databaseobject' must be loaded first
 */
require_once(LIB_PATH.DS.'user.php');

 ?>