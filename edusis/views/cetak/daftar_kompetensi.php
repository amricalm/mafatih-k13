<!DOCTYPE html>
<html>
<head>
    <title>Ledger Nilai</title>
</head>
<body>
    <table style="width: 95%;" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center"style="font-size: 14px; font: bold;" colspan="3" ><b>KOMPETENSI</b></td>
        </tr>
        <tr>
            <td align="center"style="font-size: 14px; font: bold; text-transform: uppercase;" colspan="3" ><b><?php echo $sekolah->row()->nama_sekolah;?> <?php echo $sekolah->row()->kabupaten;?></b></td>
        </tr>
        <tr>
            <td style="width:10%; font-size: 13px; ">Tahun Ajar<br /></td>
            <td style="width:1%; font-size: 13px; ">:<br /></td>
            <td style="width:84%; font-size: 13px; "><?php echo $this->session->userdata('th_ajar');?><br /></td>
        </tr>
        <tr>
            <td style="font-size: 13px; ">Semester<br /></td>
            <td style="font-size: 13px; ">:<br /></td>
            <td style="font-size: 13px; "><?php echo ($this->session->userdata('kd_semester')==1) ? 'Ganjil' : 'Genap';?><br /></td>
        </tr>
        <?php if($this->uri->segment(4)!='0' || $this->uri->segment(4)!=''){ ?>
            <tr>
                <td style="font-size: 13px; ">Mata Pelajaran<br /></td>
                <td style="font-size: 13px; ">:<br /></td>
                <td style="font-size: 13px; "><?php echo $mp->row()->nm_mp;?><br /></td>
            </tr>
        <?php }?>
        <tr>
            <td style="font-size: 13px; ">Tingkat/Kelas<br /><br /></td>
            <td style="font-size: 13px; ">:<br /><br /></td>
            <td style="font-size: 13px; "><?php $t=''; if($this->uri->segment(3)==1){ $t = '(Satu)';} elseif($this->uri->segment(3)==2){ $t = '(Dua)';} elseif($this->uri->segment(3)==3){ $t = '(Tiga)';} elseif($this->uri->segment(3)==4){ $t = '(Empat)';} elseif($this->uri->segment(3)==5){ $t = '(Lima)';} elseif($this->uri->segment(3)==6){ $t = '(Enam)';} else{$t='';} echo $this->uri->segment(3);echo' / '; echo $t;?><br /><br /></td>
        </tr>
    </table>
    <table style=" border-collapse:collapse; font-size: 12px; " align="center" border="1" align="center%" width="95%" cellpadding="3px">
        <tr  style="background: #E1E1E1;">
            <th width="10%" height="25px" >Mata Pelajaran</th>
            <th width="30%">Standar Kompetensi</th>
            <th width="30%">Kompetensi Dasar</th>
            <th width="30%">Indikator</th>
        </tr>
        <?php
        $sk     = '';
        $kd     = '';
        $idr    = '';
        $mp     = '';
        $i      = '';
        foreach($kompetensi->result() as $row)
        {
            echo '<tr>';
            echo '<td width="10%">';
            if($mp!=$row->nm_mp)
            {
                echo $row->nm_mp;
                $mp = $row->nm_mp;
            }
            echo '</td>';
            
            echo '<td width="30%">';
            if($sk!=$row->ket_sk)
            {
                echo '<b>&curren;&nbsp;&nbsp;&nbsp;</b>'; echo $row->ket_sk;
                $sk = $row->ket_sk;
            }
            echo '</td>';
            
            echo '<td width="30%">';
            if($kd!=$row->ket_kd)
            {
                echo '<b>&gt;&nbsp;&nbsp;&nbsp;</b>'; echo $row->ket_kd;
                $kd = $row->ket_kd;
            }
            echo '</td>';
            
            echo '<td width="30%">';
            if($idr!=$row->ket_idr)
            {
                echo '<b>&gt;&gt;&nbsp;&nbsp;&nbsp;</b>'; echo $row->ket_idr;
                $idr = $row->ket_idr;
            }
            echo '</td>';
            $i++;
            echo '</tr>';
        }
        ?>
    </table>
<br /><br />
</body>
</html>