<?php $this->load->view('page_head');?>
<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">
		<h1>GROUP USER</h1>
		<div id="tab01">
                <?php echo form_open('sekuriti/user_exec/db_edit','onsubmit = "return validasi()"'); ?>
                <?php echo form_hidden('nama_login',$data->row()->nama_login); ?>
    				<fieldset>
    				<legend>Ubah User</legend>
    				<table class="nostyle" style="width:100%">
    					<tr>
    						<td style="width:200px;">Nama Login</td>
                            <td><input type="text" size="20" name="nama_login" id="nama_login" value="<?php echo $data->row()->nama_login?>" class="input-text" disabled="disabled" /></td>
    					</tr>
                        <tr>
    						<td>Relasi Pegawai</td>
                            <td>
                                <select name="nama_lengkap" id="nama_lengkap">
                                    <option value="0"></option>
                                    <?php
                                        foreach($pegawai->result() as $rowpegawai)
                                        {
                                            $pilih   = (trim($data->row()->nama_lengkap)==trim($rowpegawai->nama_lengkap)) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$rowpegawai->nama_lengkap.'"'.$pilih.'>'.$rowpegawai->nama_lengkap.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td>Group</td>
    						<td>
                                <select name="kode_group" id="kode_group">
                                    <option value="0"></option>
                                    <?php
                                        foreach($grup->result() as $rowgroup)
                                        {
                                            $pilih  = (trim($data->row()->kode_group)==trim($rowgroup->kd_group)) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$rowgroup->kd_group.'"'.$pilih.'>'.$rowgroup->nm_group.'</option>';
                                        }
                                    ?>
                                </select>
							</td>
    					</tr>
    					<tr>
    						<td style="width:200px;">Password</td>
    						<td><input type="text" size="20" name="password" id="password" class="input-text" value="<?php echo $data->row()->password?>" /></td>
    					</tr>
    					<tr>
    						<td style="width:200px;">Konfirmasi Password</td>
    						<td><input type="text" size="20" name="password1" id="password1" class="input-text" value="<?php echo $data->row()->password?>" /></td>
    					</tr>
                        </table>
		              </fieldset>
                        <input type="submit" class="input-submit" value="Submit" />
                        <input type="reset" class="input-submit" value="Reset" />
                <?php echo form_close(); ?>
			</div>
		</div>
	</div> <!-- /cols -->
	<hr class="noscreen" />
	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
</div> <!-- /main -->
<script type="text/javascript">
    function validasi()
    {
        var status = '';
        if(document.getElementById('nama_login').value == '')
        {
            status  += 'Nama Login harus diisi! \r\n';
        }
        if(document.getElementById('password').value=='')
        {
            status += 'Password harus diisi! \r\n'; 
        }
        else if(document.getElementById('password').value != document.getElementById('password1').value)
        {
            status += 'Password harus diisi sama! \r\n';
        }
        if(status!='')
        {
            alert(status);
            return false;
        }
        else
        {
            return true;
        }
    }
</script>
</body>
</html>