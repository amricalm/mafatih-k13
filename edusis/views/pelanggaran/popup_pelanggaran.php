<?php $this->load->view('page_head');?>
<body>
<div id="main">
		<div id="content" class="box">
			<h1>Daftar Point pelanggaran</h1>
			<div id="tab01">
                <?php echo form_open('pelanggaran/daftar_pelanggaran',array('name'=>'frmdaftar','id'=>'frmdaftar')) ?>
                <table style="border:1 ;width:80%">

                    <tr>
                        <td width="18%">Jenis Pelanggaran</td><td width="1%">:</td>
                        <td> 
                        <select name="kd_tpelanggaran" id="pelanggaran" onchange="submitbypelanggaran()">
                		<?php
                			echo '<option value="0" class="input-text" ></option>';
                			if($kd_tpelanggaran->num_rows() !=0)
                			{
                				foreach($kd_tpelanggaran->result () as $rowkd_tpelanggaran )
                				{
                					$selected		= '';
                					if($pilihkd_tpelanggaran == trim($rowkd_tpelanggaran->kd_tpelanggaran))
                					{
                						$selected	= 'selected="selected"';
                					}
                				echo '<option value="'.trim($rowkd_tpelanggaran->kd_tpelanggaran).'" '.$selected.'>'.$rowkd_tpelanggaran->nm_tpelanggaran.'</option>';
                				}
                			}
                		?>
                		</select>
                        </td>
                    </tr>
                </table>
                </form>
    			<table width="59%" class="tables" >
    				<tr>
						<th width="1%">No</th>
						<th width="53%">Pelanggaran</th>
    				    <th width="5%" align="center">Point</th>
    				</tr>
                    <?php 
                    $seq = 1;
                    if($pelanggaran->num_rows() > 0)
                    {
                        foreach($pelanggaran->result() as $row)
                        {
                            $bg = ($seq%2==0) ? ' class="bg" ' : '';
                            echo '<tr'.$bg.'>';
                            echo '<td align="center">'.$seq.'</td>';
                            echo '<td><a style="text_decoration:none;" href="javascript:daftar_pelanggaran('."'".$row->kd_pelanggaran."'".','."'".$row->nm_pelanggaran."'".','."'".$row->point."'".')">'.$row->nm_pelanggaran.'</a></td>';
                            echo '<td align="center">'.$row->point.'</td>';
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