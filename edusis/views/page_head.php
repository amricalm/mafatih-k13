<?php
ini_set('MAX_EXECUTION_TIME', -1);
Header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
Header('Pragma: no-cache');
?>
<!DOCTYPE>
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head>
    <title>Edusis Prestasi <?php echo ($title!='') ? $title : ''; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="content-language" content="en" />
    <?php $this->load->view('page_css'); ?>
</head>
<style type="text/css">
    @import url("<?php echo base_url().'edusis_asset/css/adn.css'; ?>");
</style>
<script type="text/javascript">
$(document).ready(function(){
        $("a.namalengkap").easyTooltip();
    });
</script>
<script type="text/javascript" src="<?php echo base_url().'edusis_asset/js/easyTooltip.js' ?>"></script>