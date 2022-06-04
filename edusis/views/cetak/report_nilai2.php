<html>
<head>
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" /> 
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" /><!-- WRITE YOUR CSS CODE HERE -->
<title>Raport</title>
<body>
<table align="center" border="0" width="95%" style=" font-size: 0.9em;">
    <tr>
    	<td width="25%">Nama Sekolah</td>
    	<td width="35%">: <?php echo $sekolah->row()->nama_sekolah;?></td>
    	<td width="25%">Kelas</td>
    	<td width="20%">: <?php echo str_replace('+',' ',$this->uri->segment(3));?></td>
    </tr>
    <tr>
    	<td>Alamat</td>
    	<td>: <?php echo $sekolah->row()->alamat_sekolah;?></td>
    	<td>Semester</td>
    	<td>: <?php echo $this->session->userdata('kd_semester');?></td>
    </tr>
    <tr>
    	<td>Nama Peserta Didik</td>
    	<td>: <?php echo $datasiswa->row()->nama_lengkap;?></td>
    	<td>Tahun Pelajaran</td>
    	<td>: <?php echo $this->session->userdata('th_ajar');?></td>
    </tr>
    <tr>
        <td>Nomor Induk/NISN</td>
    	<td>: <?php echo $datasiswa->row()->nis;?></td>
    </tr>
</table>
<h4><b>&nbsp;&nbsp;&nbsp;&nbsp;CAPAIAN KOMPETENSI</b></h4>
<table style=" border-collapse:collapse; font-size: 0.9em; " align="center" border="1" width="95%" cellpadding="0">
    <tr style="background: #ace695;" >
    	<th colspan="2" width="40%">Mata Pelajaran</th>
        <th width="25%">Kompetensi</th>
        <th width="35%">Catatan</th>
    </tr>
    <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
        <?php
        $a  = 0;
        $i  = 1;
        $jmlkgn = 0;
		//print_r($hasilbelajar->result());die();
        foreach($hasilbelajar->result() as $row)
        { 
            $bg = ($i%2==0) ? ' class="bg" ' : '';
            echo '<tr'.$bg.'>';
            echo '<td rowspan="3" width="3%" align="center">'.$i.'</td>';
            echo '<td rowspan="3" width="10%" style="padding: 5px;">'.$row->nm_mp.'</td>';
            echo '<td width="10%" align="center">Pengetahuan</td>';
			echo '<td width="20%" align="center" style="padding: 5px;"> $row->comment_pengetahuan </td>';
            echo '</tr>';
            
            echo '<tr>';
            echo '<td width="10%" align="center">Keterampilan</td>';
            echo '<td width="20%" align="center"></td>';
            echo '</tr>';
            
            echo '<tr>';
            echo '<td width="10%" align="center">Sikap Spiritual dan Sosial</td>';
            echo '<td width="20%" align="center"></td>';
            echo '</tr>';
            

            
            
			$i++;
            $a++;
        }
        ?>

        <?php }?>
</table>
<br />
<?php if($this->session->userdata('kd_semester')==1){ ?>
    <table align="center" border="0" width="95%"  >
    <tr>
        <td width="5%"></td>
        <td>
        <table style="border: 1px; border-collapse: collapse; font-size: 13px;">
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="center">Mengetahui</td>
            </tr>
            <tr>
            	<td align="center">Orang Tua / Wali <br /><br /><br /></td>
            </tr>
            <tr>
            	<td align="center" style="border-bottom: 1px; text-decoration: underline;"><?php echo $datasiswa->row()->ayah_nama  ?></td>
            </tr>
        </table>
        </td>
        <td  width="30%">
        <table style="border: 1px; border-collapse: collapse; font-size: 13px;">
            <tr>
                <td align="left;"><?php echo $sekolah->row()->kabupaten;?>,&nbsp;<?php echo $tgl_rapor;//$pilihtgl = date('d'); $pilihbln = date('m'); $pilihth = date('y'); echo $pilihtgl ; echo ' - '; echo $pilihbln; echo ' - '; echo '20'; echo $pilihth; ?></td>
            </tr>
            <tr>
            	<td align="center" colspan="3"><b>Wali Kelas</b><br /><br /><br /></td>
            </tr>
            <tr>
            	<td align="center" colspan="3" style="border-bottom: 1px; text-decoration: underline;"><b><?php $h= ($walikelas->num_rows()>0) ? $walikelas->row()->nama_lengkap : ''; echo $h ?></b></td>
            </tr>
            <tr>
            	<td align="center" colspan="3"><b>NIP.<?php $nip= ($walikelas->num_rows()>0) ? $walikelas->row()->nip : ''; echo $nip ?></b></td>
            </tr>
        </table>
        </td>
    </tr>
    </table>
<?php } else{?>
    <table align="center" border="0" width="95%" style="font-size: 13px;"  >
    <tr>
        <td colspan="2" width="33%">
        <table style="border: 1px; border-collapse: collapse; font-size: 13px; width: 100%;">
            <tr>
                <td>&nbsp;</td>
            </tr><tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
            	<td align="center"><b>Orang Tua / Wali</b><br /><br /><br /></td>
            </tr>
            <tr>
            	<td align="center" style="border-bottom: 1px; text-decoration: underline;"><b><?php echo $datasiswa->row()->ayah_nama  ?></b></td>
            </tr>
        </table>
        </td>
        <td colspan="2" width="34%"  align="center">
        <table style="border: 1px; border-collapse: collapse; font-size: 13px; width: 100%;">
            <tr>
                <td>&nbsp;</td>
            </tr><tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
            	<td align="center" colspan="3"><b>Wali Kelas</b><br/><br/><br/></td>
            </tr>
            <tr>
            	<td align="center" colspan="3" style="border-bottom: 1px; text-decoration: underline;"><b><?php $h= ($walikelas->num_rows()>0) ? $walikelas->row()->nama_lengkap : ''; echo $h ?></b></td>
            </tr>
            <tr>
            	<td align="center" colspan="3"><b>NIP.<?php $nip= ($walikelas->num_rows()>0) ? $walikelas->row()->nip : ''; echo $nip ?></b></td>
            </tr>
        </table>
        </td>
        <td colspan="2" width="33%" align="center">
        <table style="border: 1px; border-collapse: collapse; font-size: 13px; width: 100%;">
            <tr>
                <td align="center;" colspan="3" ><?php echo $sekolah->row()->kabupaten;?>,&nbsp;
                    <?php 
                    echo $tgl_rapor;
                    //$pilihtgl = date('d', strtotime($tgl_lhb)); $pilihbln = date('m', strtotime($tgl_lhb)); $pilihth = date('y', strtotime($tgl_lhb)); 
                    
                    //echo $pilihtgl ; echo ' - '; 
                    //echo $pilihbln; echo ' - '; 
                    //echo '20'; echo $pilihth; ?></td>
            </tr>
            <tr>
            	<td align="center" colspan="3">Mengetahui<br /></td>
            </tr>
            <tr>
            	<td align="center" colspan="3"><b>Kepala Sekolah</b><br /><br /><br /></td>
            </tr>
            <tr>
            	<td align="center" colspan="3" style="border-bottom: 1px; text-decoration: underline;"><b><?php $h= ($kepsek->num_rows()>0) ? $kepsek->row()->nama_lengkap : ''; echo $h ?></b></td>
            </tr>
            <tr>
            	<td align="center" colspan="3"><b>NIP.<?php $nip= ($kepsek->num_rows()>0) ? $kepsek->row()->nip : ''; echo $nip ?></b></td>
            </tr>
        </table>
        </td>
    </tr>
    </table>
<?php }?>
</body>
</html>
