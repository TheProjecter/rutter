<?php

class Debug
{
	function r($arr)
	{
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
	}
	
	function b($arr)
	{
		echo '<pre>';
		echo '<div style="color: #FFF; background: #000;">';
		print_r($arr);
		echo '</div>';
		echo '</pre>';
	}
	
	function clearstr($str)
	{
		return str_replace("\r","",str_replace("\n","",$str));
	}

	function stripslashes_deep($value) {
        $value = is_array($value) ? array_map(array($this, "stripslashes_deep"), $value) : stripslashes($value);
        return $value;
    }

}

?>