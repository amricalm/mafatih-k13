 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>Siswa - Pencarian</h1>

			<div id="tab01">
                <form action="<?php base_url().'index.php/siswa/pencarian' ?>" name="pencarianfrm" id="pencarianfrm" method="POST">
                <table style="width:100%">
                    <tr>
                        <th style="">
                            Pencarian : <input type="text" class="input-text" name="cari" id="cari" style="padding: 8px;" value="<?php echo $txtcarisiswa; ?>"/><input type="submit" value="Cari" class="input-submit" name="submit" />							
                        </th>
                    </tr>
                </table>
                </form>
                <?php if($txtcarisiswa!='') { ?>
    			<table width="100%" >
    				<tr>
    				    <th width="20%">NIS</th>
						<th width="20%">Nama Lengkap</th>
    				    <th width="20%">Tempat lahir</th>
    				    <th width="20%">Tanggal lahir</th>
    				    <th width="20%">Nama Ayah</th>
    				</tr>
                    <?php 
                    $seq        = 1;
                    foreach($siswa->result() as $row)
                    {
                        $bg = ($seq%2==0) ? ' class="bg" ' : '';
                        echo '<tr'.$bg.'>';
                        echo '<td><a href="'.base_url().'index.php/siswa/profile/'.$row->nis.'">'.$row->nis.'</a></td>';
                        echo '<td>'.$row->nama_lengkap.'</td>';
                        echo '<td>'.$row->tp_lahir.'</td>';
                        echo '<td>'.adn_ctgl($row->tgl_lahir).'</td>';
                        echo '<td>'.$row->ayah_nama.'</td>';
                        echo '</tr>';
                        $seq++;
                    }
                    ?>
    			</table>
                <?php } ?>
			</div>
            
            <?php if($txtcarisiswa!='') {echo $this->pagination->create_links();} ?> &nbsp;&nbsp;&nbsp;
            </div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
</body>
</html>