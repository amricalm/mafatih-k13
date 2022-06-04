<?php $this->load->view('page_head');?>
<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">
		<h1>GROUP USER</h1>
		<div id="tab01">
                <?php echo form_open('sekuriti/group_exec/DB_EDIT','onsubmit = "return validasi()"'); ?>
                <?php echo form_hidden('kd_group',$data->row()->kd_group); ?>
    			<fieldset>
                    <legend>Edit Group User</legend>
                    <table class="nostyle" style="width:100%">
                        <tr>
                            <td style="width: 150px;">Nama Group</td>
                            <td>: <input type="text" size="50" name="nm_group" id="nm_group" value="<?php echo $data->row()->nm_group;?>" class="input-text" /></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>: <input type="text" name="ket" id="ket" class="input-text" value="<?php echo $data->row()->ket;?>" /></td>
                        </tr>
                        <tr>
                            <td>Sys Admin</td>
                            <?php $checked        = ($data->row()->sys_admin==1) ? 'checked="checked"' : ''; ?>
                            <td>: <?php echo form_checkbox('sys_admin',1,$data->row()->sys_admin,'id="sys_admin"'); ?></td>
                        </tr>
                        <tr>
                            <td>Edusis Keuangan</td>
                            <?php $checkeda        = ($data->row()->sys_keu==1) ? 'checked="checked"' : ''; ?>
                            <td>: <?php echo form_checkbox('sys_keu',1,$data->row()->sys_keu,'id="sys_keu"'); ?><!--<input type="checkbox" id="sys_keu" name="sys_keu" value="<?php echo $data->row()->sys_keu;?>" <?php echo $checkeda;?>/>--></td>
                        </tr>
                        <tr>
                            <td>Accounting</td>
                            <?php $checkedi        = ($data->row()->sys_acounting==1) ? 'checked="checked"' : ''; ?>
                            <td>: <?php echo form_checkbox('sys_acounting',1,$data->row()->sys_acounting,'id="sys_acounting"'); ?><!--<input type="checkbox" id="sys_acounting" name="sys_acounting" value="<?php echo $data->row()->sys_acounting;?>" <?php echo $checkedi;?>/>--></td>
                        </tr>
                        <tr>
                            <td>Kesiswaan</td>
                            <?php $checkedo        = ($data->row()->sys_siswa==1) ? 'checked="checked"' : ''; ?>
                            <td>: <?php echo form_checkbox('sys_siswa',1,$data->row()->sys_siswa,'id="sys_siswa"'); ?><!--<input type="checkbox" id="sys_siswa" name="sys_siswa" value="<?php echo $data->row()->sys_siswa;?>" <?php echo $checkedo;?>/>--></td>
                        </tr>
                    </table>
		        </fieldset>
                        <input type="submit" class="input-submit" value="Edit" />
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
        if(document.getElementById('nm_group').value == '')
        {
            status  += 'Nama Group harus diisi! \r\n';
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