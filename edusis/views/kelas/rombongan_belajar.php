 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>ROMBONGAN BELAJAR</h1>
            <div id="tab01">
                <table style="border: none;width:100%" class="tables">
                    <tr>
                        <td style="width: 40%;font-size:small;border:none">
                			<table style="width:100%;margin-top:0;padding-top:0">
                                <tr>
                                    <th colspan="2" width="1%"></th>
                                    <th width="20%" style="height: 39px;">NIS</th>
                                    <th width="79%">Siswa</th>
                                </tr>
                                <?php 
                                    $seq    = 1;
                                    foreach($siswa_belum_kelas->result() as $row_belum)
                                    {
                                        $bg = ($seq%2==0) ? ' class="bg" ' : '';
                                        echo '<tr'.$bg.'>';
                                        echo '<td><input type="checkbox" id="'.$row_belum->nis.'" name="kodesiswabelum[]" value="'.$row_belum->nis.'" /></td>';
                                        echo '<td>'.$seq.'</td>';
                                        echo '<td>'.$row_belum->nis.'</td>';
                                        echo '<td>'.$row_belum->nama_lengkap.'</td>';
                                        echo '</tr>';
                                        $seq ++;
                                    }
                                ?>
                			</table>
                        </td>
                        <td style="vertical-align: top;text-align:center;border:none">
                            <?php echo form_hidden('myurl',base_url()) ?>
                            <br />
                            <br />
                            <a class="large button blue" name="keluarkelas" id="keluarkelas" onclick="keluarkelas()"> << </a>
                            <br />
                            <br />
                            <a class="large button blue" name="masukkelas" id="masukkelas" onclick="masukkelas()"> >> </a>
                            <br />
                            <br />
                            <a class="small button blue" name="checkedkeluarkelas" id="checkedkeluarkelas" onclick="checkedsiswabelum()"> << Pilih Semua</a>
                            <a class="small button blue" name="checkedmasukkelas" id="checkedmasukkelas" onclick="checkedsiswakelas()">Pilih Semua >> </a>
                            <br />
                            <br />
                            <img id="gambarloading" name="gambarloading" alt="" />
                        </td>
                        <td style="width: 40%;font-size:small;border:none">
                            <form action="<?php echo base_url().'index.php/kelas/rombongan_belajar';?>" name="frmfilter" id="frmfilter" method="POST">
                			<table style="width:100%;" class="tables">
                                <tr>
                                    <th colspan="4" style="vertical-align: middle;">Pilih Kelas : &nbsp;&nbsp;&nbsp;
                                        <select name="kelas" id="kelas" onchange="ubahform()">
                                        <?php
                                            echo '<option value="" class="input-text"></option>';
                                            if($kelas->num_rows()!=0)
                                            {
                                                foreach($kelas->result() as $rowkelas)
                                                {
                                                    $selected       = '';
                                                    if($pilih_kelas==$rowkelas->kelas)
                                                    {
                                                        $selected   = ' selected="selected" ';
                                                    }
                                                    echo '<option value="'.$rowkelas->kelas.'" class="input-text" '.$selected.'>'.$rowkelas->kelas.'</option>'; 
                                                }
                                            }
                                        ?>	
                                        </select>
                                    </th>
                                </tr>
                                <?php 
                                    $seq = 1;
                                    foreach($siswa_kelas->result() as $row_kelas)
                                    {
                                        $bg = ($seq%2==0) ? ' class="bg" ' : '';
                                        echo '<tr'.$bg.'>';
                                        echo '<td width="1%"><input type="checkbox" id="'.$row_kelas->nis.'" name="kodesiswakelas[]" value="'.$row_kelas->nis.'" /></td>';
                                        echo '<td width="1%">'.$seq.'</td>';
                                        echo '<td width="8%">'.$row_kelas->nis.'</td>';
                                        echo '<td width="">'.$row_kelas->nama_lengkap.'</td>';
                                        $seq++;
                                        echo '</tr>';
                                    }
                                ?>
                			</table>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
		</div>
	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
<script type="text/javascript">
    function ubahform()
    {
        var kelas       = urlencode($('#kelas').val());
        var href        = $('#frmfilter').attr('action');
        $('#frmfilter').attr('action',href+'/'+kelas+'/');
        $('#frmfilter').submit();
        //$('#ffilter').action(var1);
    }
</script>
</body>
</html>