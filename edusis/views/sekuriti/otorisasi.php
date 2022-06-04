 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>OTORISASI USER</h1>
            <div id="tab01">
                <table style="border: none;width:100%">
                    <tr>
                        <td style="width: 40%;font-size:small;border:none">
                			<table style="width:100%;margin-top:0;padding-top:0" class="tables">
                                <tr>
                                    <th width="1%">#</th>
                                    <th width="99%" style="height: 39px;">Mata Pelajaran</th>
                                </tr>
                                <?php 
                                    $seq    = 1;
                                    foreach($get_mp_belum->result() as $row_belum)
                                    {
                                        $bg = ($seq%2==0) ? ' class="bg" ' : '';
                                        echo '<tr'.$bg.'>';
                                        echo '<td><input type="checkbox" id="'.$row_belum->kd_mp.'" name="kodebelumotorisasi[]" value="'.$row_belum->kd_mp.'" /></td>';
                                        echo '<td>'.$row_belum->nm_mp.'</td>';
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
                            <a class="large button blue" name="keluarotorisasi" id="keluarotorisasi" onclick="keluarotorisasi()"> << </a>
                            <br />
                            <br />
                            <a class="large button blue" name="masukotorisasi" id="masukotorisasi" onclick="masukotorisasi()"> >> </a>
                            <br />
                            <br />
                            <a class="small button blue" name="checkedkeluarotorisasi" id="checkedkeluarotorisasi" onclick="checkedbelumotorisasi()"> << Pilih Semua</a>
                            <a class="small button blue" name="checkedmasukotorisasi" id="checkedmasukotorisasi" onclick="checkedotorisasi()">Pilih Semua >> </a>
                            <br />
                            <br />
                            <img id="gambarloading" name="gambarloading" alt="" />
                        </td>
                        <td style="width: 40%;font-size:small;border:none">
                            <form action="<?php echo base_url().'index.php/sekuriti/otorisasi';?>" name="frmfilter" id="frmfilter" method="POST">
                			<table style="width:100%;" class="tables">
                                <tr>
                                    <th colspan="2" style="vertical-align: middle;">Group : &nbsp;&nbsp;
                                        <select name="kd_group" id="kd_group" onchange="ubahform()" style="width: 150px;">
                                        <?php
                                            echo '<option value="0" class="input-text"></option>';
                                            if($group->num_rows()!=0)
                                            {
                                                foreach($group->result() as $rowgroup)
                                                {
                                                    $selected       = '';
                                                    if($pilih_group==$rowgroup->kd_group)
                                                    {
                                                       $selected   = ' selected="selected" ';
                                                    }
                                                   echo '<option value="'.$rowgroup->kd_group.'" class="input-text" '.$selected.'>'.$rowgroup->nm_group.'</option>'; 
                                                }
                                            }
                                        ?>	
                                        </select>
                                    </th>
                                    <th style="vertical-align: middle;">Kelas : &nbsp;&nbsp;
                                        <select name="kelas" id="kelas" onchange="ubahform()" style="width: 150px;">
                                        <?php
                                            echo '<option value="0" class="input-text"></option>';
                                            if($kelass->num_rows()!=0)
                                            {
                                                foreach($kelass->result() as $rowkelas)
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
                			</table>
                			<table width="100%" class="tables">
                                <?php 
                                    $seq = 1;
                                    foreach($get_mp_sudah->result() as $row_mp)
                                    {
                                        $bg = ($seq%2==0) ? ' class="bg" ' : '';
                                        echo '<tr'.$bg.'>';
                                        echo '<td width="1px"><input type="checkbox" id="'.$row_mp->kd_mp.'" name="kodeotorisasi[]" value="'.$row_mp->kd_mp.'" /></td>';
                                        echo '<td>'.$row_mp->nm_mp.'</td>';
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
        var kd_group    = urlencode($('#kd_group').val());
        var kelas       = urlencode($('#kelas').val());
        var href        = $('#frmfilter').attr('action');
        $('#frmfilter').attr('action',href+'/'+kd_group+'/'+kelas);
        $('#frmfilter').submit();
        //$('#ffilter').action(var1);
    }
</script>
</body>
</html>