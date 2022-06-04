<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
/**
* Convert String Tanggal (dd/mm/yyyy) to  MySQL's DATE (YYYY-MM-DD)
*
* Returns the MySQL's DATE (YYYY-MM-DD)
*
* @todo ...
* @author Yan Sofyan (yansofyan@gmail.com)
* @access    public
* @return    string
*/
function tgl_to_tglmysql($tgl="")
{
    $timestamp = strtotime($tgl);
    return date('Y-m-d', $timestamp);
}

/* Mengurangi Tanggal MySQL(YYYY-MM-DD) dengan hari
*
* Returns string Tanggal
*
* @todo ...
* @author Yan Sofyan (yansofyan@gmail.com)
* @access    public
* @return    string
*/
function tgl_minus_hari($tgl="",$hari=0)
{
    $DETIK_PER_MENIT = 60;
    $MENIT_PER_JAM = 60;
    $JAM_PER_HARI = 24;

    $day_interval = $hari;

    $timestamp_awal = strtotime($tgl);
    $interval = $day_interval * $DETIK_PER_MENIT * $MENIT_PER_JAM * $JAM_PER_HARI  ;
    $timestamp_baru = $timestamp_awal - $interval;
    
    return date('Y-m-d', $timestamp_baru);

}

function test()
{
    return 'test';
}


/**
* Convert String YYYYMMDD to MySQL's DATE (YYYY-MM-DD)
*
* Returns the MySQL's DATE (YYYY-MM-DD)
*
* @todo ...
* @author Yan Sofyan (yansofyan@gmail.com)
* @access    public
* @return    string
*/
function str_to_tglmysql($str="")
{
    $timestamp = strtotime(substr($str,0,4).'-'.substr($str,4,2).'-'.substr($str,6,2));
    return date('Y-m-d', $timestamp);
}

function str_part($str="",$start=0,$length=0)
{
    $panjang    = strlen($str);
    if ($panjang>$length){
        $str = substr($str, $start,$length) . "...";
    }
    return $str;
}


/**
* Convert String Tanggal (DD-MM-YYYY) to  MySQL's DATE (YYYY-MM-DD)
*
* Returns the MySQL's DATE (YYYY-MM-DD)
*
* @todo ...
* @author Yan Sofyan (yansofyan@gmail.com)
* @access    public
* @return    string
*/
function adn_ctgl($tgl="")
{
    if($tgl!='')
    {
        $tgl = explode('-',$tgl);
        $tgl = $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
    }
    else
    {
        $tgl = '0000-00-00';
    }
    return $tgl;
}
/**
* Convert String Tanggal (DD-MM-YYYY) to  Microsoft SQL's DATE (YYYY-MM-DD)
*
* Returns the Microsoft SQL's DATE (YYYY-MM-DD)
*
* @todo ...
* @author Yan Sofyan (yansofyan@gmail.com)
* @access    public
* @return    string
*/
function adn_ctgl2($tgl="")
{
    if ($tgl==null)
    {
        $tgl='';
        return '';
    }
    else if($tgl!='')
    {
        $tgl = explode('-',$tgl);
        if (trim($tgl[2]) =='' || trim($tgl[1]) =='' || trim($tgl[0]) =='')
        {
            $tgl = null;
        }
        else 
        {
            $tgl = new DateTime(trim($tgl[2]).'-'.trim($tgl[1]).'-'.trim($tgl[0]));
        }
        return date_format($tgl, 'Y-m-d');
    
    }
    else
    {
        $tgl = null;
        return '';
    }
    
}
/**
* Convert String Tanggal MySQL's DATE (YYYY-MM-DD) to   (DD-MM-YYYY)
*
* Returns the MySQL's DATE  (DD-MM-YYYY)
*
* @todo ...
* @author Yan Sofyan (yansofyan@gmail.com)
* @access    public
* @return    string
*/
function adn_rctgl($tgl="")
{
    $tgl = explode('-',$tgl);
    $tgl = $tgl[2].'-'.$tgl[1].'-'.$tgl[0];

    return $tgl;
}

/**
* Convert Tanggal (YYYY-MM-DD) to  String (YYYY-MM-DD)
*
* Returns String (YYYY-MM-DD)
*
* @todo ...
* @author Yan Sofyan (yansofyan@gmail.com)
* @access    public
* @return    string
*/
function adn_tgl_to_str($tgl="")
{
    if(trim($tgl)=='1900-00-00' || trim($tgl)=='0000-00-00')
    {

        return '';
    }
    else 
     {
        return $tgl;
    }
    
}
?>
