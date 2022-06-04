<html>
<head>
    <title>Ledger UTS</title>
</head>
<body>
<table style="width: 95%;font-size: 11px; " align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" rowspan="4" ><img src="edusis_asset/edusisimg/mafatih.jpg"/></td>
        <td align="left" colspan="2"style="text-transform:uppercase"><b><?php echo $sekolah->row()->nama_sekolah ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>LAPORAN ABSENSI SISWA</b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2" >&nbsp;</td>
    </tr>
    <tr>
        <td style="font-size: 11px;">Kelas<br /></td>
        <td style="font-size: 11px;">:<br /></td>
        <td style="font-size: 11px;"><?php echo str_replace('+',' ',$this->uri->segment(3)); ?><br /></td>
    </tr>
    <tr>
        <td style="width:14%;font-size: 11px;">Bulan<br /></td>
        <td style="width:1%;font-size: 11px;">:<br /></td>
        <?php
            if($this->uri->segment(4)==1)
            {$bln='Januari';}
            elseif($this->uri->segment(4)==2)
            {$bln='Februari';}
            elseif($this->uri->segment(4)==3)
            {$bln='Maret';}
            elseif($this->uri->segment(4)==4)
            {$bln='April';}
            elseif($this->uri->segment(4)==5)
            {$bln='Mei';}
            elseif($this->uri->segment(4)==6)
            {$bln='Juni';}
            elseif($this->uri->segment(4)==7)
            {$bln='Juli';}
            elseif($this->uri->segment(4)==8)
            {$bln='Agustus';}
            elseif($this->uri->segment(4)==9)
            {$bln='September';}
            elseif($this->uri->segment(4)==10)
            {$bln='Oktober';}
            elseif($this->uri->segment(4)==11)
            {$bln='Nopember';}
            elseif($this->uri->segment(4)==12)
            {$bln='Desember';}            
        ?>
        <td style="width:89%;font-size: 11px;"><?php echo $bln; ?><br /></td>
    </tr>
</table>
<table style=" border-collapse:collapse; size: landscape; font-size: 11px; " align="center" border="1" align="center%" width="95%" cellpadding="0">
        <tr style="background: #E1E1E1;" >
            <th width="1%" rowspan="2" style="font-size: 10px;">NO</th>
            <th width="7%" rowspan="2" style="font-size: 10px;">NIS</th>
            <th width="26%" rowspan="2" style="font-size: 10px;">NAMA SISWA</th>
            <th width="60%" colspan="31" style="font-size: 10px;">TANGGAL</th>
            <th width="1%" colspan="3" style="font-size: 10px;">JUMLAH</th>
        </tr>
        <tr style="background: #E1E1E1;" >
            <?php
            $x = 31;
            for($tgl=1;$tgl<=$x;$tgl++)
            {
                echo '<th width="2%">'.$tgl.'</th>';
            }
            ?>
            <th width="1%">&nbsp;a</th>
            <th width="1%">&nbsp;i&nbsp;</th>
            <th width="1%">&nbsp;s</th>
        </tr>
            <?php 
                $i = 1;
                foreach($siswa->result() as $row)
                {
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center"'.$bg.' >'.$i.'</td>';
                echo '<td align="center">'.trim($row->nis).'</td>';
                echo '<td>&nbsp;&nbsp;'.$row->nama_lengkap.'</td>';
                $a = '';
                $b = '';
                $s = '';
                for($absen=1;$absen<=$x;$absen++)
                {
                    $abs='';
                    $data['kd_sekolah']              = $this->session->userdata('kd_sekolah');
                    $data['p_nl']                    = $this->session->userdata('kd_semester');
                    $data['pilihtahun']              = $this->session->userdata('th_ajar');
                    $data['pilihkelas']              = str_replace('+',' ',$this->uri->segment(3));
                    $data['pilihbulan']              = $this->uri->segment(4);
                    $data['nis']                     = $row->nis;
                    $data['pilihtgl']                = $absen;
                    $var_array                       = $this->absen_model->getabsen($data['pilihbulan'],$data['pilihtahun'],$data['kd_sekolah'],$data['pilihkelas'],$data['pilihtgl'],$data['p_nl'],$data['nis']);
                    //echo $this->db->last_query();
                    foreach($var_array->result() as $rowvar_array)
                    {
                        $abs = $rowvar_array->absen;
                    }
                    $a   += ($abs == 'a');
                    $b   += ($abs == 'i');
                    $s   += ($abs == 's');
                    echo '<td align="center">'.$abs.'</td>';
                }
                echo '<td align="center">'.(($a==0) ? '' : $a).'</td>';
                echo '<td align="center">'.(($b==0) ? '' : $b).'</td>';
                echo '<td align="center">'.(($s==0) ? '' : $s).'</td>'; 
                echo '</tr>';
                $i++;
                }
            ?>
</table>
<br />
<table style="border-collapse: collapse; font-family: sans-serif;font-size: 12px; border: black; padding: 5px;margin: 5px auto; " width="95%" border="0" >
	<tr>
        <td width="50%"></td>
        <td align="center"><?php echo $sekolah->row()->kabupaten;?>, <?php $pilihtgl = date('d'); $pilihbln = date('m'); $pilihth = date('y'); echo $pilihtgl ; echo ' - '; echo $pilihbln; echo ' - '; echo '20'; echo $pilihth; ?></td>
    </tr>
    <tr>
        <td width="50%"></td>
        <td align="center"><b>Wali Kelas.</b></td>
    </tr>
    <tr>
        <td width="50%"></td>
        <td>&nbsp;<br />&nbsp;<br /></td>
    </tr>
    <tr>
        <td width="50%"></td>
        <td align="center"><u><?php $h= ($walikelas->num_rows()>0) ? $walikelas->row()->nama_lengkap : ''; echo $h ?></u></td>
    </tr>
    <tr>
        <td width="50%"></td>
        <td align="center">NIP.<?php $nip= ($walikelas->num_rows()>0) ? $walikelas->row()->nip : ''; echo $nip ?></td>
    </tr>
</table>
<!--<div class="sembunyi">
    <a href="<?php //echo base_url().'index.php/export/export_to_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>">Inport Pdf</a> |
</div>-->
</body>
</html>