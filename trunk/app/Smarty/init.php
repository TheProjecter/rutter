<?php

 function getSmarty()
{
	//if (!is_object($GLOBALS['SmartyGlobalObjInst'])) {
	   if (!class_exists('Smarty') ){
	           require_once(BASE_PATH.'/Smarty/libs/Smarty.class.php');
	    }
		
		$Smarty = new Smarty();
		$Smarty->compile_check = true;
		$Smarty->template_dir = BASE_PATH .'/templates';
		//        $Smarty->force_compile = false;
		$Smarty->php_handling = SMARTY_PHP_PASSTHRU;
		$Smarty->compile_dir = BASE_PATH.'/templates_c';
		$Smarty->file_perms = '0777';
		$Smarty->dir_perms = '0777';
	//	$GLOBALS['SmartyGlobalObjInst']    = $Smarty;		
	//}
	//	return $GLOBALS['SmartyGlobalObjInst'];
		return $Smarty;    	
}
define('BASE_PATH', dirname(__FILE__).'/..');
?>