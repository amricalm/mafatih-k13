<?php $this->load->view('page_head');?>
<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">
		<h1>USER</h1>
		<div id="tab01">
                <?php echo form_open('sekuriti/user_exec/db_add','onsubmit = "return validasi()"'); ?>
    			<fieldset>
    				<legend>Tambah User</legend>
    				<table class="nostyle" style="width:100%">
    					<tr>
    						<td style="width:200px;">Nama Login</td>
    						<td><input type="text" size="20" name="nama_login" id="nama_login" class="input-text" /></td>
    					</tr>
                        <tr>
    						<td>Relasi Pegawai</td>
                            <td>
                                <select name="nama_lengkap" id="nama_lengkap">
                                    <option value="0"></option>
                                    <?php
                                        foreach($pegawai->result() as $rowpegawai)
                                        {
                                            echo '<option value="'.$rowpegawai->nama_lengkap.'">'.$rowpegawai->nama_lengkap.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
    						<td>Group</td>
    						<td><?php	
                                    $option = array('0'=>'&nbsp;');
                                    foreach($grup->result() as $row)
                                    {	
                                        $option = $option + array($row->kd_group=>$row->nm_group);
                                    }
                                    echo form_dropdown('kode_group',$option, '0','class="input-text" id="kode_group"');
								?>
							</td>
    					</tr>
    					<tr>
    						<td style="width:200px;">Password</td>
    						<td><input type="text" size="20" name="password" id="password" class="input-text" /></td>
    					</tr>
    					<tr>
    						<td style="width:200px;">Konfirmasi Password</td>
    						<td><input type="text" size="20" name="password1" id="password1" class="input-text" /></td>
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