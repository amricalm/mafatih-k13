<?php
Header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
Header('Pragma: no-cache');
?>
<!DOCTYPE>
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head>
	<title>Log In | Edusis Prestasi</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="stylesheet" id="login-css" href="<?php echo base_url()?>edusis_asset/css/login.css" type="text/css" media="all"/>
	<link rel="stylesheet" id="colors-fresh-css" href="<?php echo base_url()?>edusis_asset/css/colors-fresh.css" type="text/css" media="all">
	<link rel="shortcut icon"type="image/x-icon" href="<?php echo base_url() ?>edusis_asset/edusisimg/edusis.ico" />
	<meta name="robots" content="noindex,nofollow"/>
</head>
<body class="login">
<!--<div  style=" width: 100%; height: 70%; background: url(<?php //echo base_url()?>edusis_asset/edusisimg/amula.jpg)top no-repeat; opacity:100;filter:alpha(opacity=60)">-->   
    <div id="login">
        <h1>
            <a href="#" title=""></a>
        </h1>
	    <?php echo form_open('login', array('id'=>'loginform','name'=>'loginform')); ?>
        	<p>
                <label>Nama Pengguna<br/>
                <input name="user_login" id="user_login" class="input" size="20" tabindex="10" type="text"/></label>
        	</p>
        	<p>
        		<label>Kata Kunci<br/>
        		<input name="user_pass" id="user_pass" class="input" value="" size="20" tabindex="20" type="password"/></label>
        	</p>
        	<!--<p class="forgetmenot"><label><input name="rememberme" id="rememberme" value="forever" tabindex="90" type="checkbox"> Remember Me</label></p>-->
        	<p class="submit">
				<?php echo form_submit("wp_submit", "Log in", 'id="wp_submit" class="button-primary" tabindex="30" ');?>
        	</p>            
        </form>
    </div>
<!--</div>-->
<script type="text/javascript">
function wp_attempt_focus(){
setTimeout( function(){ try{
d = document.getElementById('user_login');
d.focus();
d.select();
} catch(e){}
}, 200);
}

wp_attempt_focus();
if(typeof wpOnload=='function')wpOnload();
</script>
</body>
</html>