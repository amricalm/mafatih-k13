<?php
Header('Cache-Control: no-cache');
Header('Pragma: no-cache');
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
	<meta name="robots" content="noindex,nofollow" />
	<?php $this->load->view('pagecss'); ?>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
	});
	</script>
	<title>SID | Sekuriti</title>
</head>

<body>

<div id="main">

    <?php $this->load->view('sekuriti/menu_sekuriti');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>Sekuriti</h1>
            <!--
			<div class="tabs box">
				<ul>
					<li><a href="#tab01"><span>User</span></a></li>
					<li><a href="#tab02"><span>Input User</span></a></li>
			</div> <!-- /tabs 

			<!-- Tab01-->
			<!--<div id="tab01">
                <table style="border:none;width:100%">
                    <tr>
                        <td style="border:none"></td>
                        <td style="border:none;text-align:right">
                            <a href="" class="medium button blue">+</a>
                            <a href="" class="medium button blue">Edit</a>
                            <a href="" class="medium button blue">-</a>
                        </td>
                    </tr>
                </table>
    			<table style="width:100%">
    				<tr>
    				    <th style="width:5px"></th>
    				    <th style="width:25%">Kode User</th>
    				    <th style="width:50%">Nama User</th>
    				    <th style="width:25%">Lorem ipsum</th>
    				</tr>
    				<tr>
                        <td><input type="checkbox" name="kode" /></td>
    				    <td>Lorem ipsum</td>
    				    <td>Lorem ipsum</td>
    				    <td>Lorem ipsum</td>
    				</tr>
    				<tr class="bg">
                        <td><input type="checkbox" name="kode" /></td>
    				    <td>Lorem ipsum</td>
    				    <td>Lorem ipsum</td>
    				    <td>Lorem ipsum</td>
    				</tr>
    				<tr>
                        <td><input type="checkbox" name="kode" /></td>
    				    <td>Lorem ipsum</td>
    				    <td>Lorem ipsum</td>
    				    <td>Lorem ipsum</td>
    				</tr>
    				<tr class="bg">
                        <td><input type="checkbox" name="kode" /></td>
    				    <td>Lorem ipsum</td>
    				    <td>Lorem ipsum</td>
    				    <td>Lorem ipsum</td>
    				</tr>
    				<tr>
                        <td><input type="checkbox" name="kode" /></td>
    				    <td>Lorem ipsum</td>
    				    <td>Lorem ipsum</td>
    				    <td>Lorem ipsum</td>
    				</tr>
    			</table>
			</div>
			<div id="tab02">
            	<fieldset>
    				<legend>Legend</legend>
    				<table class="nostyle">
    					<tr>
    						<td style="width:70px;">Input:</td>
    						<td><input type="text" size="40" name="" class="input-text" /></td>
    					</tr>
    					<tr>
    						<td>Input:</td>
    						<td><input type="text" size="40" name="" class="input-text" disabled="disabled" /></td>
    					</tr>
    					<tr>
    						<td class="va-top">Input:</td>
    						<td><textarea cols="75" rows="7" class="input-text"></textarea></td>
    					</tr>
    					<tr>
    						<td>Input:</td>
    						<td>
    							<label><input type="checkbox" /> Lorem ipsum</label> &nbsp;
    							<label><input type="checkbox" /> Lorem ipsum</label> &nbsp;
    							<label><input type="checkbox" /> Lorem ipsum</label>
    						</td>
    					</tr>
    					<tr>
    						<td>Input:</td>
    						<td>
    							<label><input type="radio" /> Lorem ipsum</label> &nbsp;
    							<label><input type="radio" /> Lorem ipsum</label> &nbsp;
    							<label><input type="radio" /> Lorem ipsum</label>
    						</td>
    					</tr>
    					<tr>
    						<td colspan="2" class="t-right"><input type="submit" class="input-submit" value="Submit" /></td>
    					</tr>
    				</table>
    			</fieldset>
			</div>  /tab02 -->

            </div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->

</body>
</html>