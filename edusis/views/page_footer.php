	<div id="footer" class="box">

		<p class="f-left">&copy; 2012 <a href="#">Andhana</a>, All Rights Reserved &reg;</p>

		<p class="f-right"><!--Templates by <a href="http://www.adminizio.com/">Adminizio</a>--></p>

	</div>
    <div id="GantiSemester" style="display:none;">
		<p>
			<table class="nostyle" style="font-size: small;">
				<tr>
					<td>Select Semester</td>
					<td>:</td>
					<td><?php echo form_dropdown('sesi_semester_baru',$this->app_model->get_semester(),$this->session->userdata('kd_semester'),'style="width:200px" id="sesi_semester_baru"') ?></td>
				</tr>
			</table>
		</p>
    </div>
    <div id="GantiSub" style="display:none;">
		<p>
			<table class="nostyle" style="font-size: small;">
				<tr>
					<td>Penilaian</td>
					<td>:</td>
					<td><?php echo form_dropdown('sesi_sub_baru',$this->app_model->get_sub(),$this->session->userdata('sub_pnl'),'style="width:200px" id="sesi_sub_baru"') ?></td>
				</tr>
			</table>
		</p>
    </div>        

    <div id="GantiSekolah" style="display:none;">
		<p>
			<table class="nostyle" style="font-size: small;">
				<tr>
					<td>Select School</td>
					<td>:</td>
					<td><?php echo form_dropdown('sesi_sekolah_baru',$this->app_model->get_sekolahh(),$this->session->userdata('kd_sekolah'),'style="width:200px" id="sesi_sekolah_baru"') ?></td>
				</tr>
			</table>
		</p>
    </div>        
    
    <div id="GantiPassword" style="display:none;">
        <p>
            <table class="nostyle" style="font-size: small;">
                <tr>
                    <td>User Id</td>
                    <td>:</td>
                    <td><input type="text" style="width: 200px;" name="user_id" id="user_id" disabled="disabled" value="<?php echo $this->session->userdata('user_id'); ?>" /></td>
                </tr>
                <tr>
                    <td>New password</td>
                    <td>:</td>
                    <td><input type="text" style="width: 200px;" name="pwd_baru" id="pwd_baru" /></td>
                </tr>
                <tr>
                    <td>Confirm New Password</td>
                    <td>:</td>
                    <td><input type="text" style="width: 200px;" name="pwd_baru1" id="pwd_baru1" /></td>
                </tr>
            </table>
        </p>
    </div>

    <div id="GantiThAjar" style="display:none;">
        <p>
            <table class="nostyle" style="font-size: small;">
                <tr>
                    <td>Select Academic Year</td>
                    <td>:</td>
                    <td><?php echo form_dropdown('sesi_th_ajar_baru',$this->app_model->get_th_ajar(),$this->session->userdata('th_ajar'),'style="width:200px" id="sesi_th_ajar_baru"') ?></td>
                </tr>
            </table>
        </p>
    </div>
    
