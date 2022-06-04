    <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/reset.css" /> <!-- RESET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/main.css" /> <!-- MAIN STYLE SHEET -->
	<!--<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/2col.css" title="2col" /> <!-- DEFAULT: 2 COLUMNS -->
	<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/1col.css" title="1col" /> <!-- ALTERNATE: 1 COLUMN -->
	<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="css/main-ie6.css" /><![endif]--> <!-- MSIE6 -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/style.css" /> <!-- GRAPHIC THEME -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/mystyle.css" /> <!-- WRITE YOUR CSS CODE HERE -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/button.css" />
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/jquery-ui-andhana.css" />
    <link rel="shortcut icon"type="image/x-icon" href="<?php echo base_url() ?>edusis_asset/edusisimg/edusis.ico" />
	
	<script type="text/javascript" src="<?php echo base_url() ?>edusis_asset/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>edusis_asset/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>edusis_asset/js/jquery.jstepper.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>edusis_asset/js/aksi.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#tabs').tabs();
        $('.tgl').datepicker({
            defaultDate: +1,
			dateFormat: "yy-mm-dd",
			regional: "id",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            yearRange: '1960:2030'
		});
        $(".number").jStepper({minValue:0, maxValue:100});
        $(".number_afk").jStepper({minValue:0, maxValue:4});
        $(".tahun").jStepper({minValue:0, maxValue:2030});
        $(".pos").jStepper({minValue:0, maxValue:99999});
	});
	</script>