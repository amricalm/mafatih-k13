<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function arrayToSelect($results, $value = 'id', $key = 'title', $add_blank=false, $blank_value='')
{
    // Converts objects to arrays
    if(is_object($results)) $results = get_object_vars($results);
    $options = array();

    if(!empty($add_blank)) $options = array(null=>$blank_value);

    // Will only run if results is an array, not a string, int, etc.
    if(is_array($results))
    {
        foreach($results as $item)
        {
            $options[$item[$value]] = $item[$key];
        }
    }

    return $options;
} 
function arrayToSelect02($results, $value = 'id', $key1 = 'title', $key2 = 'title', $key3 = 'title', $add_blank=false, $blank_value='')
{
    // Converts objects to arrays
    if(is_object($results)) $results = get_object_vars($results);
    $options = array();
    if(!empty($add_blank)) $options = array(null=>$blank_value);

    // Will only run if results is an array, not a string, int, etc.
    if(is_array($results))
    {
        //$x = 0;
        foreach($results as $item)
        {//echo $x . ' - ';$x++;

            //$opt = $item[$value].''.$x;
            //print_r($item[$value]);
            $options[$item[$value]] = "[".strtoupper($item[$key1])."] [".$item[$key2]."] - " .$item[$key3];
            //echo '<option value="KD1       ">[KI2] [KD1       ] - Deskripsi KI2 KD1</option>';
            //$options[$opt] = "[".strtoupper($item[$key1])."] [".$item[$key2]."] - " .$item[$key3];
            //$x++;
        }
        //print_r($options);die;
    }
    return $options;
}