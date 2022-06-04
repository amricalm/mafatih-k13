<html>
<head>
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" /> 
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" /><!-- WRITE YOUR CSS CODE HERE -->
    <title>Ledger UTS</title>
</head>
<body>
<table style="width: 100%;font-size: 11px;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" rowspan="4" ><img src="edusis_asset/edusisimg/logo.jpg" style="width: 60px;"/></td>
        <td align="left" colspan="2"style="text-transform:uppercase"><b><?php echo $sekolah->row()->nama_sekolah ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>DAFTAR NILAI HASIL BELAJAR</b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?></b></td>
    </tr>
    
    <tr>
        <td align="left" colspan="2" >&nbsp;</td>
    </tr>
    <tr>
        <td style="width:14%;font-size: 11px;"><br/>Mata Pelajaran<br /></td>
        <td style="width:1%;font-size: 11px;">:<br /></td>
        <td style="width:89%;font-size: 11px;"><?php echo $mp->row()->nm_mp; ?><br /></td>
    </tr>
    <tr>
        <td style="font-size: 11px;">Kelas<br /><br /></td>
        <td style="font-size: 11px;">:<br /><br /></td>
        <td style="font-size: 11px;"><?php echo str_replace('+',' ',$this->uri->segment(3)); ?><br /><br /></td>
    </tr>
</table>
<!-- Table dari App -->
        <table style=" border-collapse:collapse; size: landscape; font-size: 11px; " align="center" border="1" align="center%" width="100%" cellpadding="0">
        	<tr>
        		<th rowspan="2" width="2%">NO</th>
        		<th rowspan="2" width="5%">NO.INDUK</th>
        		<th rowspan="2" width="25%">NAMA SISWA</th>
        		<th colspan="8" width="75%">NILAI SIKAP</th></tr>
        	<tr>
        		<th style="font-size:11px ;" width="2%">DIRI</th>
        		<th style="font-size:11px ;" width="2%">TEMAN</th>
        		<th style="font-size:11px ;" width="2%">JURNAL</th>
        		<th style="font-size:11px ;" width="2%">OBS</th>
        		<th style="font-size:11px ;" width="2%">RAPORT</th>
                <th style="font-size:11px ;" width="2%">KON</th>
                <th style="font-size:11px ;" width="2%">PRE</th>
                <th style="font-size:11px ;" width="54%">DESKRIPSI SIKAP SOSIAL - SPIRITUAL</th>
        	</tr>
            <?php 
            $i  = 1;
            if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') { 
            foreach($hasilbelajar->result() as $row)
            {
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center">'.$i.'</td>';
                echo '<td align="left">'.$row->nis.'</td>';
                echo '<td>'.$row->nama_lengkap.'</td>';
                
                echo '<td align="center" style="font-size:11px ;">80</td>';   
                echo '<td align="center" style="font-size:11px ;">70</td>';
                echo '<td align="center" style="font-size:11px ;">65</td>';
                echo '<td align="center" style="font-size:11px ;">70</td>';
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">71</font></b></td>';
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">2.33</font></b></td>';
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">C+</font></b></td>';
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">Capaiannya Sudah Sesuai Kompetensi</font></b></td>';
                echo '</tr>';
              }
              }  
            ?>
        </table>
<!-- End Table dari APP -->
<br />
<table style="font-size: 11px;" align="center" border="0" width="100%" >
<tr>
    <td width="2%">&nbsp;</td>
    <td width="78%">
    <table style="font-size: 11px;">
        <tr>
            <td align="left">Mengetahui,</td>
        </tr>
        <tr>
        	<td align="left"><b>Kepala <?php echo $sekolah->row()->nama_sekolah ?></b><br /><br /></td>
        </tr>
        <tr>
        	<td align="left"><u><?php echo $kepsek->row()->nama_lengkap;?></u></td>
        </tr>
        <tr>
        	<td align="left">NIP. <?php echo $kepsek->row()->nip; ?></td>
        </tr>
    </table>
    </td>
    <td width="20%">
    <table style="font-size: 11px;">
        <tr>
            <td align="left"><?php echo $sekolah->row()->kabupaten;?>, <?php $arraytgl = $this->app_model->tgl(); $pilihtgl = date('d'); $pilihbln = date('m');;$pilihth = date('y'); echo $pilihtgl ;echo ' - '; echo $pilihbln; echo ' - ';echo '20'; echo $pilihth;?></td>
        </tr>
        <tr>
        	<td align="left"><b>Wali Kelas</b><br /><br /></td>
        </tr>
        <tr>
        	<td align="left"><u><?php $h= ($walikelas->num_rows()>0) ? $walikelas->row()->nama_lengkap : ''; echo $h ?></u></td>
        </tr>
        <tr>
        	<td align="left">NIP.<?php $nip= ($walikelas->num_rows()>0) ? $walikelas->row()->nip : ''; echo $nip ?></td>
        </tr>
    </table>
    </td>
</tr>
</table>
</body>
</html>