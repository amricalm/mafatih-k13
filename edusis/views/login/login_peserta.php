<?php
Header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
Header('Pragma: no-cache');
?>
<!DOCTYPE>
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head>
	<title>Log In | Sistem Informasi Diklat - PUSDIKLAT MIGAS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="stylesheet" id="login-css" href="<?php echo base_url()?>edusis_asset/css/login.css" type="text/css" media="all"/>
	<link rel="stylesheet" id="colors-fresh-css" href="<?php echo base_url()?>edusis_asset/css/colors-fresh.css" type="text/css" media="all">
	<meta name="robots" content="noindex,nofollow"/>
</head>
<body class="login">
    <div id="login">
        <h1>
            <a href="#" title=""></a>
        </h1>
	    <?php echo form_open('login/login_peserta', array('id'=>'loginform','name'=>'loginform')); ?>
        	<h3>Peserta yang sudah terdaftar.</h3>
        	<p>
                <label>Nama Pengguna<br/>
                <input name="psrta_login" id="psrta_login" class="input" size="20" tabindex="10" type="text"></label>
        	</p>
        	<p>
        		<label>Kata Kunci<br/>
        		<input name="psrta_pwd" id="psrta_pwd" class="input" value="" size="20" tabindex="20" type="password"></label>
        	</p>
            <p class="submit">
				<?php echo form_submit("wp_submit", "Masuk", 'id="wp_submit" class="button-primary" tabindex="30" ');?>
        	</p>
        </form>
	    <?php echo form_open('login/cek_login_peserta', array('id'=>'loginform','name'=>'loginform')); ?>
            <h3>Peserta yang belum terdaftar.</h3>
        	<p>
                <label>Masukkan Kode Pelatihan<br/>
                <input name="sik_id" id="sik_id" class="input" size="20" tabindex="30" type="text"></label>
        	</p>
            <p class="submit">
				<?php echo form_submit("wp_submit", "Masuk", 'id="wp_submit" class="button-primary" tabindex="30" ');?>
        	</p>
        </form>
        <p id="nav">
            Klik <a href="<?php echo base_url().''; ?>" title="Masuk untuk login">disini</a> untuk login atau klik <a href="<?php echo base_url().''; ?>" title="Masuk untuk WI">disini</a> untuk WI
        </p>
    </div>
<script type="text/javascript">
document.getElementById('sik_id').focus();
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