欢迎来到<?php echo $site_name; ?>!
Welcome to <?php echo $site_name; ?>,

非常感谢您加入<?php echo $site_name; ?>.您的详细资料都在里面，请确定资料的安全。
Thanks for joining <?php echo $site_name; ?>. We listed your sign in details below, make sure you keep them safe.

确认您的邮箱地址，请点击以下链接:
To verify your email address, please follow this link:

<?php echo site_url('auth/activate/'.$user_id.'/'.$new_email_key); ?>

该链接在48小时内有效，48小时后需要重新注册。
Please verify your email within <?php echo $activation_period; ?> hours, otherwise your registration will become invalid and you will have to register again.
<?php if (strlen($username) > 0) { ?>

您的登录名 ／ Your username: <?php echo $username; ?>
<?php } ?>

您的邮箱地址 ／ Your email address: <?php echo $email; ?>
<?php if (isset($password)) { /* ?>

Your password: <?php echo $password; ?>
<?php */ } ?>


ModelMaker所有成员
The <?php echo $site_name; ?> Team