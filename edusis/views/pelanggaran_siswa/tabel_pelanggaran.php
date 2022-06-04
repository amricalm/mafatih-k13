<?php $this->load->view('page_head');?>
<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>PELANGGARAN SISWA </h1>
			
                <table style="border:1 ;width:100%" >
                <tr>
                    <td style="border:none;text-align:left;width:250px">							
                    </td>
                    <td style="border:none;text-align:left">
                    </td>
                    <td style="border:none;text-align:right" rowspan="2">
                        <?php //if ($this->session->userdata('user_id')=="Admin") {?>
                        <a href="" id="tombol_add" onclick="return add('<?php echo base_url(); ?>index.php/pelanggaran_siswa/pelanggaran_form/db_add');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/tambah.png" /></a>
                        <a href="" id="tombol_edit" onclick="return edit('<?php echo base_url(); ?>index.php/pelanggaran_siswa/pelanggaran_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/edit.png" /></a>
                        <a href="" id="tombol_del" onclick="return del('<?php echo base_url(); ?>index.php/pelanggaran_siswa/pelanggaran_form/db_del');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/hapus.png" /></a>
                        <?php //}?>
                    </td>
                </tr>
                </table>
        <div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
               <table width="100%" class="tables">
                <tr>
                    <th width="1%">#</th>
                    <th width="8%">Tanggal</th>
                    <th width="5%">NIS</th>
                    <th width="16%">Nama Siswa</th>
                    <th width="30%">Pelanggaran Siswa</th>
                    <th width="8%">Kejadian</th>
                    <th width="27%">Hukuman</th>
                    <th width="5%">point</th>
                </tr>
                    <?php 
                    $seq = 1;
                    foreach($get_pelanggaran_siswa->result() as $row)
                    {
                        $bg = ($seq%2==0) ? ' class="bg" ' : '';
                        echo '<tr'.$bg.'>';
                        echo '<td><input type="checkbox" id="'.$row->kd_pelanggaran_siswa.'" name="kode[]" /></td>';
                        
                        //$tgl = ($row->tgl == '' || $row->tgl == '0'|| $row->tgl == 'NULL') ? explode(' ','0 0 0') : explode(' ',$row->tgl);
                        //$a=($tgl[0] == '0') ? ' ' : $tgl[0];
                        //$b=($tgl[1] == '0') ? ' ' : $tgl[1];
                        //$c=($tgl[2] == '0') ? ' ' : $tgl[2];
                        echo '<td align="center">'.$row->tglpanjang.'</td>';
                        echo '<td align="center">'.$row->nis.'</td>';
                        echo '<td>'.$row->nama_lengkap.'</td>';
                        echo '<td>'.$row->nm_pelanggaran.'</td>';
                        echo '<td>'.$row->kejadian.'</td>';
                        echo '<td>'.$row->hukuman.'</td>';
                        echo '<td align="center">'.$row->point.'</td>';
                        echo '</tr>';
                        $seq++;
                    } 
                    ?>
                </table>
            </div>
            <?php //echo $this->pagination->create_links(); ?> &nbsp;&nbsp;&nbsp;
            </div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
<script type="text/javascript">
    function submitbypelanggaran_siswa()
    {
        var varkelas = $('#pelanggaran_siswa').val();
        var iddaftar = $('#frmpelanggaran_siswa').attr('action');
        window.location = iddaftar+"/"+varkelas;
        //alert(iddaftar);
    }
</script>
</body>
    <script type="text/javascript">
        function daftar_siswa()
        {
            window.open("<?php echo base_url(); ?>index.php/daftar_siswa/daftar","","width=600,height=560")
        }
        
        function daftar_pelanggaran()
        {
            window.open("<?php echo base_url(); ?>index.php/pelanggaran/daftar_pelanggaran","","width=600,height=560")
        }
    </script>
</html>