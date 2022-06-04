<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *
 * Library : Terbilang.php
 * mengganti angka ke teks
 *
 */
class Terbilang
{
    var $_terbilang;
    function rp_terbilang($angka,$debug)
    {

        $_terbilang = '';
        $angka = str_replace(".",",",$angka);

        $panjang=strlen($angka);
        for ($b=0;$b<$panjang;$b++)
        {
            $myindex=$panjang-$b-1;
            $a_bil[$b]=substr($angka,$myindex,1);
        }
        if ($panjang>9)
        {
            $bil=$a_bil[9];
            if ($panjang>10)
            {
                $bil=$a_bil[10].$bil;
            }

            if ($panjang>11)
            {
                $bil=$a_bil[11].$bil;
            }
            if ($bil!="" && $bil!="000")
            {
                $_terbilang .= terbilang::rp_satuan($bil,$debug)." Milyar";
            }

        }

        if ($panjang>6)
        {
            $bil=$a_bil[6];
            if ($panjang>7)
            {
                $bil=$a_bil[7].$bil;
            }

            if ($panjang>8)
            {
                $bil=$a_bil[8].$bil;
            }
            if ($bil!="" && $bil!="000")
            {
                $_terbilang .= terbilang::rp_satuan($bil,$debug)." Juta";
            }

        }

        if ($panjang>3)
        {
            $bil=$a_bil[3];
            if ($panjang>4)
            {
                $bil=$a_bil[4].$bil;
            }
            if ($panjang>5)
            {
                $bil=$a_bil[5].$bil;
            }
            if ($bil!="" && $bil!="000")
            {
                $_terbilang .= terbilang::rp_satuan($bil,$debug)." Ribu";
            }
            if($bil=="1")
            {
                $_terbilang = "Seribu";
            }
        }

        $bil=$a_bil[0];
        if ($panjang>1)
        {
            $bil=$a_bil[1].$bil;
        }

        if ($panjang>2)
        {
            $bil=$a_bil[2].$bil;
        }
        //die($bil);
        if ($bil!="" && $bil!="000")
        {
            $_terbilang .= terbilang::rp_satuan($bil,$debug);
        }
        return trim($_terbilang);
    }
    function rp_satuan($angka,$debug)
    {
        $_terbilang           = '';
        $a_str['1']="Satu";
        $a_str['2']="Dua";
        $a_str['3']="Tiga";
        $a_str['4']="Empat";
        $a_str['5']="Lima";
        $a_str['6']="Enam";
        $a_str['7']="Tujuh";
        $a_str['8']="Delapan";
        $a_str['9']="Sembilan";

        $panjang=strlen($angka);
        for ($b=0;$b<$panjang;$b++)
        {
            $a_bil[$b]=substr($angka,$panjang-$b-1,1);
        }
        
        if ($panjang>2)
        {
            if ($a_bil[2]=="1")
            {
                $_terbilang=" Seratus";
            }
            else if ($a_bil[2]!="0")
            {
                $_terbilang= " ".$a_str[$a_bil[2]]. " Ratus";
            }
        }
        if ($panjang > 1)
        {
            if ($a_bil[1]=="1")
            {
                if ($a_bil[0]=="0")
                {
                    $_terbilang .=" Sepuluh";
                }
                else if ($a_bil[0]=="1")
                {
                    $_terbilang .=" Sebelas";
                }
                else
                {
                    $_terbilang .=" ".$a_str[$a_bil[0]]." Belas";
                }
                return $_terbilang;
            }
            else if ($a_bil[1]!="0")
            {
                $_terbilang .=" ".$a_str[$a_bil[1]]." Puluh";
            }
        }

        if ($a_bil[0]!="0")
        {
            $_terbilang .=" ".$a_str[$a_bil[0]];
        }
        return $_terbilang;

    }
}
?>