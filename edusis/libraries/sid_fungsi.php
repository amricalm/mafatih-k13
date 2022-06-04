<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class sid_fungsi
{
	var $_uploadtarget = './sidupload/';
	function sid_tgl($tgl)
	{	
		$pisahin_tgl = explode('-',$tgl);
        $res_tgl = $pisahin_tgl[2] . '-' . $pisahin_tgl[1] . '-' . $pisahin_tgl[0];
		return $res_tgl;
	}
	
	function sid_extfile($file)
	{
		$rsl="";
		if ($file!="")
		{
			$pisahinnamafile = explode('.',$file);
			$rsl=$pisahinnamafile[1];
		}
		return $rsl;
	}
	
	function sid_upload($fileupload,$target)
    {
        $hasil = move_uploaded_file($fileupload['tmp_name'],$this->_uploadtarget.$target);
        return $hasil;
    }
    
    function sid_gambarupload($ext)
    {
		$gambar="";
		if($ext=='doc' || $ext=='docx')
		{
			$gambar = '<img title="lihat/unduh" src="'.base_url().'edusisimg/file_word.png" width="25px"/>';
		}
		elseif($ext=='xls' || $ext=='xlsx')
		{
			$gambar = '<img title="lihat/unduh" src="'.base_url().'edusisimg/file_excel.png" width="25px"/>';
		}
		elseif($ext=='ppt' || $ext=='pptx')
		{
			$gambar =  '<img title="lihat/unduh" src="'.base_url().'edusisimg/file_powerpoint.png" width="25px"/>';
		}
		elseif($ext=='pdf')
		{
			$gambar = '<img title="lihat/unduh" src="'.base_url().'edusisimg/file_pdf.png" width="25px"/>';
		}
		
		return $gambar;
	}
    function sid_gambarapprove($appr=0,$sik_id='')
    {
        $gambar     = '';
        switch($appr)
        {
            case 0 :
                $gambar = '<img title="Klik kanan untuk pilih approval" src="'.base_url().'edusisimg/ico-delete.png" style="cursor:pointer;" class="approve" name="imgappr[]" id="imgappr'.$sik_id.'"/>';
                break;
            case 1 :
                $gambar = '<img title="Klik kanan untuk pilih approval" src="'.base_url().'edusisimg/ico-done.png" style="cursor:pointer;" class="approve" name="imgappr[]" id="imgappr'.$sik_id.'"/>';
                break;
            default :
                $gambar = '<img title="Klik kanan untuk pilih approval" src="'.base_url().'edusisimg/ico-warning.png" style="cursor:pointer;" class="approve" name="imgappr[]" id="imgappr'.$sik_id.'"/>';
                break;
        }
        return $gambar;
    }
    function sid_provinsi_for_dropdown()
    {
        $nama_provinsi  = array(
            'Nangroe Aceh Darussalam'   => 'Nangroe Aceh Darussalam',
            'Sumatera Utama'            => 'Sumatera Utama',
            'Sumatera Barat'            => 'Sumatera Barat',
            'Riau'                      => 'Riau',
            'Jambi'                     => 'Jambi',
            'Sumatera Selatan'          => 'Sumatera Selatan',
            'Bengkulu'                  => 'Bengkulu',
            'Lampung'                   => 'Lampung',
            'Kepulauan Bangka Belitung' => 'Kepulauan Bangka Belitung',
            'Kepulauan Riau'            => 'Kepulauan Riau',
            'Daerah Khusus Ibukota Jakarta' => 'Daerah Khusus Ibukota Jakarta',
            'Jawa Barat'                => 'Jawa Barat',
            'Jawa Tengah'               => 'Jawa Tengah',
            'Daerah Istimewa Yogyakarta'=> 'Daerah Istimewa Yogyakarta',
            'Jawa Timur'                => 'Jawa Timur',
            'Banten'                    => 'Banten',
            'Bali'                      => 'Bali',
            'Nusa Tenggara Barat'       => 'Nusa Tenggara Barat',
            'Nusa Tenggara Timur'       => 'Nusa Tenggara Timur',
            'Kalimantan Barat'          => 'Kalimantan Barat',
            'Kalimantan Tengah'         => 'Kalimantan Tengah',
            'Kalimantan Selatan'        => 'Kalimantan Selatan',
            'Kalimantan Timur'          => 'Kalimantan Timur',
            'Sulawesi Utara'            => 'Sulawesi Utara',
            'Sulawesi Tengah'           => 'Sulawesi Tengah',
            'Sulawesi Selatan'          => 'Sulawesi Selatan',
            'Sulawesi Tenggara'         => 'Sulawesi Tenggara',
            'Gorontalo'                 => 'Gorontalo',
            'Sulawesi Barat'            => 'Sulawesi Barat',
            'Maluku'                    => 'Maluku',
            'Maluku Utara'              => 'Maluku Utara',
            'Papua Barat'               => 'Papua Barat',
            'Papua'                     => 'Papua'
        );
        return $nama_provinsi;
//        for($i=0;$i<33;$i++)
//        {
//            
//        }
    }
    function tanggal_display($tgl)
    {
        $tgl_ex     = explode('-',$tgl);
        $re_tgl     = '';
        if(strlen($tgl_ex[0])==2)
        {
            $re_tgl = $tgl_ex[0].'-'.$tgl_ex[1].'-'.$tgl_ex[2];
        }
        else
        {
            $re_tgl = $tgl_ex[2].'-'.$tgl_ex[1].'-'.$tgl_ex[0];
        }
        return $re_tgl;
    }
    function tanggal_simpan($tgl)
    {
        $tgl_ex     = explode('-',$tgl);
        $re_tgl     = '';
        if(strlen($tgl_ex[0])==4)
        {
            $re_tgl = $tgl_ex[0].'-'.$tgl_ex[1].'-'.$tgl_ex[2];
        }
        else
        {
            $re_tgl = $tgl_ex[2].'-'.$tgl_ex[1].'-'.$tgl_ex[0];
        }
        return $re_tgl;
    }
          
    function sid_null($val,$rep)
    {
        if ($val==NULL) $rv = $rep; else $rv = $val;
	return $rv;
    }	
    
    function sid_limit($lim,$off)
    {
        $rv = "";
        if ($lim!=0 || $off!=0)
        {
            $rv = " limit " . $lim .",". $off;
        }
        return $rv;
    }
    
    function sid_bulan()
    {
        $bulan = array(
            "1"=>"Januari",
            "2"=>"Pebruari",
            "3"=>"Maret",
            "4"=>"April",
            "5"=>"Mei",
            "6"=>"Juni",
            "7"=>"Juli",
            "8"=>"Agustus",
            "9"=>"September",
            "10"=>"Oktober",
            "11"=>"November",
            "12"=>"Desember"
            );
        
        return $bulan;
    }
    
    function strip_th_ajar($th_ajar)
    {
        return str_replace('/','-',$th_ajar);
    }
    function garing_th_ajar($th_ajar)
    {
        return str_replace('-','/',$th_ajar);
    }     
    function encodeurl($str)
    {
        return htmlentities(urlencode($str));
    }  
    function decodeurl($str)
    {
        return htmlspecialchars(urldecode($str));
    }
}
?>