<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>PELANGGARAN SISWA</h1>
		
        <form action="<?php echo base_url().'index.php/lappelanggaran/daftar' ?>" name="frmcari" id="frmcari" method="post">
        <table width="100%" border="0">
            <tr style="border:none;">
                <td style="text-align:left;width:150px">
                    <input type="text" style="width: 150px;" size="50" name="tgldari" id="tgldari" placeholder="Tanggal dari" class="tgl input-text" value="<?php echo $tgldari ?>" /><br/>							
                </td>
                <td style="width:10px">S/D</td>
                <td style="text-align:left;width:150px">
                    <input type="text" style="width: 150px;"  size="50" name="tglsampai" id="tglsampai" placeholder="Tanggal sampai" class="tgl input-text" value="<?php echo $tglsampai ?>" /><br/>							
                </td>
                <td style="text-align:left"><input type="submit" class="input button blue" name="submit" onclick="submitbytgl()" value="Filter" /></td>
                <td style="text-align:right">
                    <a href="<?php echo base_url().'index.php/export/lappelanggaran_pertgl/'.$this->uri->segment(3).'/'.$this->uri->segment(4);?>" title="Print Ledger" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
                </td>
            </tr>
        </table>
        </form>
		<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
        <table width="100%" class="tables">
            <tr>
                <th width="1%">No.</th>
				<th width="8%">Tanggal</th>
				<th width="5%">No.Induk</th>
                <th width="15%">Nama</th>
                <th width="8%">Kelas</th>
				<th width="28%">Pelanggaran</th>
				<th width="10%">Kejadian</th>
				<th width="22%">Hukuman</th>
				<th width="3%">Poin</th>
            </tr>
            <?php
                $seq        = 1;
                $jmhdatapeserta = 0;
                foreach($pelanggaran_siswa->result() as $row)
                {
                    $class = ($seq%2==0) ? ' class="bg" ' : '';
            ?>
            <tr<?php echo $class; ?>>
                <td align="center"><?php echo $seq; ?></td>
                <?php //$tgl = ($row->tgl == '' || $row->tgl == '0'|| $row->tgl == 'NULL') ? explode(' ','0 0 0') : explode(' ',$row->tgl);
                //$a=($tgl[0] == '0') ? ' ' : $tgl[0];
                //$b=($tgl[1] == '0') ? ' ' : $tgl[1];
                //$c=($tgl[2] == '0') ? ' ' : $tgl[2];
                echo '<td align="center">'.$row->tglpanjang.'</td>';?>
                <td align="center"><?php echo $row->nis;?></td>
                <td><?php echo $row->nama_lengkap; ?></td>
                <td><?php echo $row->kelas; ?></td>
                <td><?php echo $row->nm_pelanggaran; ?></td>
				<td><?php echo $row->kejadian; ?></td>
				<td><?php echo $row->hukuman; ?></td>
				<td align="center"><?php echo $row->point; ?></td>
            </tr>
            <?php $seq++; }?>
		</table>
        </div>
        <?php //echo $this->pagination->create_links(); ?> &nbsp;&nbsp;&nbsp;
    </div> <!-- /content -->
<hr class="noscreen" />
<!-- Footer -->
 <?php $this->load->view('page_footer'); ?>
</div> <!-- /main -->
<script type="text/javascript">
    function submitbytgl()
    {
        var tgldr = $('#tgldari').val();
        var tglsmp = $('#tglsampai').val();
        var iddaftar = $('#frmcari').attr('action');
        if(tgldr=='' || tglsmp=='')
        {
            alert("Tanggal Harus di Isi");
        }
        else
        {
            $('#frmcari').attr('action',iddaftar+"/"+tgldr+"/"+tglsmp);
            $('#frmcari').submit();
        }
        //alert(iddaftar);
    }
</script>
</body>
</html>