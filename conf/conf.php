<?php
session_start();
//システムConf
ini_set( 'display_errors', 1 );
ini_set('error_reporting', E_ALL);

$topPage = 'input_sagyoHokokusyo.php';
$domain = 'gyomuitaku.aucfan.com';
//$domain = 'localhost/example/projects/gyomuitaku';
$phpSorceDirName = 'phpSorce';
$templateDirName = 'template';

define('TOPPAGE',$phpSorceDirName.'/'.$topPage);
define('DOMAIN','http://'.$domain.'/');
define('TEMP','../'.$templateDirName.'/');
define('PHPD',$phpSorceDirName.'/');

$selfFileName = basename($_SERVER['PHP_SELF']);
define('RETTEMP',TEMP.str_replace('.php','.tmp.php',$selfFileName));
$libDir = 'lib/';
if($selfFileName != 'index.php')
{
	$libDir = '../'.$libDir;
}

//Error時エラーメッセージ格納SessionKey
define('ERROR','Error');
//エラーメッセージHTMLタグのclass
define('ERROR_MSG_CLASS','ErrorMsg');

//css
define('CSS_DIR','../css/');

//js
define('JS_DIR','../js/');

//confAray取得
require_once('confArrays.php');

require_once($libDir.'library.php');
?>