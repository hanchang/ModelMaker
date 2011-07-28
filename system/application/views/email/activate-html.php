<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Welcome to <?php echo $site_name; ?>!</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">欢迎来到<?php echo $site_name; ?>! / Welcome to <?php echo $site_name; ?>!</h2>
<p>非常感谢您加入<?php echo $site_name; ?>.您的详细资料都在里面，请确定资料的安全。<br />
Thanks for joining <?php echo $site_name; ?>. We listed your sign in details below, make sure you keep them safe.</p>
<p>确认您的邮箱地址，请点击以下链接:<br />
To verify your email address, please follow this link:</p>
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('auth/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;">请完成您的注册... / Finish your registration...</a></b></big><br />
<br />
<p>如果通过点击以上链接无法访问，请将该网址复制并粘贴至新的浏览器窗口中。<br />
Link doesn't work? Copy the following link to your browser address bar:</p>
<nobr><a href="<?php echo site_url('auth/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo site_url('auth/activate/'.$user_id.'/'.$new_email_key); ?></a></nobr><br />
<br />
<p>
该链接在48小时内有效，48小时后需要重新注册。<br />
Please verify your email within <?php echo $activation_period; ?> hours, otherwise your registration will become invalid and you will have to register again.</p>
<br />
<br />
<?php if (strlen($username) > 0) { ?>您的登录名 ／ Your username: <?php echo $username; ?><br /><?php } ?>
您的邮箱地址 ／ Your email address: <?php echo $email; ?><br />
<?php if (isset($password)) { /* ?>Your password: <?php echo $password; ?><br /><?php */ } ?>
<br />
<br />
ModelMaker所有成员 ／ The <?php echo $site_name; ?> Team
</td>
</tr>
</table>
</div>
</body>
</html>