<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ben
 * Date: 2019-03-07
 * Time: 14:27
 */

function autoloader($MuscuclassName) {
    if (file_exists(__DIR__ . '/../model/' . $MuscuclassName . '.class.php'))
        require_once( __DIR__ . '/../model/' . $MuscuclassName . '.class.php');

    elseif (file_exists(__DIR__ . '/model/' . $MuscuclassName . '.class.php'))
        require_once(__DIR__ . '/model/' . $MuscuclassName . '.class.php');

    else
        trigger_error("Impossible de charger la classe : $MuscuclassName", E_USER_WARNING);
}

spl_autoload_register('autoloader');


@ini_set('display_errors', 'on');
error_reporting(E_ALL);


define('__BASE_DIR__' , 'RobertClub/');
define('__SITE_DIR__' , 'http://benj.fr/'.__BASE_DIR__);
define('__ASSET_DIR__' , __SITE_DIR__.'assets/');


$MuscuMaster = new MySQL('localhost', 'root', 'root', 'sport', 0);

?>