<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>EKSTRAKURIKULER</h1>
	
        <form action="<?php echo base_url() ?>index.php/ekstrakurikuler/ekstrakurikuler_exec/db_add" method="POST" name="frmekstrakurikuler" id="frmekstrakurikuler">
        <table style="border:1 ;width:100%">
            <tr>
            <td style="border:none;text-align:right">
                <!--<a href="" id="tombol_excel" onclick="return excel('<?php //echo base_url(); ?>index.php/export/data_siswa/');" class="small button blue"><img src="<?php //echo base_url(); ?>edusis_asset/edusisimg/excel.png" /></a>-->
                <a href="" id="tombol_add" onclick="return add('<?php echo base_url(); ?>index.php/ekstrakurikuler/ekstrakurikuler_form/db_add');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/tambah.png" /></a>
                <a href="" id="tombol_edit" onclick="return edit('<?php echo base_url(); ?>index.php/ekstrakurikuler/ekstrakurikuler_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/edit.png" /></a>
                <a href="" id="tombol_del" onclick="return del('<?php echo base_url(); ?>index.php/ekstrakurikuler/ekstrakurikuler_form/db_del');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/hapus.png" /></a>
            </td>
            </tr>
        </table>
        </form>
	<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
		<table width="100%" class="tables" >
			<tr>
			    <th width="1%">#</th>
			    <th width="10%">Kode</th>
				<th width="89%">Nama Ekstrakurikuler</th>
			</tr>
            <?php 
            $seq = 1;
            foreach($ekstrakurikuler->result() as $row)
            {
                $bg = ($seq%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td style="align:center;"><input type="checkbox" id="'.$row->kd_eskul.'" name="kode[]" /></td>';
                echo '<td>'.$row->kd_eskul.'</td>';
                echo '<td>&nbsp;&nbsp;'.$row->nm_eskul.'</td>';
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
</body>
</html>