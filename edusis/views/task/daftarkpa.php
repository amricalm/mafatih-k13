<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>INPUT NILAI</h1>
<form action="" method="post">
<table width="100%">
<tr>
    <td width="100px">Kelas</td>
    <td width="300px">
    <?php
        $arraykelas = array('');
        foreach($kelass->result () as $rowkelas )
        {
            $arraykelas[$rowkelas->kelas]=$rowkelas->kelas;
        }
        echo form_dropdown('kelas',$arraykelas,$kelas,' id="kelas" ');
    ?>
    </td>                      
</tr>
<tr>
    <td>Mata Pelajaran</td>
    <td>
    <?php
        $arraymp = array('');
        foreach($kdmp->result () as $rowmp )
        {
            $arraymp[$rowmp->kd_mp]=$rowmp->nm_mp;
        }
        echo form_dropdown('kd_mp',$arraymp,$kd_mp,' id="mp" ');
    ?>
    </td>
    <td>
        <input type="submit" name="submit" id="submit" value="Filter" class="input button blue"/>
    </td>
</tr>
</table>
</form>
<br/>
<form action="<?php echo base_url().'index.php/task/save'?>" method="post">
<input type="hidden" name="kelas" id="kelas" value="<?php echo $kelas; ?>"/>
<input type="hidden" name="kd_mp" id="kd_mp" value="<?php echo $kd_mp; ?>"/>
<input type="hidden" name="kd_jenis_nilai" id="kd_jenis_nilai" value="<?php //echo $kd_jenis_nilai; ?>"/>
<table class="tables" style="width:100%;">
<tr>
    <th width="2%">#</th>
    <th width="10%">NIS</th>
    <th width="78%">Nama Siswa</th>
    <th width="10%">Nilai</th>
    <!--<th width="10%">Psikomotorik</th>
    <th width="10%">Afektif</th>-->
</tr>
    <?php
        $i = 1;
        if($this->input->post('submit'))
        {
            foreach($kpa->result() as $row )
            {
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$row->nis.'</td>';
                echo '<td>'.$row->nama_lengkap.'</td>';
                echo '<input type="hidden" name="nilai[]" id="nilai[]" value="'.$row->nis.'"/>';
                echo '<td align="right"><input type="text" name="kgn'.($i-1).'" id="kgn" value="'.trim($row->kgn).'" style="width: 100px; background:transparent; border:none; text-align:center;"/></td>';
                //echo '<td align="right"><input type="text" name="psk'.($i-1).'" id="psk" value="'.$row->psk.'" style="width: 100px;"/></td>';
                //echo '<td align="right"><input type="text" name="afk'.($i-1).'" id="afk" value="'.$row->afk.'" style="width: 100px;"/></td>';
                $i++;
                echo '</tr>';
            }
        }
    ?>
</table>
<table width="100%">
<tr>
    <td align="right">
        <input type="submit" name="simpan" id="simpan" class="input-submit blue" value="Simpan" />
        <input type="reset" name="batal" id="batal" class="input-submit blue"value="Cancel"/>
    </td>
</tr>
</table>
</form>
</body>
</html>