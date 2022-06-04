<?php

/**
 * @author Muhammad Ginanjar
 * @copyright 2011
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename, $stream=TRUE,$papersize='a4',$orientation='portrait') 
{
    require_once("dompdf-master/dompdf_config.inc.php");
    spl_autoload_register('DOMPDF_autoload');
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->set_paper($papersize, $orientation);
    $dompdf->render();
    if ($stream) {
        $options['Attachment'] = 1;
        $options['Accept-Ranges'] = 0;
        $options['compress'] = 1;
        $dompdf->stream($filename.".pdf", $options);
    } else {
        $CI =& get_instance();
        $CI->load->helper('file');
        write_file("$filename.pdf", $dompdf->output());
    }
}

?>