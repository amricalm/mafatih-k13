<html>
<head>
<style type="text/css">
.box_rotate {
     -moz-transform: rotate(90deg);  /* FF3.5+ */
       -o-transform: rotate(90deg);  /* Opera 10.5 */
  -webkit-transform: rotate(90deg);  /* Saf3.1+, Chrome */
             filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
         -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; /* IE8 */
}
</style>

    <title>Ledger UTS</title>
</head>
<body>
<table style="width: 100%;font-size: 11px;" border="0" cellpadding="0" cellspacing="0">  
    <tr>
        <td align="left" colspan="4" >&nbsp;</td>
    </tr> 
    <tr>
        <td align="left" colspan="4" >&nbsp;</td>
    </tr>
    <tr>
        <td align="center" rowspan="4" ><img src="edusis_asset/edusisimg/mafatih.jpg"/></td>
        <td align="left" colspan="2"><b>FORM PENILAIAN SIKAP</b></td>
    </tr>
    <tr>
        <td align="left" colspan="2" style="text-transform:uppercase"><b><?php echo $sekolah->row()->nama_sekolah ?> - <?php echo $sekolah->row()->kabupaten ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?></b></td>
    </tr>
    
    <tr>
        <td align="left" colspan="2" >&nbsp;</td>
    </tr>
    <tr>
        <td style="width:14%;font-size: 11px;">Mata Pelajaran<br /></td>
        <td style="width:1%;font-size: 11px;">:<br /></td>
        <td style="width:89%;font-size: 11px;"><?php echo $mp->row()->nm_mp; ?><br /></td>
    </tr>
    <tr>
        <td style="font-size: 11px;">Kelas</td>
        <td style="font-size: 11px;">:</td>
        <td style="font-size: 11px;"><?php echo str_replace('+',' ',$this->uri->segment(3)); ?></td>
    </tr>   
    <tr>
        <td align="left" colspan="3" >&nbsp;</td>
    </tr>
</table>
<br />
<table style=" border-collapse:collapse; size: landscape; font-size: 10px; " align="center" border="1" align="center%" width="100%" cellpadding="2">
    <tr>
    		<th width="2%" height="70px">NO</th>
    		<th width="5%" height="70px">NO.INDUK</th>
    		<th width="20%" height="70px">NAMA SISWA</th>        
            <?php 
                $this->load->helper('adn_text_helper');
                $seq = 1;
                foreach($sikap->result() as $row)
                {
                    echo '<th height="70px">'.$row->nm_sikap.'</th>';
                    $seq++;
                }
            ?>
    		<th width="5%" height="70px">Jumlah Skor</th>
    		<th width="5%" height="70px">Predikat Nilai</th>
   		</tr>
        <?php
        $seq = 1;
        if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0')
        {
            $nilai      = array();      
            foreach($nama->result() as $row)
            {
                $bg = ($seq%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center">'.$seq.'</td>';
                echo '<td align="center">'.trim($row->nis).'</td>';
                echo '<td>&nbsp;&nbsp;'.$row->nama_lengkap.'</td>';
                $j = 0;
                $nilai[$seq]                = 0;
                foreach($sikap->result() as $rowsikap)
                {
                    $jumlah = 0;
                    $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
                    $data['th_ajar']        = $this->session->userdata('th_ajar');
                    $data['p_nl']           = $this->session->userdata('kd_semester');
                    $data['sub_pnl']        = $this->session->userdata('sub_pnl');
                    $data['kelas']          = str_replace('+',' ',$this->uri->segment(3));
                    $data['kd_mp']          = str_replace('+',' ',$this->uri->segment(4));
                    $data['kd_tagihan']     = $rowsikap->kd_sikap;
                    $data['nis']            = $row->nis;
                    
                    $nilaiafk               = ($this->task_model->Get_Tampil_Nilai($data)->num_rows()>0) ? $this->task_model->Get_Tampil_Nilai($data)->row()->afk : '';
                    $nilai[$seq]            += $nilaiafk;
                    echo '<td align="center" style="font-size:10px">'.$nilaiafk.'</td>';
                    $j++;
                }
                //$jmh = ($nilai[$seq]==0) ? '' : $nilai[$seq];
                echo '<td align="center" style="font-size:10px"><b>'.$nilai[$seq].'</b></td>';
                $penilaian = '';
                if($nilai[$seq] >= (3.25 * $j) )
                {
                    $penilaian= 'A';
                }
                elseif($nilai[$seq] >= (1.375 * $j))
                {
                    $penilaian= 'B';
                }
                elseif($nilai[$seq] >= 1)
                {
                    $penilaian= 'C';
                }
                else{$penilaian= '';}
                echo '<td align="center" style="font-size:10px"><b>'.$penilaian.'</b></td>';
                
                echo '</tr>';
                $seq++;
           }             
        }
        ?>
</table>
<table style="font-size: 11px;" align="center" border="0" width="100%" >
<tr>
    <td width="2%">&nbsp;</td>
    <td width="39%">
    <table style="font-size: 11px;" border="0">
        <tr>
            <td align="left" colspan="3" style="border-bottom-color: white; none; border-color: white; border-right-color: white;" >* Penilaian afektif dilakukan secara berkala tengah semester dan akhir semester,</td>
        </tr>
        <tr>
            <td colspan="3" >&nbsp;</td>
        </tr>
        <tr>
        	<td align="left" colspan="3" ><b><u>Keterangan:</u></b><br /><br /></td>
        </tr>
        <tr>
        	<td align="center" width="50px">4</td>
        	<td align="left"  width="4px">:</td>
        	<td align="left">Sering</td>
        </tr>
        <tr>
        	<td align="center">3</td>
        	<td align="left">:</td>
        	<td align="left">Jarang</td>
        </tr>
        <tr>
        	<td align="center">2</td>
        	<td align="left">:</td>
        	<td align="left">Pernah</td>
        </tr>
        <tr>
        	<td align="center">1</td>
        	<td align="left">:</td>
        	<td align="left">Tidak Pernah</td>
        </tr>
    </table>
    </td>
    <td width="39%">
    <table style="font-size: 11px;">
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" >&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" >&nbsp;</td>
        </tr>
        <tr>
        	<td align="left" colspan="3" ><b><u>Jumlah Skor:</u></b><br /><br /></td>
        </tr>
        <tr>
        	<td align="center" width="50px">26 - 32</td>
        	<td align="left">:</td>
        	<td align="left">A</td>
        </tr>
        <tr>
        	<td align="center">11 - 25</td>
        	<td align="left">:</td>
        	<td align="left">B</td>
        </tr>
        <tr>
        	<td align="center">0 - 10</td>
        	<td align="left">:</td>
        	<td align="left">C</td>
        </tr>
    </table>
    </td>
    <td width="20%">
    <table style="font-size: 11px;">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
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
        	<td align="left">NIP.<?php $nip= ($walikelas->num_rows()>0) ? $walikelas->row()->nip : ''; echo $nip ?><?php echo $walikelas->row()->nip; ?></td>
        </tr>
    </table>
    </td>
</tr>
</table>
</body>
</html>