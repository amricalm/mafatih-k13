 <?php $this->load->view('page_head');?>
<body>
<div id="main">
    <?php $this->load->view('page_menu');?>
		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>DAFTAR GURU</h1>

                <table style="border:none;width:100%">
                    <tr>
                        <td width="40px" style="border:none;text-align:right"><!--Pencarian--></td>
                        <td style="border:none;width:10%;text-align:left">
                        </td>
                        <td rowspan="2" style="border:none;text-align:left"><!--<a href="javascript:formfilter()" class="large button green">Pencarian</a>--></td>
                        <td rowspan="2" style="border:none;text-align:right">
                            <a href="<?php echo base_url().'index.php/guru/daftarprint_pdf/'.$this->uri->segment(3); ?>" title="Print Daftar Guru" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
                            <a href="" id="tombol_add" title="Tambah Guru " onclick="return add('<?php echo base_url(); ?>index.php/guru/guru_form/db_add');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//tambah.png" /></a>
                            <a href="" id="tombol_edit" title="Edit Siswa " onclick="return edit('<?php echo base_url(); ?>index.php/guru/guru_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//edit.png" /></a>
                            <a href="" id="tombol_del" title="Hapus Siswa " onclick="return del('<?php echo base_url(); ?>index.php/guru/guru_form/db_del');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//hapus.png" /></a>
                            <br /><br />Jumlah Guru : <?php echo $jmhguru; ?> Orang.
                        </td>
                    </tr>
                </table>
			<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    			<table class="tables" width="100%" >
    				<tr>
    				    <th width="1%">#</th>
    				    <th style="width:5%; align:ceter;">NIP</th>
						<th width="20%">Nama Lengkap</th>
    				    <th width="14%">Tempat Lahir</th>
    				    <th width="10%">Tanggal Lahir</th>
    				    <th width="40%">Alamat</th>
    				    <th width="10%">Telp</th>
    				</tr>
                    <?php
                    $seq = 1; 
                    foreach($guru->result() as $row)
                    {
                        $bg = ($seq%2==0) ? ' class="bg" ' : '';
                        echo '<tr'.$bg.'>';
                        echo '<td><input type="checkbox" id="'.$row->nip.'" name="kode[]" /></td>';
                        echo '<td align="center">'.$row->nip.'</td>';
                        echo '<td>'.$row->nama_lengkap.'</td>';
                        echo '<td>'.$row->tp_lahir.'</td>';
                        
                        echo '<td>'.  /*adn_tgl_to_str($row->tgl_lahir)*/$row->tglpanjang .'</td>';
                        
                        
                        echo '<td>'.$row->alamat.'</td>';
                        echo '<td>'.$row->hp.'</td>';
                        $seq++;
                        echo '</tr>';
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
</body>
</html>