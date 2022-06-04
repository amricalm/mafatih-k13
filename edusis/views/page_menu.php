<!--Begin Menu-->
<?php $this->load->view('page_tray');?>
<hr class="noscreen" />            
<?php echo $menu; ?>
<div id="role"><center><?php echo $this->session->flashdata('msgrole');?></center></div>
<!--End Menu-->