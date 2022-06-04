<html>
<head>
<title>Raport</title>
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" /> 
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" />
</head>
<body>
<table align="center" border="0" width="100%" style=" font-size: 0.9em;">
    <tr>
        <td align="center" rowspan="4" ><img src="edusis_asset/edusisimg/mafatih.jpg"/></td>
        <td align="center" colspan="2"style="text-transform:uppercase;font-size: 20px;"><b>PROGRES REPORT</b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>&nbsp;</b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>&nbsp;</b></td>
    </tr>
    
    <tr>
        <td align="left" colspan="2" >&nbsp;</td>
    </tr>
    <tr>
    	<td width="25%">Nama Peserta Didik</td>
    	<td width="40%">: <?php echo $nama->row()->nama_lengkap;?></td>
    	<td width="15%">Kelas</td>
    	<td width="20%">: <?php echo $hasilbelajar->row()->kelas;?></td>
    </tr>
    <tr>
    	<td>Nomor Induk</td>
    	<td>: <?php echo $nama->row()->nis;?></td>
    	<td>Semester</td>
    	<td>: <?php $f = ($this->session->userdata('kd_semester')==1) ? '( Ganjil )' : '( Genap )'; echo $f;?></td>
    </tr>
    <tr>
    	<td>Nama Sekolah</td>
    	<td>: <?php echo $sekolah->row()->nama_sekolah;?></td>
    	<td>Tahun Ajaran</td>
    	<td>: <?php echo $this->session->userdata('th_ajar');?></td>
    </tr>
    <tr>
    	<td colspan="4">&nbsp;</td>
    </tr>
</table>
<table align="center" border="1" width="100%" style=" border-collapse: collapse; font-size: 0.9em;">
    <tr style="background: #E1E1E1;">
    	<th width="3%" height="25px">No</th>
        <th width="37%">Mata Pelajaran</th>
        <th width="12%">KKM</th>
        <th width="12%">Tugas</th>
    	<th width="12%">UH</th>
    	<th width="12%"><?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?></th>
    	<th width="12%">NR</th>
    </tr>
    <?php
    $a  = 0;
    $i  = 1;
    $jmlkgn = 0;
    foreach($hasilbelajar->result() as $row)
    { 
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        echo '<tr'.$bg.'>';
        echo '<td width="3%" align="center">'.$i.'</td>';
        echo '<td width="22%">&nbsp;&nbsp;&nbsp;'.$row->nm_mp.'</td>';
        echo '<td width="4%" align="center">'.$row->skbm.'</td>';
        
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['p_nl']           = $this->session->userdata('kd_semester');
        $data['sub_pnl']        = $this->session->userdata('sub_pnl');
        $data['kd_mp']          = $row->kd_mp;
        $data['kelas']          = str_replace('+',' ',$this->uri->segment(3));
        $data['nis']            = $this->uri->segment(4);
        $var_array              = $this->hasilbelajar_model->Get_Nilai($data);
        //echo $this->db->last_query();
        //die();
        $TGS                    = 0;
        $jumlahNaUH             = 0;
        $jumlahNa               = 0;
        $jumlahUH               = 0;
        $NaUH                   = 0;
        $UTS                    = 0;
        $NR                     = 0;
        $jumlahTGS              = 0;
        $jumlahUTST             = 0;
        $jumlahUTSP             = 0;
        $NR1                    = 0;
        $NR2                    = 0;
        $NR3                    = 0;
        if($var_array->num_rows()>0)
        {
            foreach($var_array->result() as $rowvar_array)
            {
                if(strstr($rowvar_array->kd_tagihan,'TGS')!='')
                {
                    $TGS = $jumlahTGS += $rowvar_array->kgn / 3;
                    $NR1 = $TGS * 0.3;
                }
                elseif(strstr($rowvar_array->kd_tagihan,'UHT')!='')
                {
                    $Na   = $jumlahNa += $rowvar_array->kgn;
                    $UH   = $jumlahUH += $rowvar_array->psk;
                    $NaUH = ($Na + $UH) / 6;
                    $NR2 = $NaUH * 0.3;
                    
                }
                elseif(strstr($rowvar_array->kd_tagihan,'UTS')!='')
                {
                    $UTST = $jumlahUTST += $rowvar_array->kgn;
                    $UTSP = $jumlahUTSP += $rowvar_array->psk;
                    $ab   = ($UTST == '0' || $UTST == '' ) ? '0' : 1;
                    $ba   = ($UTSP == '0' || $UTSP == '' ) ? '0' : 1;
                    $abc  = $ab + $ba;
                    $UTS  = ($abc == 0) ? 0 : ($UTST + $UTSP) / $abc;
                    $NR3  = $UTS * 0.4;
                }
                else{}
                $NR   = $NR1 + $NR2 + $NR3;
            }
        }
        echo '<td align="center">'.round($TGS).'</td>
              <td align="center">'.round($NaUH).'</td>
              <td align="center">'.round($UTS).'</td>
              <td align="center">'.round($NR).'</td>';
        $i++;
    }
    ?>
