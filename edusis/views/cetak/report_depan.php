<html><head><link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" />
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" /><!-- WRITE YOUR CSS CODE HERE -->
<title>SAMPUL RAPORT</title>
<style>
	@media all {*{
		font-family: Calibri, sans-serif;
	}
	}
</style>
</head><body><table width="100%" border="0" align="center" cellpadding="3" style="padding-top: 70px;">
    <tr>
        <td align="center" style="font-size: 24px; font-weight: bold;">LAPORAN HASIL BELAJAR SISWA</td>
    </tr>
    <tr>
        <td align="center" style="font-size: 24px; font-weight: bold;">SEKOLAH DASAR ISLAM TERPADU</td>
    </tr>
    <tr>
        <td align="center" style="font-size: 24px; font-weight: bold;"><img width="100px" src="edusis_asset/edusisimg/nama_sdit_mafatih.jpg" /></td>
    </tr>
    <tr>
        <td height="20px"></td>
    </tr>
    <tr>
        <td align="center" style="font-size: 24px; font-weight: bold;">Tahun Pelajaran <?php echo $this->session->userdata('th_ajar');?></td>
    </tr>
    <tr>
        <td align="center" style="font-size: 24px; font-weight: bold;">
        <?php
            if ($this->session->userdata('kd_semester') == 1) {
                if($this->session->userdata('sub_pnl') == "UTS")
                {
                    echo '[ Penilaian Tengah Semester - Ganjil ]'; 
                } else {
                    echo '[ Penilaian Akhir Semester - Ganjil ]'; 
                }                 
            } else {
                if($this->session->userdata('sub_pnl') == "UTS")
                {
                    echo '[ Penilaian Tengah Semester - Genap ]'; 
                } else {
                    echo '[ Penilaian Akhir Tahun - Genap ]'; 
                }
            }
        ?>
        </td>
    </tr>
    <tr>
        <td height="70px"></td>
    </tr>
    <tr>
        <td align="center"><img width="350px" src="edusis_asset/edusisimg/logo_sdit_mafatih.jpg" /></td>
    </tr>
    <tr>
        <td height="70px"></td>
    </tr>
    <tr>
        <td height="">
        <table align="center" style="width: 70%;">
            <tr>
                <td rowspan="3" width="4%">&nbsp;</td>
                <td align="left" style="font-size: 16px; width: 30%;"><b>Nama Siswa</b></td>
                <td style="width: 5%; font-size: 16px; font-weight: bold;">:</td>
                <td align="left" style="font-size: 16px; width: 60%; font-weight: bold;"><?php echo $datasiswa->row()->nama_lengkap;?></td>
                <td rowspan="3" width="1%">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" style="font-size: 16px;"><b>No Induk Siswa</b></td>
                <td style="font-size: 16px; font-weight: bold;">:</td>
                <td align="left" style="font-size: 16px; font-weight: bold;"><?php echo $datasiswa->row()->nis; ?></td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td height="30px"></td>
    </tr>
    <tr style="margin-bottom= 0;">
        <td align="center" style="font-size: 20px;" ><b>Jl. Rawa Gede No. 55 Pondok Melati</b></td>
    </tr>
    <tr>
        <td align="center" style="font-size: 20px;" ><b>BEKASI - JAWA BARAT</b></td>
    </tr>
</table></body></html>