<?php echo form_hidden('base_url',base_url()) ?>
<?php echo form_hidden('sesi_th_ajar',$this->session->userdata('th_ajar')) ?>
<?php echo form_hidden('sesi_semester',$this->session->userdata('kd_semester')) ?>
<?php echo form_hidden('sesi_kd_sekolah',$this->session->userdata('kd_sekolah')) ?>
<script type="text/javascript">
    winWidth = 500; 
    winheight = 350;
    function changeSemester()
    {
        var myurl   = $('#base_url').val();
        var semester= $('#sesi_semester').val();
        var urlpwd  = myurl+'index.php/th_ajar/ganti_semester/'+semester;
        var test    = $('#GantiSemester').dialog({
        autoOpen: false,
        width: 400,
        title: "Change Semester",
        modal: true,
        resizable: false,
        buttons: {
            "Yes": function() {
                var semester_baru = String($('#sesi_semester_baru').val());
                if(semester_baru!='')
                {
                    $.ajax({
                        type: "POST",
                        url: urlpwd,
                        data : "semester_baru="+semester_baru,
                        success: function(msg) 
                        {
                            if(msg=='#')
                            {
                                alert('Successful replacement of Semester Session!');
                                window.location.reload();
                            }
                            else
                            {
                                alert('Failed replacement of Semester Session!');
                            }
                        }
                    });
                    $(this).dialog("close");
                }
                else
                {
                    alert('Semester not be empty!');
                    $('#sesi_semester_baru').focus();
                }
                return false;
            },
            "No": function() {
                $(this).dialog("close");
                return false;
            }
        }
        });
        test.dialog("open");
    }
    function changeSub()
    {
        var myurl   = $('#base_url').val();
        var sub     = $('#sesi_sub').val();
        var urlpwd  = myurl+'index.php/th_ajar/ganti_sub/'+sub;
        var test    = $('#GantiSub').dialog({
        autoOpen: false,
        width: 400,
        title: "Change Sub",
        modal: true,
        resizable: false,
        buttons: {
            "Yes": function() {
                var sub_baru = String($('#sesi_sub_baru').val());
                if(sub_baru!='')
                {
                    $.ajax({
                        type: "POST",
                        url: urlpwd,
                        data : "sub_baru="+sub_baru,
                        success: function(msg) 
                        {
                            if(msg=='#')
                            {
                                alert('Successful replacement of Sub Session!');
                                window.location.reload();
                            }
                            else
                            {
                                alert('Failed replacement of Sub Session!');
                            }
                        }
                    });
                    $(this).dialog("close");
                }
                else
                {
                    alert('Sub not be empty!');
                    $('#sesi_sub_baru').focus();
                }
                return false;
            },
            "No": function() {
                $(this).dialog("close");
                return false;
            }
        }
        });
        test.dialog("open");
    }
    function changeSekolah()
    {
        var myurl   = $('#base_url').val();
        var sekolah = $('#sesi_sekolah').val();
        var urlpwd  = myurl+'index.php/th_ajar/ganti_sekolah/'+sekolah;
        var test    = $('#GantiSekolah').dialog({
        autoOpen: false,
        width: 400,
        title: "Change Sekolah",
        modal: true,
        resizable: false,
        buttons: {
            "Yes": function() {
                var sekolah_baru = String($('#sesi_sekolah_baru').val());
                if(sekolah_baru!='')
                {
                    $.ajax({
                        type: "POST",
                        url: urlpwd,
                        data : "sekolah_baru="+sekolah_baru,
                        success: function(msg) 
                        {
                            if(msg=='#')
                            {
                                alert('Successful replacement of School Session!');
                                window.location.reload();
                            }
                            else
                            {
                                alert('Failed replacement of School Session!');
                            }
                        }
                    });
                    $(this).dialog("close");
                }
                else
                {
                    alert('Instance not be empty!');
                    $('#sesi_sekolah_baru').focus();
                }
                return false;
            },
            "No": function() {
                $(this).dialog("close");
                return false;
            }
        }
        });
        test.dialog("open");
    }
    function changeThAjar()
    {
        var myurl   = $('#base_url').val();
        var thajar  = $('#sesi_th_ajar').val();
        var urlpwd  = myurl+'index.php/th_ajar/ganti_sesi/'+thajar;
        var test    = $('#GantiThAjar').dialog({
        autoOpen: false,
        width: 400,
        title: "Change Session Academic Year",
        modal: true,
        resizable: false,
        buttons: {
            "Yes": function() {
                var th_ajar_baru = String($('#sesi_th_ajar_baru').val());
                if(th_ajar_baru!='')
                {
                    $.ajax({
                        type: "POST",
                        url: urlpwd,
                        data : "th_ajar_baru="+th_ajar_baru,
                        success: function(msg) 
                        {
                            if(msg=='#')
                            {
                                alert('Replacement Session Academic Year successful!');
                                window.location.reload();
                            }
                            else
                            {
                                alert('Replacement Session Academic Year failed!');
                            }
                        }
                    });
                    $(this).dialog("close");
                }
                else
                {
                    alert('Academic Year can not be empty!');
                    $('#sesi_th_ajar_baru').focus();
                }
                return false;
            },
            "No": function() {
                $(this).dialog("close");
                return false;
            }
        }
        });
        test.dialog("open");
    }
    function changePassword()
    {
        var user_id = $('#user_id').val();
        var urlpwd  = '<?php echo base_url() ?>index.php/sekuriti/ganti_password/'+user_id;
        var test = $('#GantiPassword').dialog({
        autoOpen: false,
        width: 400,
        title: "Ganti Password",
        modal: true,
        resizable: false,
        buttons: {
            "Yes": function() {
                var pwdbaru = String($('#pwd_baru').val());
                var pwdbaru1= String($('#pwd_baru1').val());
                if(pwdbaru!=''&&pwdbaru1!='')
                {
                    if(pwdbaru==pwdbaru1)
                    {
                        $.ajax({
                            type: "POST",
                            url: urlpwd,
                            data : "pwdbaru="+pwdbaru,
                            success: function(msg) 
                            {
                                //alert(msg);
                                if(msg=='#')
                                {
                                    alert('Password successfully changed.');
                                }
                                else
                                {
                                    alert('Password is not successfully replaced. Please try again!');
                                }
                                $('#pwd_baru').val('');
                                $('#pwd_baru1').val('');
                            }
                        });
                        $(this).dialog("close");
                    }
                    else
                    {
                        alert('Password is not the same!');
                        $('#pwd_baru1').val('');
                        $('#pwd_baru1').focus();
                    }
                }
                else
                {
                    alert('Password can not empty!');
                    $('#pwd_baru').focus();
                }
                return false;
            },
            "No": function() {
                $(this).dialog("close");
                return false;
            }
        }
        });
        test.dialog("open");
    }
</script>