<?php $this->load->view('page_head');?>
<body>
<div id="main">
		<div id="content" class="box">
			<h1>Daftar Prestasi</h1>
			<div id="tab01">
    			<table width="59%" class="tables" >
    				<tr>
						<th width="1%">No</th>
						<th width="53%">Prestasi</th>
    				    <th width="5%" align="center">Poin</th>
    				</tr>
                    <?php 
                    $seq = 1;
                    if($prestasi->num_rows() > 0)
                    {
                        foreach($prestasi->result() as $row)
                        {
                            $bg = ($seq%2==0) ? ' class="bg" ' : '';
                            echo '<tr'.$bg.'>';
                            echo '<td align="center">'.$seq.'</td>';
                            echo '<td><a style="text_decoration:none;" href="javascript:daftar_prestasi('."'".$row->kd_prestasi."'".','."'".$row->nm_prestasi."'".','."'".$row->point."'".')">'.$row->nm_prestasi.'</a></td>';
                            echo '<td align="center">'.$row->point.'</td>';
                            echo '</tr>';
                            $seq++;
                        }
                    }
                    ?>
    			</table>
                <script language="javascript">
                function daftar_prestasi(kd_prestasi,nm_prestasi,point)
                	{
                		if(window.opener)
                		{
                			window.opener.document.getElementById("kd_prestasi").value = kd_prestasi;
                            window.opener.document.getElementById("nm_prestasi").value = nm_prestasi;
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
</body>
</html>