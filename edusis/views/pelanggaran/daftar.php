<?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>DETAIL PELANGGARAN</h1>

                <?php echo form_open('pelanggaran/daftar',array('name'=>'frmdaftar','id'=>'frmdaftar')) ?>
                <table style="border:1 ;width:100%">
                    <tr>
                        <td width="10%">Jenis Pelanggaran</td><td width="1%">:</td>
                        <td> 
                        <select name="kd_tpelanggaran" id="pelanggaran" onchange="submitbypelanggaran()">
                		<?php
                			echo '<option value="0" class="input-text" ></option>';
                			if($kd_tpelanggaran->num_rows() !=0)
                			{
                				foreach($kd_tpelanggaran->result () as $rowkd_tpelanggaran )
                				{
                					$selected		= '';
                					if($pilihkd_tpelanggaran == trim($rowkd_tpelanggaran->kd_tpelanggaran))
                					{
                						$selected	= 'selected="selected"';
                					}
                				echo '<option value="'.trim($rowkd_tpelanggaran->kd_tpelanggaran).'" '.$selected.'>'.$rowkd_tpelanggaran->nm_tpelanggaran.'</option>';
                				}
                			}
                		?>
                		</select>
                        </td>
                        <td style="border:none;text-align:right" rowspan="2">
                            <?php //if ($this->session->userdata('user_id')=="Admin") {?>
                            <a href="" id="tombol_add" onclick="return add('<?php echo base_url(); ?>index.php/pelanggaran/pelanggaran_form/db_add');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/tambah.png" /></a>
                            <a href="" id="tombol_edit" onclick="return edit('<?php echo base_url(); ?>index.php/pelanggaran/pelanggaran_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/edit.png" /></a>
                            <a href="" id="tombol_del" onclick="return del('<?php echo base_url(); ?>index.php/pelanggaran/pelanggaran_form/db_del');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/hapus.png" /></a>
                            <?php //}?>
                        </td>
                    </tr>
                </table>
                </form>
			<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    			<table width="100%" class="tables">
    				<tr>
    				    <th width="1%">#</th>
    				    <th width="60%" align="left">Pelanggaran</th>
    				    <th width="8%" align="left">Poin</th>
    				    <th width="30%" align="left">Keterangan</th>
    				</tr>
                    <?php 
                    $seq = 1;
                    foreach($pelanggaran->result() as $row)
                    {
                        $bg = ($seq%2==0) ? ' class="bg" ' : '';
                        echo '<tr'.$bg.'>';
                        echo '<td><input type="checkbox" id="'.$row->kd_pelanggaran.'" name="kode[]" /></td>';
                        echo '<td>'.$row->nm_pelanggaran.'</td>';
                        echo '<td align="center">'.$row->point.'</td>';
                        echo '<td>'.$row->ket.'</td>';
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

</div> <!-- /main -->
<script type="text/javascript">
    function submitbypelanggaran()
    {
        var varpelanggaran   = $('#pelanggaran').val();
        var iddaftar         = $('#frmdaftar').attr('action');
        window.location      = iddaftar+"/"+varpelanggaran;
        //alert(iddaftar);
    }
</script>
</body>
</html>