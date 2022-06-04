<?php $this->load->view('page_head'); ?>

<body>

<div id="main">

	<?php $this->load->view('page_menu');?>

	<hr class="noscreen" />
	<!-- Columns -->
	<div id="cols" class="box">
		<hr class="noscreen" />
		<?php $this->load->view('page_content'); ?>

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
</div>
<script type="text/javascript">
function goto(text)
{
    window.location = text;
}
</script>
</body>
</html>