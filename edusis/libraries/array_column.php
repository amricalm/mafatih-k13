<?php
# for PHP < 5.5
# AND it works with arrayObject AND array of objects
class Array_column
{
    function array_column($arr_data, $col)
    {
        $result = array_map(function($arr){return $arr[$col]}, $arr_data);
        return $result;
    }
}
?>