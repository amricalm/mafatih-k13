 <?php $this->load->view('page_head');?>
<body>
<div id="main">
		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>Siswa - Daftar</h1>
			<div id="tab01">
                <?php echo form_open('siswapopup/daftar',array('name'=>'frmdaftar','id'=>'frmdaftar')) ?>
                <table style="border:none;width:55%">
                    <tr>
                        <td style="border:none;text-align:left;width:100px">NIS / Nama</td>
                        <td style="border:none;text-align:left;width:250px">
                            <input type="text" size="50" name="txtcari" id="txtcari" class="input-text" value="<?php echo $txtcarisiswa ?>" /><br/>							
                        </td>
                        <td style="border:none;text-align:left"><input type="submit" class="input button blue" name="submit" value="Filter" /></td>
                    </tr>
                </table>
                </form>
    			<table width="55%"  class="tables">
    				<tr>
    				    <th width="1%">#</th>
    				    <th width="10%">NIS</th>
						<th width="44%">Nama Lengkap</th>
    				</tr>
                    <?php 
                    $seq = 1;
                    if($siswa->num_rows() > 0)
                    {
                        foreach($siswa->result() as $row)
                        {
                            $bg = ($seq%2==0) ? ' class="bg" ' : '';
                            echo '<tr'.$bg.'>';
                            echo '<td style="align:centre;">'.$seq.'</td>';
                            echo '<td><a style="text_decoration:none;" href="javascript:ambil('."'".trim($row->nis)."'".','."'".trim($row->nama_lengkap)."'".')">'.$row->nis.'</a></td>';
                            echo '<td><a style="text_decoration:none;" href="javascript:ambil('."'".trim($row->nis)."'".','."'".trim($row->nama_lengkap)."'".')">'.$row->nama_lengkap.'</a></td>';
                            echo '</tr>';
                            $seq++;
                        }
                    }
                    ?>
    			</table>
                <script type="text/javascript">
                	function ambil(nis,nama_lengkap)
                	{
                		if(window.opener)
                		{
                			window.opener.document.getElementById("nis").value = nis;
                            window.opener.document.getElementById("nama_lengkap").value = nama_lengkap;
                            //window.opener.document.getElementById("kelas").value = kelas;
                			window.close();
                		}
                	}
                </script>
			</div>
            
            <?php //echo $this->pagination->create_links(); ?> &nbsp;&nbsp;&nbsp;
            </div> <!-- /content -->

</div> <!-- /cols -->

<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
<script type="text/javascript">
    function submitbykelas()
    {
        var varkelas = $('#kelas').val();
        var iddaftar = $('#frmdaftar').attr('action');
        window.location = iddaftar+"/"+varkelas;
        //alert(iddaftar);
    }
</script>
</body>
</html>