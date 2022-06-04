<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>KONDISI KESEHATAN SISWA</h1>
		<div id="tab01">
        <table border="1" width="100%">
        <tr>
            <td valign="top" width="40%">
            <form action="<?php echo base_url().'index.php/kesehatan_siswa/daftar';?>" name="frmfilter" id="frmfilter" method="POST">
                <table border="1" width="100%">
                <tr>
                    <td style="width:150px">Pilih Kelas</td>
                    <td></td>
                    <td style="width:20%"> 
                    <select name="kelas" id="skelas" onchange="submitbykelas()">
					<?php
						echo '<option value="" class="input-text"></option>';
						$arraykelas = array();
						if($kelas->num_rows() !=0)
						{
							foreach($kelas->result () as $rowkelas )
							{
								$selected		='';
								if($pilihkelas == trim($rowkelas->kelas))
								{
									$selected	= 'selected="selected"';
								}
							echo '<option value="'.trim($rowkelas->kelas).'" class="input-text" '.$selected.'>'.$rowkelas->kelas.'</option>';
							}
						}
					?>
    				</select>
                    </td>
                </tr>
                <tr>
                    <td rowspan="3" colspan="3">
                    <table style="width:100%" class="tables">
                    <tr>
                        <th width="10%" align="center">#</th>
                        <th width="20%">No.Induk</th>
                        <th width="70%">Nama Siswa</th>
                        <?php
                            $seq = 1;
                            foreach($kelas_siswa->result() as $row)
                            {
                                $bg = ($seq%2==0) ? ' class="bg" ' : '';
                                echo '<tr'.$bg.'>';
                                echo '<td align="center">'.$seq.'</td>';
                                echo '<td align="center">'.$row->nis.'</td>';
                                echo '<td><a href="javascript:ambil('."'".trim($row->kelas)."'".','."'".trim($row->nis)."'".','."'".trim($row->nama_lengkap)."'".')">'.$row->nama_lengkap.'</a></td>';
                                echo '</tr>';
                                $seq++;
                            }
                        ?>
                    </tr>
                    </table>
                    </td>
                </tr>
                </table>
            </form>
            </td>
            <td style="width: 60%;">
                <form action="<?php echo base_url().'index.php/kesehatan_siswa/simpan';?>" name="frmfilter" id="frmfilter" method="POST">
                <table style="width: 100%;">
                <tr>
                    <td style="width:15%">Kelas</td>
                    <td style="width:2%">:</td>
                    <td style="width:83%"><input type="text" name="kelas" id="kelas" class="input-text"/></td>
                </tr>
                <tr>
                    <td>No.Induk</td>
                    <td>:</td>
                    <td><input type="text" name="nis" id="nis" class="input-text"/></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><input type="text" name="nama_lengkap" id="nama_lengkap" class="input-text"/></td>
                </tr>
                 <tr>
                    <td>Semester</td>
                    <td>:</td>
                    <td><?php 
							$s_disabled1 = '';
							$s_disabled2 = '';
							$s_true1 	 = '';
							$s_true2	 = '';
							if($kd_semester =='1')
							{
								$s_disabled2 = 'disabled';
								$s_true1	 = 'TRUE';
							}else
							{
								$s_disabled1 = 'disabled';
								$s_true2	 = 'TRUE';
							}
							echo form_radio('p_nl','1',$s_true1,'id="p_nl1" '.$s_disabled1.' onclick="ambildatanilaieskul2('."'1'".')"').' 1 '.form_radio('p_nl','2',$s_true2,'id="p_nl2" '. $s_disabled2 . ' onclick="ambildatanilaieskul2('."'2'".')"').' 2 ' 
							
						
						?></td>
                </tr>
                    <td colspan="3">
                        <div id="tempatdataeskul">
                        </div>
                    </td>
                </tr>
                </table>
            </form>   
            </td>
        </tr>
        </table>
		</div>
        &nbsp;&nbsp;&nbsp;
    </div> <!-- /content -->
</div> <!-- /cols -->
	<hr class="noscreen" />
	<!-- Footer -->
<?php $this->load->view('page_footer'); ?>

<script type="text/javascript">
//untuk menampilkan data dropdown kelas
    function submitbykelas()
    {
        var varkelas = urlencode($('#skelas').val());
        var iddaftar = $('#frmfilter').attr('action');
        window.location = iddaftar+"/"+varkelas;
    }
    
//untuk link ambil nilai
    function ambil(kelas,nis,nama_lengkap)
    {
		document.getElementById("kelas").value = kelas;
        document.getElementById("nis").value = nis;
        document.getElementById("nama_lengkap").value = nama_lengkap;
        ambildatanilaieskul(kelas,nis);
	}
    
//untuk input nilai dari text box kedatabase
    function ambildatanilaieskul(kelas,nis)
    {
		var kd_semester	=<?php echo $this->session->userdata('kd_semester') ?>;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().'index.php/kesehatan_siswa/get_eskul_nis' ?>",
            data: "kelas="+kelas+"&nis="+nis+"&p_nl=" +kd_semester,
            success : function(msg) {
                $('#dataeskul').remove();
                $('#tempatdataeskul').append(msg);
            }
        });
    }

//untuk input nilai radio kedatabase
    function ambildatanilaieskul2(p_nl)
    {
		var kelas  = document.getElementById("kelas").value;
        var nis    = document.getElementById("nis").value;
		var kd_semester	=<?php echo $this->session->userdata('kd_semester') ?>;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().'index.php/kesehatan_siswa/get_eskul_nis' ?>",
            data: "kelas="+kelas+"&nis="+nis+"&p_nl="+kd_semester,
            success : function(msg) {
                $('#dataeskul').remove();
                $('#tempatdataeskul').append(msg);
            }
        });
    }
</script>
</body>
</html>