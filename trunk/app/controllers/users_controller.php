<?php
class UsersController extends AppController {
    var $name = 'Users';
    function index() {
    	$test=$this->User->find('all');
    	$this->smarty->assign('name','world');
    	$this->smarty->display('test.tpl');
    	Debug::b($test);
    }
}
?>