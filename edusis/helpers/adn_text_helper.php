<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function persingkat($var, $len = 200, $txt_titik = "..") 
{    
	if (strlen ($var) < $len) 
    { 
        return $var; 
    }
	if (preg_match ("/(.{1,$len})\s/", $var, $match)) 
    {  
        return $match [1] . $txt_titik;  
    }
	else 
    { 
        return substr ($var, 0, $len) . $txt_titik; 
    }
}

?>