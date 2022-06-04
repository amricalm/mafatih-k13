<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Konseling</title>
    </head>
    <body>
        <table style="width:100%;font-size: 11px;" border="0" >
            <tr>
                <td align="center" width="150px" rowspan="4" ><img src="edusis_asset/edusisimg/mafatih.jpg"/></td>
                <td align="left" colspan="2"style="text-transform:uppercase"><b><?php echo $sekolah->row()->nama_sekolah ?></b></td>
            </tr>
            <tr>
                <td align="left" colspan="2"><b>DAFTAR LAPORAN KONSELING SISWA</b></td>
            </tr>
            <tr>
                <td align="left" colspan="2"><b>TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?></b></td>
            </tr>
            
            <tr>
                <td align="left" colspan="2" >&nbsp;</td>
            </tr>
            <?php if($this->uri->segment(3)!='' && $this->uri->segment(4) != '' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '0') { ?>
            <tr>
                <?php $tgla = explode('-',$this->uri->segment(3)); $k=($tgla[0] == '0') ? ' ' : $tgla[0]; $l=($tgla[1] == '0') ? ' ' : $tgla[1];$m=($tgla[2] == '0') ? ' ' : $tgla[2]; ?>
                <?php $tglb = explode('-',$this->uri->segment(4)); $s=($tglb[0] == '0') ? ' ' : $tglb[0]; $t=($tglb[1] == '0') ? ' ' : $tglb[1];$u=($tglb[2] == '0') ? ' ' : $tglb[2]; ?>
                <td colspan="3"  style="width:10%; font-size: 11px;"><b>Periode&nbsp;:&nbsp;&nbsp;<?php echo $m.' '.$l.' '.$k?>&nbsp;S/d&nbsp;<?php echo $u.' '.$t.' '.$s?></b><br /></td>
            </tr>
            <?php } ?>
        </table>
        <table style="width: 100%; border-collapse: collapse; font-size: 12px;" border="1" >
            <tr style="background: #E1E1E1;">
                <th width="2%" height="25px">No.</th>
				<th width="8%">NIS</th>
                <th width="20%">Nama Siswa</th>
                <th width="10%">Kelas</th>
				<th width="8%">Tanggal</th>
				<th width="26%">Konseling Siswa</th>
				<th width="26%">Solusi Guru BK</th>
            </tr>
            <?php
                $seq        = 1;
                foreach($konseling->result() as $row)
                {
            ?>
            <tr>
                <td align="center"><?php echo $seq; ?></td>
                <td align="center"><?php echo $row->nis; ?></td>
                <td align="center">&nbsp;&nbsp;<?php echo $row->nama_lengkap; ?></td>
                <td><?php echo $row->kelas; ?></td>
				<?php //$tgl = ($row->tgl == '' || $row->tgl == '0'|| $row->tgl == 'NULL') ? explode(' ','0 0 0') : explode(' ',$row->tgl);
                //$a=($tgl[0] == '0') ? ' ' : $tgl[0];
                //$b=($tgl[1] == '0') ? ' ' : $tgl[1];
                //$c=($tgl[2] == '0') ? ' ' : $tgl[2];
                echo '<td align="center">'.$row->tglpanjang.'</td>';?>
                <td>&nbsp;&nbsp;<?php echo $row->masalah; ?></td>
				<td>&nbsp;&nbsp;<?php echo $row->solusi; ?></td>
            </tr>
            <?php $seq++; } ?>
		</table>
        <br/>
		<br/>
		<table style="width: 100%; solid #000" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="95%" align="right">Petugas BK</td>
			<td width="5%"></td>
		</tr>
		</table>
    </body>
</html>