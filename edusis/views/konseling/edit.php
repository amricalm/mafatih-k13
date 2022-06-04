 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>KONSELING SISWA</h1>
                <form action="<?php echo base_url() ?>index.php/konseling/konseling_exec/db_edit" method="POST">
                <input type="hidden" name="kd_konseling" value="<?php echo $data->row()->kd_konseling?>"/>
                <input type="hidden" name="nis" value="<?php echo $data->row()->nis ?>"/>
    			<fieldset>
                <legend>Edit Konseling Siswa</legend>
                <table class="nostyle" style="font-size: small;">
					<tr>
						<td style="width:150px;">NIS</td>
                        <td style="width:5px;">:</td>
                        <td><input type="text" size="40" name="nis" id="nis" class="input-text" disabled="disabled" value="<?php echo $data->row()->nis ?>"/></td>
					</tr>
                    <tr>
						<td class="va-top">Nama Siswa</td>
                        <td>:</td>
                        <td><input type="text" size="40" name="nama_lengkap" id="nama_lengkap" class="input-text" disabled="disabled" value="<?php echo $data->row()->nama_lengkap ?>"/></td>
					</tr>
					<tr>
						<td>Kelas</td>
                        <td>:</td>
						<td><input type="text" size="40" name="kelas" id="kelas" class="input-text" disabled="disabled" value="<?php echo $data->row()->kelas ?>"/></td>
					</tr>
                    <tr>
						<td class="va-top">Tanggal</td>
                        <td>:</td>
                        <td><input type="text" size="40" name="tgl" id="tgl" class="tgl input-text" value="<?php echo $data->row()->tgl ?>"/></td>
					</tr>
                    <tr>
						<td class="va-top">Konseling Siswa</td>
                        <td class="va-top">:</td>
						<td><textarea style="width:400px; height:70px;" name="masalah" id="masalah" class="input-text" ><?php echo $data->row()->masalah ?></textarea></td>
					</tr>
                    <tr>
						<td class="va-top">Solusi Guru BK</td>
                        <td class="va-top">:</td>
						<td><textarea style="width:400px; height:70px;" name="solusi" id="solusi" class="input-text" ><?php echo $data->row()->solusi ?></textarea></td>
					</tr> 
                    <tr>
                        <td></td><td></td>
                		<td class="t-left">
                            <input type="submit" name="" class="input-submit" value="Ubah" />
                            <input type="button" name="" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/konseling/daftar' ?>';" />
                        </td>
            	   </tr>
                </table>
                </fieldset>
            </form>
		</div>
	</div> <!-- /cols -->
	<hr class="noscreen" />
	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
</div> <!-- /main -->
</body>
</html>