</table>
<!--end table hasil study-->
<table><tr><td>&nbsp;</td></tr></table>
<table border="1" width="100%" style="border-bottom: none; border-left: none; border-right: none; border-top: none;" >
<tr>
    <td width="50%" style="vertical-align: top; border: 2px;">
        <table border="1" width="100%" style="border: 1px; border-collapse: collapse; font-size: 0.9em;" >
        <tr style="background: #E1E1E1;">
        	<th width="3%">No</th>
            <th width="25%">Kepribadian</th>
            <th width="10%">Nilai</th>
        </tr>
        
        <?php   
            $i = 1;
            foreach($pribadi->result() as $row)
            {
                echo '<tr>';
                echo '<td align="center">'.$i.'</td>';
                echo '<td>&nbsp;&nbsp;&nbsp;'.$row->ket_pribadi.'</td>';
                $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
                echo '<td align="center">'.$nilai.'</td>';
                echo '</tr>';
                $i++;
            }
        ?>
        </table>
    </td>
    <td width="50%" style="vertical-align: top; border: 2px;">
        <table border="1" width="100%" style="border: 1px; border-collapse: collapse; font-size: 0.9em;" >
        <tr style="background: #E1E1E1;">
        	<th width="25%">Ketidakhadiran</th>
            <th width="10%">Hari</th>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;Sakit</td>
            <td align="center"><?php $a=($absens->row()->alfa == '0') ? '-' : $absens->row()->alfa; echo $a; ?></td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;Ijin</td>
            <td align="center"><?php $a=($abseni->row()->alfa == '0') ? '-' : $abseni->row()->alfa; echo $a; ?></td>
        </tr>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;Tanpa Keterangan</td>
            <td align="center"><?php $a=($absena->row()->alfa == '0') ? '-' : $absena->row()->alfa; echo $a; ?></td>
        </tr>
        <tr>
            <td colspan="2" style="border-right: none; border-left: none;border-bottom: none;">&nbsp;</td>
        </tr>
        <tr style="background: #E1E1E1;">
            <th width="25%">Ekstrakurikuler</th>
            <th width="10%">Nilai</th>
        </tr>
        <?php   
            $i = 1;
            foreach($eskul->result() as $row)
            {
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td>&nbsp;&nbsp;&nbsp;'.$row->nm_eskul.'</td>';
                $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
                echo '<td align="center">'.$nilai.'</td>';
                echo '</tr>';
                $i++;
            }
        ?>
        </table>
    </td>
</tr>
</table>
<table><tr><td>&nbsp;</td></tr></table>
<table border="1" width="100%" style=" border-collapse: inherit; font-size: 16px;">
    <tr>
        <td style="width:100% ;border: none;"><b>Catatan :</b></td>
    </tr>
    <tr>
        <td style=" font-weight: bold; width:100% ; height: 70px; font-family:bradley hand ITC; src: url('<?php echo base_url();?>edusis_asset/edusisimg/BradhITC.ttf'); font-size:16px ; padding: 10px 10px; color: black; "><?php $comment; ?></td>
    </tr>
</table>
<br />
<br />
<table style="font-size: 1em;"align="center" border="0" width="80%" >
<tr>
    <td>
    <table style="font-size: 1em;">
        <tr>
            <td align="left">Mengetahui,</td>
        </tr>
        <tr>
        	<td align="left"><b>Kepala Sekolah,</b><br /><br /><br /></td>
        </tr>
        <tr>
        	<td align="left"><u><b><?php echo $kepsek->row()->nama_lengkap;?></b></u></td>
        </tr>
        <tr>
        	<td align="left">NIP. <?php echo $kepsek->row()->nip; ?></td>
        </tr>
    </table>
    </td>
    <td  width="40%">
    <table style="font-size: 1em;">
        <tr>
            <td align="left;"><?php echo $sekolah->row()->kabupaten;?>, <?php echo $tgl_lhb; ?></td>
        </tr>
        <tr>
        	<td align="left"><b>Wali Kelas </b><br /><br /><br /></td>
        </tr>
        <tr>
            <td align="left"><u><b><?php $h= ($walikelas->num_rows()>0) ? $walikelas->row()->nama_lengkap : ''; echo $h ?></b></u></td>
        </tr>
        <tr>
            <td align="left">NIP.<?php $nip= ($walikelas->num_rows()>0) ? $walikelas->row()->nip : ''; echo $nip ?></td>
        </tr>
    </table>
    </td>
</tr>
</table>
<!--<div class="sembunyi-kanan">
    <a href="<?php //echo base_url().'index.php/export/export_nilai1/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Export pdf" class="small button blue"><img src="<?php //echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
</div>--> 
</body>
</html>