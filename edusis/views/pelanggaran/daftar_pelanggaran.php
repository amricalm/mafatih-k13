<?php $this->load->view('page_head');?>

<body>

<div id="main">
		<div id="content" class="box">

			<h1>DETAIL PELANGGARAN</h1>

			<div id="tab01">
                <?php echo form_open('pelanggaran/daftar',array('name'=>'frmdaftar','id'=>'frmdaftar')) ?>
                <table style="border:1 ;width:80%">

                    <tr>
                        <td style="border:none;text-align:left;width:100px">
                            Daftar Pelanggaran
                        </td>
                        <td style="border:none;text-align:left;width:250px">
                            <input type="text" size="50" name="txtcari" id="txtcari" class="input-text" value="<?php  ?>" /><br/>							
                        </td>
                        <td style="border:none;text-align:left"><input type="submit" class="input-submit" name="submit" value="Pencarian" />
                        </td>
                    </tr>
                </table>
                </form>
    			<table width="53%" >
    				<tr>
						<th width="43%">Pelanggaran</th>
    				    <th width="10%" align="center">Point</th>
    				</tr>
                    <?php 
                    $seq = 1;
                    if($pelanggaran->num_rows() > 0)
                    {
                        foreach($pelanggaran->result() as $row)
                        {
                            $bg = ($seq%2==0) ? ' class="bg" ' : '';
                            echo '<tr'.$bg.'>';
                            echo '<td><a style="text_decoration:none;" href="javascript:daftar_pelanggaran('."'".$row->kd_pelanggaran."'".','."'".$row->nm_pelanggaran."'".','."'".$row->point."'".')">'.$row->nm_pelanggaran.'</a></td>';
                            echo '<td>'.$row->point.'</td>';
                            echo '</tr>';
                            $seq++;
                        }
                    }
                    ?>
    			</table>
                <script language="javascript">
                function daftar_pelanggaran(kd_pelanggaran,nm_pelanggaran,point)
                	{
                		if(window.opener)
                		{
                			window.opener.document.getElementById("kd_pelanggaran").value = kd_pelanggaran;
                            window.opener.document.getElementById("nm_pelanggaran").value = nm_pelanggaran;
                            window.opener.document.getElementById("point").value = point;
                			window.close();
                		}
                	}
                
                
                </script>
			</div>
            
            <?php echo $this->pagination->create_links(); ?> &nbsp;&nbsp;&nbsp;
            </div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
<script type="text/javascript">
    function submitbypelanggaran()
    {
        var varkelas = $('#pelanggaran').val();
        var iddaftar = $('#frmdaftar').attr('action');
        window.location = iddaftar+"/"+varkelas;
        //alert(iddaftar);
    }
</script>
</body>
</html>