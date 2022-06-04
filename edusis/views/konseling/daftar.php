<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
	<h1>KONSELING SISWA</h1>
	
    <table style="border:none ;width:100%;font-size: 14px;">
        <tr>
            <td style="border:none;text-align:right">
                <a href="" id="tombol_add" onclick="return add('<?php echo base_url(); ?>index.php/konseling/konseling_form/db_add');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//tambah.png" /></a>
                <a href="" id="tombol_edit" onclick="return edit('<?php echo base_url(); ?>index.php/konseling/konseling_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//edit.png" /></a>
                <a href="" id="tombol_del" onclick="return del('<?php echo base_url(); ?>index.php/konseling/konseling_form/db_del');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//hapus.png" /></a>
            </td>
        </tr>
    </table>
<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    <table width="100%" class="tables" >
			<tr>
			    <th width="2%">#</th>
                <th width="8%">NIS</th>
				<th width="20%">Nama Siswa</th>
				<th width="8%">Kelas</th>
			    <th width="10%">Tanggal</th>
				<th width="26%">Konseling Siswa</th>
			    <th width="26%">Solusi Guru BK</th>
			</tr>
            <?php 
            $seq = 1;
            foreach($konseling->result() as $row)
            {
                $bg = ($seq%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td><input type="checkbox" id="'.$row->kd_konseling.'" name="kode[]" /></td>';
                echo '<td align="center">'.$row->nis.'</td>';
                echo '<td>'.$row->nama_lengkap.'</td>';
                echo '<td align="center">'.$row->kelas.'</td>';
                //$tgl = ($row->tgl == '' || $row->tgl == '0'|| $row->tgl == 'NULL') ? explode(' ','0 0 0') : explode(' ',$row->tgl);
                //$a=($tgl[0] == '0') ? ' ' : $tgl[0];
                //$b=($tgl[1] == '0') ? ' ' : $tgl[1];
                //$c=($tgl[2] == '0') ? ' ' : $tgl[2];
                echo '<td align="center">'.$row->tglpanjang.'</td>';
                echo '<td>'.$row->masalah.'</td>';
                echo '<td>'.$row->solusi.'</td>';
                echo '</tr>';
                $seq++;
            }
            ?>
		</table>
	</div>
<?php echo $this->pagination->create_links(); ?> &nbsp;&nbsp;&nbsp;
</div> <!-- /content -->
	</div> <!-- /cols -->
	<hr class="noscreen" />
	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
<script type="text/javascript">
    function submitbykonseling()
    {
        var varkelas = $('#konseling').val();
        var iddaftar = $('#frmdaftar').attr('action');
        window.location = iddaftar+"/"+varkelas;
    }
</script>
</body>
<script type="text/javascript">
		function siswapopup()
		{
			window.open("<?php echo base_url(); ?>index.php/siswapopup/daftar","daftarsiswa","width=600,height=560");
		}
	</script>
</html>